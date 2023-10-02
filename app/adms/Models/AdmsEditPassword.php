<?php

namespace App\adms\Models;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}


//ARQUIVO PARA EDITAR A SENHA DO USUARIO NO BANCO DE DADOS
class AdmsEditPassword
{
  private array|null $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
  private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO
  private array|null $data; // RECEBE OS DADOS DO FORMULARIO

  //RECEBE O RESULTADO DA CLASSE E RETORNA OS REGISTRO DO BANCO
  public function getResult(): bool
  {
    return $this->result;
  }
  //RECEBE O RESULTADO DA BUSCA NO BANCO, E RETORNA
  public function getResultBd(): array|null
  {
    return $this->resultBd;
  }

  public function editPassword(string|int|null $id): void
  {
    $this->id = $id;
    $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
    $viewAdmsRead->fullRead(
      "SELECT id FROM adms_users WHERE id=:id LIMIT :limit",
      "id={$this->id}&limit=1"
    );
    $this->resultBd = $viewAdmsRead->getResult();
    if ($this->resultBd) {
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario não encontrado!<p>";
      $this->result = false;
    }
  }
  public function upDate(array $data = null): void
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
  //METODO PARA VALIDAR A SENHA 
  private function valInput(): void
  {
    $valpassword = new \App\adms\Models\helper\AdmsValPassword();
    $valpassword->validatePassword($this->data['password']);

    if ($valpassword->getResult()) {

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
    $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id{$this->data['id']}");

    if ($upUser->getResult()) {
      $_SESSION['msg'] = "<p style='color:green;'> Senha Editada com Secesso!</p>";
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Senha do Usuário Nao Editado </p>";
      $this->result = false;
    }
  }
}
