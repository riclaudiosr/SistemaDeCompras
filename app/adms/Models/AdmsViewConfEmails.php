<?php

namespace App\adms\Models;

if(!defined('RSR1937NA')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}


// Visualizar a configuração de email no banco de dados

class AdmsViewConfEmails
{
    private bool $result = false; //$result Recebe true quando executar o processo com sucesso e false quando houver erro 
    private array|null $resultBd; // $resultBd Recebe os registros do banco de dados 
    private int|string|null $id;//$id Recebe o id do registro 
    function getResult(): bool
    {
        return $this->result;
    }
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    public function viewConfEmails(int $id): void
    {
        $this->id = $id;

        $viewConfEmails = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmails->fullRead("SELECT id, title, name, email, host, username, smtpsecure, port, created, modified
                    FROM adms_confs_emails 
                    WHERE id=:id
                    LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewConfEmails->getResult();        
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: E-mail não encontrado!</p>";
            $this->result = false;
        }
    }
}
