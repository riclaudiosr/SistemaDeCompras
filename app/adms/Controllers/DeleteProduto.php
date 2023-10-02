<?php

namespace App\adms\Controllers;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}
//CONTROLLER EDITAR USERS

class DeleteProduto

{
  private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO
  private array $dataForm;
  private array $data;

  public function index(int|string|null $id = null): void
  {
    //  $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    // var_dump($id);

    if (!empty($id)) {
      $this->id = (int) $id;
      $deleteUser = new \App\adms\Models\AdmsDeleteProduto();
      $deleteUser->deleteProduto($this->id);

      if ($deleteUser->getResult()) {
        $listDados = new \App\adms\Models\AdmsListCompras();
        $listDados->listCompras();
        if ($listDados->getResultBd()) {
          $this->data['result'] = $listDados->getResultBd();
          $this->data['pagination'] = $listDados->getResultPg();
          $this->data['datCompra'] = date("d-M-Y");
          $_SESSION['msg'] = "<p style='color:#0f0;'>Erro: Produto Apagado com Sucesso! <p>";
          $this->loadHome();
        }
      } else {
        $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Produto Nao Apagado corretamento!<p>";
        $urlRedirect = URLADM . "dashboard/index";
        header("location:  $urlRedirect");
      }
    }
  }
  private function loadHome(): void
  {
    $viewCon = new \Core\ConfigView("adms/Views/users/dashboard", $this->data);
    $viewCon->loadViewHome();
  }
}
