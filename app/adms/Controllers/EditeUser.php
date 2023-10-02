<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
//CONTROLLER EDITAR USERS

class EditeUser
{
    private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO
    private array|null $data = []; //RECEBE OS DADOS DA CONTROLE 
    private array|null $dataForm; //$dataForm, recebe os dados do formulario

    public function index(int|string|null $id = null): void
    {  
       $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
        if((!empty($id)) and (empty($this->dataForm['sendEditUser']))){
          //  var_dump($this->dataForm);
            $this->id = (int) $id;
           $editeUser = new \App\adms\Models\AdmsEditeUsers();
           $editeUser->editUser($this->id);
           if($editeUser->getResult()){
            $this->data['form']= $editeUser->getResultBd();
            $this->viewEditUser();
           }else{
            $urlRedirect = URLADM . "list-users/index";
            header("location:  $urlRedirect");
           }
        }else{
         
            $this->editUser();
        }
    }
    private function editUser():void
    {
        if(isset($this->dataForm['sendEditUser'])){
            unset($this->dataForm['sendEditUser']);
          $admsEditUser = new \App\adms\Models\AdmsEditeUsers();
          $admsEditUser->upDate($this->dataForm);
          if($admsEditUser->getResult()){
            $urlRedirect = URLADM . "view-user/index/".$this->dataForm['id'];
            header("location:  $urlRedirect");
          }else{
                $this->data['form']=$this->dataForm;
                $this->viewEditUser();
          }
        }else{
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario não encontrado<p>";
            $urlRedirect = URLADM . "list-users/index";
            header("location:  $urlRedirect");
        }
    }
     private function viewEditUser(): void
    {
      $listSelect = new \App\adms\Models\AdmsEditeUsers;
      $this->data['select'] = $listSelect->listSelect();
        $viewCon = new \Core\ConfigView("adms/Views/users/editUser", $this->data);
        $viewCon->loadViewLogin();
    }
}
