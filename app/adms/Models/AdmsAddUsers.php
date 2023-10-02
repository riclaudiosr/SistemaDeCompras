<?php

namespace App\adms\Models;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
//ARQUIVO DA CADASTRO DE USUÁRIO
class AdmsAddUsers
{
  private array|null $data; // RECEBE OS DADOS DO FORMULARIO
  private $result; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private array $listRegistryAdd; // RECEBE OS DADOS DO BANCO DE DADOS APRAVES DO RELPE ADMSREAD


  public function getResult()
  {
    return $this->result;
  }

  public function createUser(array $data = null)
  {
    $this->data = $data;

    //intancia o arquivo que valida os dados
    $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
    $valEmptyField->valField($this->data);
    //intanciar o resultado da validação, dentro de uma condição
    if ($valEmptyField->getResult()) {
      $this->valInput();
    } else {
      $this->result = false;
    }
  }
  //METODO PARA VALIDAÇAO DE EMAIL
  private function valInput(): void
  {
    $valEmail = new \App\adms\Models\helper\AdmsValEmail();
    $valEmail->validateEmail($this->data['email']);

    $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
    $valEmailSingle->validateEmailSingle($this->data['email']);

    $valpassword = new \App\adms\Models\helper\AdmsValPassword();
    $valpassword->validatePassword($this->data['password']);

    $valUserSingleLogin = new \App\adms\Models\helper\AdmsValUserSingle();
    $valUserSingleLogin->validateUserSingle($this->data['user']);

    if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valpassword->getResult()) and ($valUserSingleLogin->getResult())) {
      $this->addEmail();
    } else {
      $this->result = false;
    }
  }
  //METODO DE PARA ADICIONAR EMAIL
  private function addEmail(): void
  {
    //criptografar senha
    $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
    //CRIAR UMA CHAVE DE CONFIRMAÇÃO DO EMAIL
    $this->data['conf_email'] = password_hash($this->data['password'] . date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
    //converter a data para o padrão comum
    $this->data['created'] = date("Y-m-d H:i:s");

    $creatUser =  new \App\adms\Models\helper\AdmsCreate();
    $creatUser->exeCreate("adms_users", $this->data);
    if ($creatUser->getResult()) {
      $_SESSION['msg'] = "<p style='color:green;'> Usuario Cadastrado com Secesso!</p>";
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario Nao Cadastrado </p>";
      $this->result = false;
    }
  }
  public function listSelect(): array
  {
    $list = new \App\adms\Models\helper\AdmsRead();
    $list->fullRead("SELECT id AS id_sit, name AS name_sit FROM adms_sits_users ORDER BY name ASC");

    $registry['sit'] = $list->getResult();
    $this->listRegistryAdd = ['sit' => $registry['sit']];
    return $this->listRegistryAdd;
  }
}
