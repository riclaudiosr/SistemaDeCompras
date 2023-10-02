<?php
namespace App\adms\Models;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
use App\adms\Models\helper\AdmsConn;

//ARQUIVO DE VALIDAÇÃO DE email de cadastro do usuário
class AdmsConfEmail extends AdmsConn
{
  private bool $result; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private array $resultBd; // recebe os registro do banco de dados
  private string $key; // recebe os dados para o usuario confirmar o email
  private array $dataSave;

  public function getResult()
  {
    return $this->result;
  }

  public function confEmail(string $key): void
  {
    $this->key = $key;
    if (!empty($this->key)) {
      $viewKeyConfEmail = new \App\adms\Models\helper\AdmsRead();
      $viewKeyConfEmail->fullRead("SELECT id 
                                    FROM adms_users 
                                    WHERE conf_email =:conf_email 
                                    LIMIT :limit", "conf_email={$this->key}&limit=1");
      $this->resultBd = $viewKeyConfEmail->getResult();
      if ($this->resultBd) {
        $this->updateSitUser();
      } else {
        
        $_SESSION['msg'] =  "<p style='color:#f00;'>Necessário confirmar o email, 
        acesse sua caixa de email clique no link para ativar,<a href='" . URLADM . 
        "new-con-email/index'> Se não encontro o email clique aqui para renviar o email<a>!</p>";
        $this->result = false;
      }
    } else {
      $_SESSION['msg'] =  "<p style='color:#f00;'>Necessário confirmar o email, 
      acesse sua caixa de email clique no link para ativar,<a href='" . URLADM .
       "new-con-email/index'> Se não encontro o email clique aqui para renviar o email<a>!</p>";
      $this->result = false;
    }
  }

  private function updateSitUser(): void
  {
    $this->dataSave['conf_email'] = null; 
    $this->dataSave['adms_sits_user_id'] = 2;
    $this->dataSave['modified'] = date("Y-m-d H:i:s");
  //  $conf_email = null;
 //   $adms_sits_user_id = 2;

   $upConfEmail = new \App\adms\Models\helper\AdmsUpdate();
   $upConfEmail->exeUpdate("adms_users",$this->dataSave,  "WHERE  id=:id","id={$this->resultBd[0]['id']}");    

   if ($upConfEmail->getResult()) {
    $_SESSION['msg'] = "<p style='color: green;'>E-mail ativado com sucesso!</p>";
    $this->result = true;
  } else {
    $_SESSION['msg'] =  "<p style='color:#f00;'>Necessário confirmar o email, 
    acesse sua caixa de email clique no link para ativar,<a href='" . URLADM . 
    "new-con-email/index'> Se não encontro o email clique aqui para renviar o email<a>!</p>";
    $this->result = false;
  }


/*
    $query_ativar_user = "UPDATE adms_users 
                        SET conf_email=:conf_email, 
                        adms_sits_user_id=:adms_sits_user_id,
                        modified = NOW() 
                        WHERE id=:id 
                        LIMIT 1";

    $activate_email = $this->connectDb()->prepare($query_ativar_user);
    $activate_email->bindParam(':conf_email', $conf_email);
    $activate_email->bindParam(':adms_sits_user_id', $adms_sits_user_id);
    $activate_email->bindParam(':id', $this->resultBd[0]['id']);
    $activate_email->execute();

    if ($activate_email->rowCount()) {
      $_SESSION['msg'] = "<p style='color: green;'>E-mail ativado com sucesso!</p>";
      $this->result = false;
    } else {
      $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link inválido!</p>";
      $this->result = false;
    }*/
  }
}
