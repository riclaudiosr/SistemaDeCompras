<?php

namespace App\adms\Models;

if(!defined('RSR1937NA')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

// Cadastrar configuração de email no banco de dados
class AdmsAddConfEmails
{
    
    private array|null $data;//$data Recebe as informações do formulário 
    private bool $result; //$result Recebe true quando executar o processo com sucesso e false quando houver erro 

    function getResult(): bool
    {
        return $this->result;
    }

     public function create(array $data = null): void
    {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if ($valEmptyField->getResult()) {
            $this->add();
        } else {
            $this->result = false;
        }
    }
    private function add(): void
    {        
        $this->data['created'] = date("Y-m-d H:i:s");

        $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_confs_emails", $this->data);

        if ($createUser->getResult()) {
            $_SESSION['msg'] = "<p style='color: green;'>Configuração de e-mail cadastrada com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Configuração de e-mail não cadastrado com sucesso!</p>";
            $this->result = false;
        }
    }
}
