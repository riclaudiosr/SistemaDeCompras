<?php

namespace App\adms\Controllers;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}
//CONTROLLER EDITAR USERS

class EditeProduto
{
  private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO
  private array|null $data = []; //RECEBE OS DADOS DA CONTROLE 
  private array|null $dataForm; //$dataForm, recebe os dados do formulario

  public function index(int|string|null $id = null): void
  {
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if ((!empty($id)) and (!empty($this->dataForm['sendEditProduto']))) {
      $this->id = (int) $id;
      $editeUser = new \App\adms\Models\AdmsEditeProduto();
      $editeUser->editProduto($this->id);
      if ($editeUser->getResult()) {
        $this->data['form'] = $editeUser->getResultBd();
        $this->editProduto($this->id);
      }
    } else {

    $this->viewEditProduto();
    }
  }
  private function editProduto(int|null $id = null): void
  {

    if (isset($this->dataForm['sendEditProduto'])) {
      unset($this->dataForm['sendEditProduto']);
      if (empty($this->dataForm['quantidade'])) {
        unset($this->dataForm['quantidade']);
      }
      if (empty($this->dataForm['valor_unitario'])) {
        unset($this->dataForm['valor_unitario']);
      }
      $admsEditUser = new \App\adms\Models\AdmsEditeProduto();
      $admsEditUser->upDate($this->dataForm, $id);
      
      if ($admsEditUser->getResult()) {
        $urlRedirect = URLADM . "dashboard/index/" . $this->id;
          header("location:  $urlRedirect");
      } else {
        $this->data['form'] = $this->dataForm;
         $this->viewEditProduto();
      }
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario não encontrado<p>";
      $urlRedirect = URLADM . "list-users/index";
    }
  }
  private function viewEditProduto(): void
  {
    $listSelect = new \App\adms\Models\AdmsEditeUsers;
    $this->data['select'] = $listSelect->listSelect();
    $viewCon = new \Core\ConfigView("adms/Views/compras/editProduto", $this->data);
    $viewCon->loadViewHome();
  }
}
