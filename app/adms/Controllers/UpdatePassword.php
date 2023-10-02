<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
//CLASSE DE RECUPERAÇÃO DE SENHA, RECEBE A CHAVE PARA ATUALIZAÇÃO DA SENHA
class UpdatePassword
{
  private string|null $key;  // $key Recebe a chave para cadastrar nova senha 
  private array|string|null $data = []; // $data Recebe os dados que devem ser enviados para VIEW 
  private array|null $dataForm; //$dataForm Recebe os dados do formulario 
  public function index(): void
  {
    $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // var_dump($this->dataForm);
    if ((!empty($this->key)) and (empty($this->dataForm['sendUpdatePass']))) {
      $this->validateKey();
    } else {
      $this->updatePassword();
    }
  }
  //METODO DE VALIDAÇÃO DA SENHA
  private function validateKey(): void
  {
    $valKey = new \App\adms\Models\AdmsUpdatePassword();
    $valKey->valKey($this->key);
    if ($valKey->getResult()) {
      $this->viewUpdatePassword();
    } else {
      $urlRedirect = URLADM . "login/index";
      header("Location: $urlRedirect");
    }
  }
  // METODO PARA EDITAR A SENHA NO BANCO
  private function updatePassword(): void
  {
    if (!empty($this->dataForm['sendUpdatePass'])) {
      unset($this->dataForm['sendUpdatePass']);
      $this->dataForm['key'] = $this->key;
      $upPassword = new \App\adms\Models\AdmsUpdatePassword();
      $upPassword->editPassword($this->dataForm);
      if($upPassword->getResult()){
         $urlRedirect = URLADM . "login/index";
      header("Location: $urlRedirect");
      }else{
          $this->viewUpdatePassword();
      }
    }else{
      $_SESSION['msg'] =  "<p style='color:#f00;'>Necessário confirmar o email, 
      acesse sua caixa de email clique no link para ativar,<a href='" . URLADM .
       "new-con-email/index'> Se não encontro o email clique aqui para renviar o email<a>!</p>";
      $urlRedirect = URLADM . "login/index";
      header("Location: $urlRedirect");
    }
  }
  private function viewUpdatePassword(): void
  {
    $loadView = new \Core\ConfigView("adms/Views/login/updatePassword", $this->data);
    $loadView->loadView();
  }
}
