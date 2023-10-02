<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

class Erro
{

  private array|string|null $data;

  public function index(): void
  {
    echo "pagian Erro Controllers <br>";
    $this->data = "<p style='color:#f00;'>pagina redirecionada Erro</p>";
    $viewCon = new \Core\ConfigView("adms/Views/err/erro", $this->data);
    $viewCon->loadView();
  }
}
