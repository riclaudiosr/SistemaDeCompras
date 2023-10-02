<?php

namespace App\adms\Models;

if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
//ARQUIVO PARA APAGAR USUARIO NO BANCO DE DADOS
class AdmsDeleteUser
{

  private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private int $id; // RECEBE O ID PASSADO COMO PARAMETRO
  private array|null $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
  private string $delDirectory; //$diretório Recebe o endereço para excluir a imagem 
  private  string $delImg; //RECEBE A IMAGEM PARA SER DELETADA
  //RECEBE O RESULTADO DA CLASSE E RETORNA O RESULTADO DA CLASSE
  public function getResult(): bool
  {
    return $this->result;
  }

  public function deleteUser(int $id): void
  {
    $this->id = (int) $id;
    if ($this->viewUser()) {
      var_dump($this->resultBd[0]);

      $deleteUser = new \App\adms\Models\helper\AdmsDelete();
      $deleteUser->exeDelete("adms_users", "WHERE id =:id ", "id={$this->id}");
      if ($deleteUser->getResult()) {
        $this->deliteImg();

        $_SESSION['msg'] = "<p style='color:green;'>Usuário Apagado com sucesso!<p>";
        $this->result = true;
      } else {
        $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não Apagado com sucesso!<p>";
        $this->result = false;
      }
    } else {
      $this->result = false;
    }
  }
  //busca os dados no banco de 
  private function viewUser(): bool
  {
    $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
    $viewAdmsRead->fullRead("SELECT id, image FROM adms_users WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");
    $this->resultBd = $viewAdmsRead->getResult();
    if ($this->resultBd) {

      return true;

    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario não encontrado!<p>";
      return false;
    }
  }
  //deleta a imagem e o diretório 
  private function deliteImg(): void
  {
    if ((!empty($this->resultBd[0]['image'])) or ($this->resultBd[0]['image'] != null)) {
      $this->delDirectory = "app/adms/assets/img/users/" . $this->resultBd[0]['id'];
      $this->delImg = $this->delDirectory . "/" . $this->resultBd[0]['image'];

      if (file_exists($this->delImg)) {
        unlink($this->delImg);
      }
      
      if (file_exists($this->delDirectory)) {
        rmdir($this->delDirectory);
      }
    }
  }
}
