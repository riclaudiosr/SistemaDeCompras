<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

class Login
{
    private array|null $data = [];
    //$dataForm, recebe os dados do formulario
    private array|null $dataForm;
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['sendLogin'])) {
           //  var_dump($this->dataForm);
           $valLogin = new \App\adms\Models\AdmsLogin();
           $valLogin->login($this->dataForm);
           
            if($valLogin->getResult()){
               $urlRedirect =URLADM ."dashboard/index";
               header("location:  $urlRedirect");
            }else{
                 $this->data['form'] = $this->dataForm;
            }
        }
        $viewCon = new \Core\ConfigView("adms/Views/login/login", $this->data);
        $viewCon->loadView();
    }
}
