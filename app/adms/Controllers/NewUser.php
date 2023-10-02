<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

class NewUser
{
    private array|null $data = [];
    //$dataForm, recebe os dados do formulario
    private array|null $dataForm;
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
       
        if (!empty($this->dataForm['sendNewUser'])) {
          unset($this->dataForm['sendNewUser']);
        //  var_dump($this->dataForm);
            $creatNewuser = new \App\adms\Models\AdmsNewUser();
            $creatNewuser->creatUsr($this->dataForm);

            if ($creatNewuser->getResult()) {
                $urlRedirect = URLADM . "list-users/index";
              header("location:  $urlRedirect");
             //  var_dump($this->dataForm);
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewNewUser();
            }
        } else {
            $this->viewNewUser();
        }
        //  $this->data = null;
    }
    private function viewNewUser(): void
    {
        $viewCon = new \Core\ConfigView("adms/Views/login/newUser", $this->data);
        $viewCon->loadView();
    }
}
