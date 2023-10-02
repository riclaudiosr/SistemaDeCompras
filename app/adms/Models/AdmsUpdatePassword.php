<?php
namespace App\adms\Models;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

// ARQUIVO DE ATUALIZAÇÃO DE SENHA
class AdmsUpdatePassword
{
    private array|null $data; // $data Recebe os dados para ser alterado
    private string $key;// $key Recebe a chave para atualizar a senha 
    private bool $result;//$result Recebe true quando executar o processo com sucesso e false quando houver erro 
    private array|null $resultBd;//$resultBd Recebe os registros do banco de dados 
    private array|null $dataForm; //$dataForm Recebe os dados do formulario 
    private array|string|int $dataSave; // recebe os dados da coluna editada
    //RECEBE O RESULTADO DA CLASSE
    function getResult(): bool
    {
        return $this->result;
    }
//METODO BUSCA A CHAVE QUE ESTA NO BANCO PARA VERIFICAÇÃO
    public function valKey(string $key): bool
    {
        $this->key = $key;
        $viewKeyUpPass = new \App\adms\Models\helper\AdmsRead();
        $viewKeyUpPass->fullRead(
                                "SELECT id
                                FROM adms_users
                                WHERE recover_password=:recover_password
                                LIMIT :limit",
                                "recover_password={$this->key}&limit=1" );
        $this->resultBd = $viewKeyUpPass->getResult();
        if ($this->resultBd) {
            $this->result = true;
            return true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link para atualização de senha invalido inválido, solicite novo link <a href='" . URLADM .
             "recover-password/index'>clique aqui</a>!</p>";
            $this->result = false;
            return false;
        }
    }
    //METODO VERIFICA SE O FORMULARIO ESTA VAZIO
    public function editPassword(array $data = null):void
    {
        $this->data = $data;
       $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
       $valEmptyField->valField($this->data);
       if($valEmptyField->getResult()){
        $this->valInput();
       }else{
        $this->result = false;
       }
    }
    //METODO RESPONSÁVEL EM CHAMA O RELPE DE CRIAÇÃO DE SENHA
    private function valInput():void
    {
      $valPassword =  new \App\adms\Models\helper\AdmsValPassword();
      $valPassword->validatePassword($this->data['password']);
      if($valPassword->getResult()){
        if($this->valKey($this->data['key'])){
            $this->updatePassword();
        }else{
            $this->result = false;
        }
      }else{
        $this->result = false;
      }
    }
    //METODO QUE EDITA A SENHA, INVALIDA A CHAVE QUE ESTA SENDO USADA PARA A ATUALIZAÇÃO DA SENHA, E INSERE A DATA DA MODIFICAÇÃO NO BANCO
    private function updatePassword():void
    {
        $this->dataSave['recover_password'] = null;
        $this->dataSave['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->dataSave['modified'] = date("Y-m-d H:i:s");
        
       $upAdmsUpdate = new \App\adms\Models\helper\AdmsUpdate();
       $upAdmsUpdate->exeUpdate("adms_users", $this->dataSave, "WHERE ID =:id", "id={$this->resultBd[0]['id']}");
       if($upAdmsUpdate->getResult()){
            $this->result = true;   
            $_SESSION['msg'] = "<p style='color:green;'>Senha atualizda com sucesso!<p>";
       }else{
        $this->result = false;
        $_SESSION['msg'] = "<p style='color:#f00;'> Erro: Senha não atualizada!<p>";
       }
    }
}
