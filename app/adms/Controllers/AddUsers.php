<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }
//CONTROLLER DE CADASTRAR NOVO USUARIO
/**
 *intaciar a classe responsavel em carregara a view e enviaros dados para aview
 *quando o usuario clicar no botão cadastrar do formulário da pagina novo usuario
 * acessa o if intacia a classe admsuser responasável por cadastra usuario no banco
 * ususario cadastrado com sucesso faz o redirecionamento para a pagina listar regustros
 * se nao intancia a classe responsável em carregar a view e enviar para a view
 */
class AddUsers
{
    private array|null $data = [];
    //$dataForm, recebe os dados do formulario
    private array|null $dataForm;
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['sendAddUser'])) {
            unset($this->dataForm['sendAddUser']);

            $creatAdduser = new \App\adms\Models\AdmsAddUsers();
            $creatAdduser->createUser($this->dataForm);

            if ($creatAdduser->getResult()) {
                $urlRedirect = URLADM . "list-users/index";
                header("location:  $urlRedirect");
                // var_dump($this->dataForm);
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewAddUser();
            }
        } else {
            $this->viewAddUser();
        }
        //  $this->data = null;

    }
    private function viewAddUser(): void
    {
        $listSelect = new \App\adms\Models\AdmsAddUsers();
        $this->data['select'] = $listSelect->listSelect();

        $viewCon = new \Core\ConfigView("adms/Views/users/addUser", $this->data);
        $viewCon->loadView();
    }
}
