<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

class NewConEmail
{
    private array|null $data = [];
    //$dataForm, recebe os dados do formulario
    private array|null $dataForm;

    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dataForm['sendNewConEmail'])) {
            unset($this->dataForm['sendNewConEmail']);
            
            $newConfEmail =  new \App\adms\Models\AdmsNewConfEmail();
            $newConfEmail->newConfEmail($this->dataForm);

            if ($newConfEmail->getResult()) {
                $urlRedirect = URLADM ."login/index";
                header("location:  $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->newConfEmail();
            }
        } else {
            $this->newConfEmail();
        }
    }
    private function newConfEmail(): void
    {
        $viewCon = new \Core\ConfigView("adms/Views/login/newConfEmail", $this->data);
        $viewCon->loadView();
    }
}
