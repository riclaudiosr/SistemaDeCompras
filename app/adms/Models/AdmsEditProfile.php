<?php

namespace App\adms\Models;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

//ARQUIVO PARA Editar o perfil do usuaário USUARIO
class AdmsEditProfile
{
  private array $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
  private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE


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
    $viewAdmsRead->fullRead("SELECT id,name,nickname,email,user  FROM adms_users WHERE id=:id LIMIT :limit", "id=" . $_SESSION['user_id'] . "&limit=1");
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
    $valEmail = new \App\adms\Models\helper\AdmsValEmail();
    $valEmail->validateEmail($this->data['email']);

    $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
    $valEmailSingle->validateEmailSingle($this->data['email'], true, $_SESSION['user_id']);

    $valUserSingle = new \App\adms\Models\helper\AdmsValUserSingle();
    $valUserSingle->validateUserSingle($this->data['user'], true, $_SESSION['user_id']);

    if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valUserSingle->getResult())) {
      $this->edit();
    } else {
      $this->result = false;
    }
  }
  private function edit(): void
  {
    $this->data['modified'] = date("Y-m-d H:i:s");
    $upUser = new \App\adms\Models\helper\AdmsUpdate();
    $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id=" . $_SESSION['user_id']);
    if ($upUser->getResult()) {
      //  $_SESSION['user_id'] = $this->result_bd[0]['id'];
      $_SESSION['user_name'] = $this->data['name'];
      $_SESSION['user_nickname'] = $this->data['nickname'];
      $_SESSION['user_email'] = $this->data['email'];
      $_SESSION['user_user'] = $this->data['user'];
      //   $_SESSION['user_image'] = $this->result_bd[0]['image'];
      $_SESSION['msg'] = "<p style='color:green;'> Perfil Editdo com Secesso!</p>";
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Perfil Nao Editado </p>";
      $this->result = false;
    }
  }
}
