<?php

namespace App\adms\Models;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

//ARQUIVO PARA EDITAR USUARIO NO BANCO DE DADOS
class AdmsEditeUsers
{
  private array|null $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
  private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO
  private array|null $data; // RECEBE OS DADOS DO FORMULARIO
  private $listRegistryAdd;
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

  public function editUser(string|int|null $id): void
  {
    $this->id = $id;
    $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
    $viewAdmsRead->fullRead(
      "SELECT id,name,email,nickname,user,adms_sits_user_id
                              FROM adms_users
                              WHERE id=:id
                              LIMIT :limit",
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
  private function valInput(): void
  {
    $valEmail = new \App\adms\Models\helper\AdmsValEmail();
    $valEmail->validateEmail($this->data['email']);

    $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
    $valEmailSingle->validateEmailSingle($this->data['email'], true, $this->data['id']);

    $valUserSingle = new \App\adms\Models\helper\AdmsValUserSingle();
    $valUserSingle->validateUserSingle($this->data['user'], true, $this->data['id']);

    if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valUserSingle->getResult())) {

      $this->edit();
      //  $this->result = false;
    } else {
      $this->result = false;
    }
  }
  private function edit(): void
  {
    $this->data['modified'] = date("Y-m-d H:i:s");
    $upUser = new \App\adms\Models\helper\AdmsUpdate();
    $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id{$this->data['id']}");
    if ($upUser->getResult()) {
      $_SESSION['msg'] = "<p style='color:green;'> Usuario Editdo com Secesso!</p>";
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario Nao Editado </p>";
      $this->result = false;
    }
  }
  public function listSelect(): array
  {
    $list = new \App\adms\Models\helper\AdmsRead();
    $list->fullRead("SELECT id AS id_sit, name AS name_sit FROM adms_sits_users ORDER BY name ASC");

    $registry['sit'] = $list->getResult();
    $this->listRegistryAdd = ['sit' => $registry['sit']];
    return $this->listRegistryAdd;
  }
}
