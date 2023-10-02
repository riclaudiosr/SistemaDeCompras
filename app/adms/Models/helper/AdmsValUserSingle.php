<?php

namespace App\adms\Models\helper;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }
   
//ARQUIVO RELPE PARA VALIDAR USUARIO, PARA QUE NÃO HAJA DOIS USUARIOS COM MESMO NOME

class AdmsValUserSingle
{
    private string $user; //RECEBE O USER DA EXECUÇÃO
    private bool|null $edit; // RECEBE O USER PARA CADASTRO OU EDIÇÃO
    private int|null $id; // RECEBE O USUARIO QUE DEVE SER IGINORADO PARA O CADASTRO
    private bool $result; // RECEBE O RESULTADO DE VERDADEIRO OU FALSO DA EXECUÇÃO
    private array|null $resultDb; // RECEBE OS REGISTROS DO BANCO DE DADOS

    public function getResult(): bool
    {
        return $this->result;
    }
    public function validateUserSingle(string $user, bool|null $edit = null, int|null $id = null): void
    {
        $this->user = $user;
        $this->edit = $edit;
        $this->id = $id;
        $valUserSingle = new \App\adms\Models\helper\AdmsRead();
        if (($this->edit == true) and (!empty($this->id))) {
            $valUserSingle->fullRead("SELECT id FROM adms_users WHERE
                             (user =:user) 
                             AND id <>:id LIMIT :limit", 
                             "user={$this->user}&id={$this->id}&limit=1");
        } else {
            $valUserSingle->fullRead("SELECT id FROM adms_users  WHERE user =:user LIMIT :limit", "user={$this->user}&limit=1");
        }
        $this->resultDb = $valUserSingle->getResult();
        if(!$this->resultDb){
            $this->result=true;
        }else{
            $_SESSION['msg']= "<p style ='color:#f00;'>Este Usuário já esta Sendo Utilizadoo</p>";
            $this->result= false;
        }
    }
}
