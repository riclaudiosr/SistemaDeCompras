<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
//CLASSE DE ENVIO DE DADOS PARA RECUPERAÇÃO DE SENHA
class RecoverPassword
{
  //RECEBE E ENVIA OS DADOS DA URL
  private string|array|null $data = [];
  //$dataForm, recebe os dados do formulario
  private array|null $dataForm;
  public function index(): void
  {
    $this->dataForm = filter_input_array(INPUT_POST,FILTER_DEFAULT);
    //  var_dump($this->dataForm);
    if(!empty($this->dataForm['SendRecoverPass'])){
      unset($this->dataForm['sendRecorverPass']);
    $recoverPass = new \App\adms\Models\AdmsRecorverPasswors();
     $recoverPass->recoverPass($this->dataForm);
     if($recoverPass->getResult()){
    //  $this->viewRecoverPass();
      $urlRedirect = URLADM ."login/index";
      header("location:  $urlRedirect");

     }else{
      $this->data['form']= $this->dataForm;
      $this->viewRecoverPass();
     }   
    }else{
       $this->viewRecoverPass();
    }
  }
  //METODO QUE CARREGA A VIEW
  private function viewRecoverPass():void
  {
   $loadView = new \Core\ConfigView("adms/Views/login/recoverPassword", $this->data);
   $loadView->loadView();
  }
}
