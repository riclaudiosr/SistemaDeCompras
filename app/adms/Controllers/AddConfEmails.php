<?php

namespace App\adms\Controllers;

if(!defined('RSR1937NA')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

class AddConfEmails
{
    private array|string|null $data = []; // $data Recebe os dados que devem ser enviados para VIEW 
    private array|null $dataForm; //$dataForm Recebe os dados do formulario 

    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);        

        if(!empty($this->dataForm['SendAddConfEmails'])){
            //var_dump($this->dataForm);
            unset($this->dataForm['SendAddConfEmails']);
            $createConfEmails = new \App\adms\Models\AdmsAddConfEmails();
            $createConfEmails->create($this->dataForm);
            if($createConfEmails->getResult()){
                $urlRedirect = URLADM . "list-conf-emails/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewAddConfEmails();
            }   
        }else{
            $this->viewAddConfEmails();
        }  
    }
    private function viewAddConfEmails(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/confEmails/addConfEmails", $this->data);
        $loadView->loadView();
    }
}
