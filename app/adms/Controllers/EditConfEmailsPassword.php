<?php

namespace App\adms\Controllers;

if (!defined('RSR1937NA')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

class EditConfEmailsPassword
{
    private array|string|null $data = [];//$data Recebe os dados que devem ser enviados para VIEW 
    private array|null $dataForm;//$dataForm Recebe os dados do formulario 
    private int|string|null $id; //$id Recebe o id do registro 

    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditConfEmailsPass']))) {
            $this->id = (int) $id;
            $viewConfEmailsPass = new \App\adms\Models\AdmsEditConfEmailsPassword();
            $viewConfEmailsPass->viewConfEmailsPassword($this->id);
            if ($viewConfEmailsPass->getResult()) {
                $this->data['form'] = $viewConfEmailsPass->getResultBd();
                $this->viewEditConfEmailsPassword();
            } else {
                $urlRedirect = URLADM . "list-conf-emails/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editConfEmailsPassword();
        }
    }
    private function viewEditConfEmailsPassword(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/confEmails/editConfEmailsPassword", $this->data);
        $loadView->loadView();
    }
    private function editConfEmailsPassword(): void
    {
        if (!empty($this->dataForm['SendEditConfEmailsPass'])) {
            unset($this->dataForm['SendEditConfEmailsPass']);
            $editConfEmailsPass = new \App\adms\Models\AdmsEditConfEmailsPassword();
            $editConfEmailsPass->update($this->dataForm);
            if ($editConfEmailsPass->getResult()) {
                $urlRedirect = URLADM . "view-conf-emails/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditConfEmailsPassword();
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Configuração de email não encontrada!</p>";
            $urlRedirect = URLADM . "list-conf-emails/index";
            header("Location: $urlRedirect");
        }
    }
}
