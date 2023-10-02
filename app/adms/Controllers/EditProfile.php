<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

//CONTROLLER EDITAR perfil usuário
class EditProfile
{
  private array|null $data = []; //RECEBE OS DADOS DA CONTROLE 
  private array|null $dataForm; //$dataForm, recebe os dados do formulario

  public function index(): void
  {
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($this->dataForm['sendEditProfile'])) {
     $this->editProfile();
    } else {
      $editProfile = new \App\adms\Models\AdmsEditProfile();
      $editProfile->viewEditProfile();
      if ($editProfile->getResult()) {
        $this->data['form'] = $editProfile->getResultBd();
        $this->viewEditProfile();
      } else {
        $urlRedirect = URLADM . "login/index";
        header("location:  $urlRedirect");
      }

      //  $this->editUser();
    }
  }
  private function editProfile(): void
  {
    if (isset($this->dataForm['sendEditProfile'])) {
      unset($this->dataForm['sendEditProfile']);
      $admsEditProfile = new \App\adms\Models\AdmsEditProfile();
      $admsEditProfile->update($this->dataForm);

      if ($admsEditProfile->getResult()) {
        $urlRedirect = URLADM . "view-profile/index/" . $_SESSION['user_id'];
        header("location:  $urlRedirect");
      } else {
        $this->data['form'] = $this->dataForm;
        $this->viewEditProfile();
      }
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Perfil não encontrado<p>";
      $urlRedirect = URLADM . "login/index";
      header("location:  $urlRedirect");
    }
  }
  
  private function viewEditProfile(): void
  {
   
    $viewCon = new \Core\ConfigView("adms/Views/profile/editProfile", $this->data);
    $viewCon->loadViewLogin();
  }
}
