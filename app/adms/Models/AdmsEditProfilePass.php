<?php
namespace App\adms\Models;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
//ARQUIVO PARA Editar a senha do  perfil do usuaário USUARIO
class AdmsEditProfilePass
{
  private array $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
  private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private array|null $data; // $data Recebe as informações do formulário 

  //RECEBE O RESULTADO DA CLASSE E RETORNA OS REGISTRO DO BANCO
  public function getResult(): bool
  {
    return $this->result;
  }
  //RECEBE O RESULTADO DA BUSCA NO BANCO, E RETORNA
  public function getResultBd(): array
  {
    return $this->resultBd;
  }

  public function viewEditProfile(): void
  {

    $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
    $viewAdmsRead->fullRead("SELECT id  FROM adms_users WHERE id=:id LIMIT :limit", "id=" . $_SESSION['user_id'] . "&limit=1");
    $this->resultBd = $viewAdmsRead->getResult();

    if ($this->resultBd) {
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Perfil não encontrado!!<p>";
      $this->result = false;
    }
  }
  public function update(array $data = null): void
  {
    $this->data = $data;

    $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
    $valEmptyField->valField($this->data);
    //intanciar o resultado da validação, dentro de uma condição
    if ($valEmptyField->getResult()) {

      $this->valInput();
    } else {
      $this->result = false;
    }
  }
  private function valInput(): void
  {
    $valpassword = new \App\adms\Models\helper\AdmsValPassword();
    $valpassword->validatePassword($this->data['password']);
    if ($valpassword->getResult()){ 
      $this->edit();
    } else {
      $this->result = false;
    }
  }
  private function edit(): void
  {
    $this->data['modified'] = date("Y-m-d H:i:s");
    $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);

    $upUser = new \App\adms\Models\helper\AdmsUpdate();
    $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id=" . $_SESSION['user_id']);
    
    if ($upUser->getResult()) {
      $_SESSION['msg'] = "<p style='color:green;'>Senha do Perfil Editdo com Secesso!</p>";
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro:Senha do perfil não editado </p>";
      $this->result = false;
    }
  }
}
