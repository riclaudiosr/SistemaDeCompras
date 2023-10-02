<?php
namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
class DataBank
{ 
  private array|null $data = [];
    public function index():void
    {
      
     //   echo "Pagina controle dataBank<br>";
      $viewCon = new \Core\ConfigView("adms/Views/banco/dataBank",$this->data);
      $viewCon->loadViewLogin();
        
    }
}