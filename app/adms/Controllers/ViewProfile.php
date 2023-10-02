<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
// pagina de vizualização do usuário
class ViewProfile
{
  private array|string|null $data; // recebe os dados que deve ser enviado
  
  public function index(): void

  {
      $viewProfile = new \App\adms\Models\AdmsViewProfile();
      $viewProfile->viewProfile();
      
      if ($viewProfile->getResult()) {
        
        $this->data['viewProfile'] = $viewProfile->getResultBd();

        $this->loadViewProfile();
      } else {
        $urlRedirect = URLADM . "login/index";
        header("location:  $urlRedirect");
      }
   
  }

  private function loadViewProfile(): void
  {
    $viewCon = new \Core\ConfigView("adms/Views/profile/viewProfile", $this->data);
    $viewCon->loadViewLogin();
 
  }
}
