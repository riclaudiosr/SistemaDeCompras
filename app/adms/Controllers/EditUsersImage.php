<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

class EditUsersImage
{
    private array|string|null $data = [];//$data Recebe os dados que devem ser enviados para VIEW 
    private array|null $dataForm;//$dataForm Recebe os dados do formulario     
    private int|string|null $id;//$id Recebe o id do registro */

    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditUserImage']))) {
            $this->id = (int) $id;
            $viewUser = new \App\adms\Models\AdmsEditUsersImage();
            $viewUser->viewEditUser($this->id);
            if ($viewUser->getResult()) {
                $this->data['form'] = $viewUser->getResultBd();
                $this->viewEditUserImage();
            } else {
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editUserImage();
        }
    }

    private function viewEditUserImage(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/users/editUserImage", $this->data);
        $loadView->loadView();
    }

    private function editUserImage(): void
    {
        if (!empty($this->dataForm['SendEditUserImage'])) {
            unset($this->dataForm['SendEditUserImage']);
            $this->dataForm['new_image'] = $_FILES['new_image'] ? $_FILES['new_image'] : null;
            $editUserImage = new \App\adms\Models\AdmsEditUsersImage();
            $editUserImage->update($this->dataForm);
            if ($editUserImage->getResult()) {
                $urlRedirect = URLADM . "view-user/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditUserImage();
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
    }
}
