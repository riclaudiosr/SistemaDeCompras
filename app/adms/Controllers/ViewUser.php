<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

class ViewUser
{

  private array|string|null $data; // recebe os dados que deve ser enviado
  private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO

  public function index(string|int|null $id = null): void

  {

    if (!empty($id)) {
      $this->id = (int) $id;
      $viewUser = new \App\adms\Models\AdmsViewUsers();
      $viewUser->viewUsr($this->id);
      if ($viewUser->getResult()) {
        $this->data['viewUser'] = $viewUser->getResultBd();
    //    var_dump( $this->data['viewUser']);
       $this->viewUser();
      } else {
        $urlRedirect = URLADM . "list-users/index";
        header("location:  $urlRedirect");
      }
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario não encontrado<p>";
      $urlRedirect = URLADM . "list-users/index";
      header("location:  $urlRedirect");
    }
  }
  private function viewUser(): void
  {
    $viewCon = new \Core\ConfigView("adms/Views/users/viewUser", $this->data);
    $viewCon->loadViewLogin();
  }
}
