<?php
namespace App\adms\Controllers;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }
   
class ConEmail
{ 
  private array|string|null $data;// recebe os dados que deve ser enviado
  private string|null $key; // recebe os dados passado pela url, atraves da chave
  public function index(): void
  {
    //INPUT BUSCA OS DADOS DA CHAVE ENVIADA PELO ADMSNEWUSER
    $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);

        if (!empty($this->key)) {
            $this->valKey();
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Necessário confirmar o email, 
            acesse sua caixa de email clique no link para ativar,<a href='" . URLADM . 
            "new-con-email/index'> Se não encontro o email clique aqui para renviar o email<a>!</p>";
            $urlRedirect = URLADM . "login/index";
           header("Location: $urlRedirect");
        }
    }

    private function valKey(): void
    {
        $confEmail = new \App\adms\Models\AdmsConfEmail();
        $confEmail->confEmail($this->key);
        if ($confEmail->getResult()) {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        } else {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
      }

    }
