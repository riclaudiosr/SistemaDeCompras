<?php
namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
class ResultMes
{ 
  private array|null $data = [];
    public function index():void
    {

      $listCompras = new \App\adms\Models\AdmsAddResultMes();
      $listCompras->addResultMes($_POST);
      
      $this->data = ["ola valor resulte mes"];
      //  echo "Pagina controle dataBank<br>";
      $viewCon = new \Core\ConfigView("adms/Views/users/dashboard",$this->data);
     $viewCon->loadViewLogin();
        
    }
}