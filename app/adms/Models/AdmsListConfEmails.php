<?php

namespace App\adms\Models;

if(!defined('RSR1937NA')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}


// Listar a configuração de emails do banco de dados

class AdmsListConfEmails
{
    private bool $result;//$result Recebe true quando executar o processo com sucesso e false quando houver erro 
    private array|null $resultBd;// $resultBd Recebe os registros do banco de dados 
    private int $page;// $page Recebe o número página 
    private int $limitResult = 10;// $page Recebe a quantidade de registros que deve retornar do banco de dados  
    private string|null $resultPg;//$page Recebe a páginação 

   
    function getResult(): bool
    {
        return $this->result;
    }
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    public function listConfEmails(int $page = null):void
    {
        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-conf-emails/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_confs_emails");
        $this->resultPg = $pagination->getResult();

        $listConfEmails = new \App\adms\Models\helper\AdmsRead();
        $listConfEmails->fullRead("SELECT id, title, name, email
                FROM adms_confs_emails
                ORDER BY id DESC
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listConfEmails->getResult();        
        if($this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum e-mail encontrado!</p>";
            $this->result = false;
        }
    }    
}
