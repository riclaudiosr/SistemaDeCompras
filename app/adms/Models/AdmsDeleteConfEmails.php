<?php

namespace App\adms\Models;

if (!defined('RSR1937NA')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

 //Apagar a configuração de email no banco de dados

class AdmsDeleteConfEmails
{
    private bool $result = false; //$result Recebe true quando executar o processo com sucesso e false quando houver erro 
    private int|string|null $id; // $id Recebe o id do registro 
    private array|null $resultBd;//$resultBd Recebe os registros do banco de dados 

    function getResult(): bool
    {
        return $this->result;
    }

    public function deleteConfEmails(int $id): void
    {
        $this->id = (int) $id;

        if ($this->viewConfEmails()) {
            $deleteConfEmails = new \App\adms\Models\helper\AdmsDelete();
            $deleteConfEmails->exeDelete("adms_confs_emails", "WHERE id =:id", "id={$this->id}");

            if ($deleteConfEmails->getResult()) {
                $_SESSION['msg'] = "<p style='color: green;'>Configuração de email apagada com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Configuração de email não apagada com sucesso!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    private function viewConfEmails(): bool
    {

        $viewConfEmails = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmails->fullRead("SELECT id FROM adms_confs_emails WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewConfEmails->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Configuração de email não encontrada!</p>";
            return false;
        }
    }
}
