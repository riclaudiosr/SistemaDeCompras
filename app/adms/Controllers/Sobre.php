<?php
namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
class Sobre
{ 
    public function index():void
    {
        $this->data = [];
        echo "Pagina controle Sobre<br>";
      $viewCon = new \Core\ConfigView("adms/Views/sobre/sobre",$this->data);
      $viewCon->loadView();
        
    }
}