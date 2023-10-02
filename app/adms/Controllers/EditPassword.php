<?php

namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
/**
 *intaciar a classe responsavel em carregara a view e enviaros dados para a view
 *quando o usuario clicar no botão Editar para editar a senha do usuário

 * acessa o if intacia a classe admsuser responasável por editar usuario no banco
 * ususario cadastrado com sucesso faz o redirecionamento para a pagina listar regustros
 * se nao intancia a classe responsável em carregar a view e enviar para a view
 */
class EditPassword
{
    private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO
    private array|null $data = []; //RECEBE OS DADOS DA CONTROLE 
    private array|null $dataForm; //$dataForm, recebe os dados do formulario

    public function index(int|string|null $id = null): void
    {  
       $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
        if((!empty($id)) and (empty($this->dataForm['sendEditPass']))){
          //  var_dump($this->dataForm);
            $this->id = (int) $id;
           $editpass = new \App\adms\Models\AdmsEditPassword();
           $editpass->editPassword($this->id);
           if($editpass->getResult()){
            $this->data['form']= $editpass->getResultBd();
            $this->viewEditPass();
           }else{
            $urlRedirect = URLADM . "list-users/index";
            header("location:  $urlRedirect");
           }
        }else{
         
            $this->editUserPass();
        }
    }
    private function editUserPass():void
    {
        if(isset($this->dataForm['sendEditPass'])){
            unset($this->dataForm['sendEditPass']);
          $admsEditPass = new \App\adms\Models\AdmsEditPassword();
          $admsEditPass->upDate($this->dataForm);
          if($admsEditPass->getResult()){
            $urlRedirect = URLADM . "view-user/index/".$this->dataForm['id'];
            header("location:  $urlRedirect");
          }else{
                $this->data['form']=$this->dataForm;
                $this->viewEditPass();
          }
        }else{
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario não encontrado<p>";
            $urlRedirect = URLADM . "list-users/index";
            header("location:  $urlRedirect");
        }
    }
     private function viewEditPass(): void
    {
        $viewCon = new \Core\ConfigView("adms/Views/users/editPassword", $this->data);
        $viewCon->loadViewLogin();
    }
}
