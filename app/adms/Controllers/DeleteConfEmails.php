<?php

namespace App\adms\Controllers;

if(!defined('RSR1937NA')){
   header("Location: /");
    die("Erro: Página não encontrada<br>");
}
 //CONTROLER DE DELETAR EMAIL NA TABELA USERS_EMAIL
class DeleteConfEmails
{
    private int|string|null $id;//$id Recebe o id do registro 
    public function index(int|string|null $id = null): void
    {

        if (!empty($id)) {
            $this->id = (int) $id;
            $deleteConfEmails = new \App\adms\Models\AdmsDeleteConfEmails();
            $deleteConfEmails->deleteConfEmails($this->id);            
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário selecionar uma configuração de email!</p>";
        }

        $urlRedirect = URLADM . "list-conf-emails/index";
        header("Location: $urlRedirect");

    }
}
