<?php

namespace App\adms\Controllers;

if (!defined('RSR1937NA')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

//CONTROLER DE EDITAR EMAIL TABEM USERS_EMAIL
class EditConfEmails
{
    private array|string|null $data = []; // $data Recebe os dados que devem ser enviados para VIEW 
    private array|null $dataForm;//$dataForm Recebe os dados do formulario 
    private int|string|null $id;//$id Recebe o id do registro 

    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditConfEmails']))) {
            $this->id = (int) $id;
            $viewConfEmails = new \App\adms\Models\AdmsEditConfEmails();
            $viewConfEmails->viewConfEmails($this->id);
            if ($viewConfEmails->getResult()) {
                $this->data['form'] = $viewConfEmails->getResultBd();
                $this->viewEditConfEmails();
            } else {
                $urlRedirect = URLADM . "list-conf-emails/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editConfEmails();
        }
    }
    private function viewEditConfEmails(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/confEmails/editConfEmails", $this->data);
        $loadView->loadView();
    }
    private function editConfEmails(): void
    {
        if (!empty($this->dataForm['SendEditConfEmails'])) {
            unset($this->dataForm['SendEditConfEmails']);
            $editConfEmails = new \App\adms\Models\AdmsEditConfEmails();
            $editConfEmails->update($this->dataForm);
            if ($editConfEmails->getResult()) {
                $urlRedirect = URLADM . "view-conf-emails/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditConfEmails();
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Configuração de email não encontrada!</p>";
            $urlRedirect = URLADM . "list-conf-emails/index";
            header("Location: $urlRedirect");
        }
    }
}
