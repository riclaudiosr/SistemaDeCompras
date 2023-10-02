<?php
namespace App\adms\Models;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

//ARQUIVO PARA VIZUALIZAR USUARIO
class AdmsViewUsers
{
  private array|null $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
  private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO

 //RECEBE O RESULTADO DA CLASSE E RETORNA OS REGISTRO DO BANCO
  public function getResult():bool
  {
    return $this->result;
  }
//RECEBE O RESULTADO DA BUSCA NO BANCO, E RETORNA
  public function getResultBd():array|null
  {
    return $this->resultBd;
  }

  public function viewUsr(int $id):void
  {
    $this->id = $id;
  $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
  $viewAdmsRead->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.nickname, usr.user, usr.image,
                                 usr.adms_sits_user_id, usr.created, usr.modified,
                              sit.name AS name_sit, color_sit.color AS color_sit
                              FROM adms_users AS usr
                              INNER JOIN adms_sits_users AS sit ON sit.id = usr.adms_sits_user_id
                              INNER JOIN adms_colors AS color_sit ON color_sit.id = sit.adms_color_id
                              WHERE usr.id=:id
                              LIMIT :limit",
                              "id={$this->id}&limit=1");
  $this->resultBd = $viewAdmsRead->getResult();
  if($this->resultBd){
   // var_dump( $this->resultBd);
    $this->result = true;
  }else{
    $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario não encontrado!<p>";
 $this->result = false;
  }
  }
}
