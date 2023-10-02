<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

//CONTROLLER EDITAR perfil usuário
class EditProfilePassword
{
  private array|null $data = []; //RECEBE OS DADOS DA CONTROLE 
  private array|null $dataForm; //$dataForm, recebe os dados do formulario

  public function index(): void
  {
    
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($this->dataForm['sendEditProfilePass'])) {
     $this->editProfilePass();
    } else {
      $editProfilePass = new \App\adms\Models\AdmsEditProfilePass();
      $editProfilePass->viewEditProfile();
      if ($editProfilePass->getResult()) {
        $this->data['form'] = $editProfilePass->getResultBd();
        $this->viewEditProfilePass();
      } else {
        $urlRedirect = URLADM . "login/index";
        header("location:  $urlRedirect");
      }

      //  $this->editUser();
    }
  }
  private function editProfilePass(): void
  {
    if (isset($this->dataForm['sendEditProfilePass'])) {
      unset($this->dataForm['sendEditProfilePass']);
      $admsEditProfilePass = new \App\adms\Models\AdmsEditProfilePass();
      $admsEditProfilePass->update($this->dataForm);

      if ($admsEditProfilePass->getResult()) {
        $urlRedirect = URLADM . "view-profile/index/" . $_SESSION['user_id'];
        header("location:  $urlRedirect");
      } else {
        $this->data['form'] = $this->dataForm;
        $this->viewEditProfilePass();
      }
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Perfil não encontrado<p>";
      $urlRedirect = URLADM . "login/index";
      header("location:  $urlRedirect");
    }
  }
  
  private function viewEditProfilePass(): void
  {
   
    $viewCon = new \Core\ConfigView("adms/Views/profile/editProfilePass", $this->data);
    $viewCon->loadViewLogin();
  }
}
