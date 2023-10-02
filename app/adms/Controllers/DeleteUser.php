<?php

namespace App\adms\Controllers;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}
//CONTROLLER EDITAR USERS

class DeleteUser

{
  private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO
  private array $dataForm;

  public function index(int|string|null $id = null): void
  {
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($id)) {
      $this->id = (int) $id;
      $deleteUser = new \App\adms\Models\AdmsDeleteUser();
      $deleteUser->deleteUser($this->id);
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Necessário selecionar o usuario!<p>";
    }
    $urlRedirect = URLADM . "list-users/index";
    header("location:  $urlRedirect");
  }
}
