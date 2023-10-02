<?php

namespace App\adms\Models;

if(!defined('RSR1937NA')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}


 //Editar a configuração de email no banco de dados

class AdmsEditConfEmails
{
    private bool $result = false;//$result Recebe true quando executar o processo com sucesso e false quando houver erro 
    private array|null $resultBd;//$resultBd Recebe os registros do banco de dados 
    private int|string|null $id; // $id Recebe o id do registro 
    private array|null $data;//$data Recebe as informações do formulário 

    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function viewConfEmails(int $id): void
    {
        $this->id = $id;

        $viewConfEmails = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmails->fullRead("SELECT id, title, name, email, host, username, smtpsecure, port
            FROM adms_confs_emails
            WHERE id=:id
            LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewConfEmails->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Configuração de email não encontrada!</p>";
            $this->result = false;
        }
    }

    public function update(array $data = null): void
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }
    private function edit(): void
    {
        $upConfEmails = new \App\adms\Models\helper\AdmsUpdate();
        $upConfEmails->exeUpdate("adms_confs_emails", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if ($upConfEmails->getResult()) {
            $_SESSION['msg'] = "<p style='color: green;'>Configuração de email editada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Configuração de email não editada com sucesso!</p>";
            $this->result = false;
        }
    }

}
