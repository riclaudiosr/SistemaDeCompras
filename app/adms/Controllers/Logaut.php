<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

class Logaut
{
  //destruis os dados das variaveis glabais, do usuario logado
  public function index(): void
  {
    unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_nickname'], $_SESSION['user_email']);
    $_SESSION['msg'] = "<p style='color:green;'>Erro: logaut Realizado com sucesso<p>";
    $urlRedirect = URLADM . "Login/index";
    header("location:  $urlRedirect");
  }
}
