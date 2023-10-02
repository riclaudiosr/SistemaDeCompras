<?php
namespace App\adms\Models;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

//ARQUIVO PARA VIZUALIZAR USUARIO
class AdmsViewProfile
{
  private array $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
  private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
 

 //RECEBE O RESULTADO DA CLASSE E RETORNA OS REGISTRO DO BANCO
  public function getResult():bool
  {
    return $this->result;
  }
//RECEBE O RESULTADO DA BUSCA NO BANCO, E RETORNA
  public function getResultBd():array
  {
    return $this->resultBd;
  }

  public function viewProfile():void
  {
  
  $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
  $viewAdmsRead->fullRead("SELECT id, name,nickname, email, image FROM adms_users WHERE id=:id LIMIT :limit","id=".$_SESSION['user_id']."&limit=1");
  $this->resultBd = $viewAdmsRead->getResult();
    
  if($this->resultBd){
    $this->result = true;
  }else{
    $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Perfil não encontrado!!<p>";
 $this->result = false;
  }
  }
}
