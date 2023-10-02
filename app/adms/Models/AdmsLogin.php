<?php
namespace App\adms\Models;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
//ARQUIVO DE ACESSO DO USUARIO A CONTA
class AdmsLogin
{
  private array|null $data; // RECEBE OS DADOS DE ACESSO DO USUARIO
  private $result_bd; //RECEBE O RESULTADO DO BANCO
  private $result; // RECEBE O RESULTADO DA CLASSE

  public function getResult()
  {
    return $this->result;
  }

  public function login(array $data = null)
  {
    $this->data = $data;
    // var_dump($this->data);
    // validar formulario de login
    $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
    $valEmptyField->valField($this->data);
    if ($valEmptyField->getResult()) {
      //CASSE DE BUSCA DE DADOS EM UMA TABELA
      $viewUser = new \App\adms\Models\helper\AdmsRead();
      //RETORNA TODAS AS COLUNAS DA TABELA
      //  $viewUser->exeRead(TABELA, "WHERE user =:user LIMIT :limit", "user={$this->data['user']}& limit=1");

      //RETORNA SO AS COLUNAS INDICADA
      $viewUser->fullRead(
        "SELECT id, name,nickname,email,password,image,adms_sits_user_id FROM adms_users 
                            WHERE user =:user OR email =:email LIMIT :limit",
        "user={$this->data['user']}&email={$this->data['user']}&limit=1"
      );

      // VERIFICAR SE OS DADOS EXISTE
      $this->result_bd = $viewUser->getResult();
      if ($this->result_bd) {
        //VALIDAÇÃO DE SENHA
        $this->valEmailPerm();
      } else {
        $_SESSION['msg'] = "<p style='color:#f00;'>Usuário ou Senha Incorreta!</p>";
        $this->result = false;
      }
    } else {
      //Se não haver dados nos campos
      $_SESSION['msg'] = "<p style='color:#f00;'>Insira Usuario e Senha!</p>";
      $this->result = false;
    }
  }
  private function valEmailPerm(): void
  {
    if ($this->result_bd[0]['adms_sits_user_id'] == 2) {
      $this->valPassworw();
    } elseif ($this->result_bd[0]['adms_sits_user_id'] == 1) {
      $_SESSION['msg'] = "<p style='color:#f00;'>Necessário confirmar o email, 
      acesse sua caixa de email clique no link para ativar,<a href='" . URLADM . "new-con-email/index'> Se não encontro o email clique aqui para renviar o email<a>!</p>";
      $this->result = false;
    } elseif ($this->result_bd[0]['adms_sits_user_id'] == 7) {
      $_SESSION['msg'] = "<p style='color:#f00;'>Email descadastrado entre em contato com o suporte!</p>";
      $this->result = false;
    } elseif ($this->result_bd[0]['adms_sits_user_id'] == 3) {
      $_SESSION['msg'] = "<p style='color:#f00;'>Email inativo entre em contato com a empresa!</p>";
      $this->result = false;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Email inativo entre em contato com a empresa!</p>";
      $this->result = false;
    }
  }
  // METODO DE VALIDAÇÃO DE SENHA DE ACESSO
  private function valPassworw()
  {
    if (password_verify($this->data['password'], $this->result_bd[0]['password'])) {
      $this->result = true;
      $_SESSION['msg'] = "<p style='color:green;'>Login Realizado com Sucesso!</p>";
      $_SESSION['user_id'] = $this->result_bd[0]['id'];
      $_SESSION['user_name'] = $this->result_bd[0]['name'];
      $_SESSION['user_nickname'] = $this->result_bd[0]['nickname'];
      $_SESSION['user_email'] = $this->result_bd[0]['email'];
      $_SESSION['user_user'] = $this->result_bd[0]['user'];
      $_SESSION['user_image'] = $this->result_bd[0]['image'];
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Usuário ou Senha Incorreta!</p>";
      $this->result = false;
    }
  }
}
