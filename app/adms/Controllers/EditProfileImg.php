<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
//CONTROLLER EDITAR imagem do perfil usuário
class EditProfileImg
{
  private array|null $data = []; //RECEBE OS DADOS DA CONTROLE 
  private array|null $dataForm; //$dataForm, recebe os dados do formulario

  public function index(): void
  {   
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($this->dataForm['SendEditProfimg'])) {
     $this->editProfileImg();
    } else {
      $editProfileImg = new \App\adms\Models\AdmsEditProfileImg();
     $editProfileImg->viewEditProfileImg();
      if ($editProfileImg->getResult()) {
        $this->data['form'] = $editProfileImg->getResultBd();
        $this->viewEditProfileimage();
      } else {
        $urlRedirect = URLADM . "login/index";
        header("location:  $urlRedirect");
      }
    }
  }
  //EDITAR IMAGEM DO PERFIL
  private function editProfileImg(): void
  {
    if (isset($this->dataForm['SendEditProfimg'])) {
      unset($this->dataForm['SendEditProfimg']);

      $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;

      $admsEditProfileImg = new \App\adms\Models\AdmsEditProfileImg();
      $admsEditProfileImg->update($this->dataForm);

      if ($admsEditProfileImg->getResult()) {
        $urlRedirect = URLADM . "view-profile/index/" . $_SESSION['user_id'];
        header("location:  $urlRedirect");
      } else {
        $this->data['form'] = $this->dataForm;
        $this->viewEditProfileImage();
      }
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Perfil não encontrado<p>";
      $urlRedirect = URLADM . "login/index";
      header("location:  $urlRedirect");
    }
  }
  //METODO DE DIRECIONAMENTE PARA A PAGINA VIEW DO EDITAR IMAGEM
  private function viewEditProfileImage(): void
  {   
    $viewCon = new \Core\ConfigView("adms/Views/profile/editProfileImage", $this->data);
    $viewCon->loadViewLogin();
  }
}
