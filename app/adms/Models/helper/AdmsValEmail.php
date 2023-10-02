<?php
namespace App\adms\Models\helper;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }
   
//ARQUIVO RELPE DE VALIDAÇÃODE EMAIL
class AdmsValEmail
{
    private string $email;
    private bool $result;
    public function getResult():bool
    {
    return $this->result;
    }
    public function validateEmail(string $email):void
    {
     $this->email = $email;
     if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
      $this->result = true;
     }else{
      $_SESSION['msg'] = "<p style='color:#f00';>Erro Email Invalido!</p>";
      $this->result = false;
     }
    }
}