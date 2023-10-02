<?php
namespace Core;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

/**Controller de verificação do Adm das paginas
 * 
 */
class ConfigControllerPgAdm extends Config
{
    private string $urlController; //RECEBE O NOME DA CONTROLLE PELA URL
    private string $urlMetodo;// RECEBE O NOME DO METODO PELA URL
    private string $urlParametro;// RECEBE O PARAMETRO PASSADO PELA URL
    private string $classLoad; // CONTROLLER QUE DEVE SER CARREGADA 
    
    private array $listPgPublica;
    private array $listPgPrivada;

    public function loadPage(string|null $urlController, string|null $urlMetodo, string|null $urlParametro): void
    {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParametro = $urlParametro;
       // unset($_SESSION['user_id']);

        //intacia o metodo para verificar se a pagina e publica ou privada
        $this->pgPublica();

        if (class_exists($this->classLoad)) {
            //metodo de verificaçao se o metodo passado pela url existe
            $this->loadMetodo();

        } else {
            $slugController = new \App\adms\Models\helper\AdmsSlugText();
            $this->urlController = $slugController->slugController(CONTROLLER);
            $this->urlMetodo = $slugController->slugMetodo(METODO);
            $this->urlParametro = "";
            $this->loadPage($this->urlController, $this->urlMetodo, $this->urlParametro);
        }
    }
    // função que verificar se o metodo existe
    private function loadMetodo(): void
    {
        $classLoad = new $this->classLoad();
        if (method_exists($classLoad, $this->urlMetodo)) {
            $classLoad->{$this->urlMetodo}($this->urlParametro);
        } else {
            die('Erro: 002, entre em contato com o suporte! ' . EMAILADM);
        }
    }
    // metodo de definiçaõda paginas publicas
    private function pgPublica(): void
    {
        $this->listPgPublica = ["Login", "Erro","Sobre","NewUser","ConEmail",
        "NewConEmail","RecoverPassword","UpdatePassword"];
        if (in_array($this->urlController, $this->listPgPublica)) {
            $this->classLoad = /*"\\App\\adms\\Controllers\\"*/  URLPG . $this->urlController;
        } else {
            $this->pgPrivada();
        }
    }
    //metodo de definição de definição da pagina privada
    private function pgPrivada(): void
    {
        $this->listPgPrivada = ["Dashboard","ListUsers","ViewUser","AddUsers","EditeUser", "EditPassword","EditUsersImage","DeleteUser","ViewProfile","EditProfile","EditProfilePassword","EditProfileImg","ListSitsUsers","AddSitsUsers","DataBank","ViewConfEmails","ListConfEmails","EditConfEmailsPassword","AddConfEmails","DeleteConfEmails",
        "EditConfEmails","AddCompras","ResultMes","EditeProduto","DeleteProduto","Logaut"];
        if (in_array($this->urlController, $this->listPgPrivada)) {
            $this->virifLogin();
        } else {
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Pagina não Encontrada Verifique o Caminha da Url<p>";
            $urlRedirect = URLADM . "Login/index";
            header("location:  $urlRedirect");
        }
    }
    //metodo verifica se o usuario ja esta logado
    private function virifLogin(): void
    {
        if ((isset($_SESSION['user_id'])) and (isset($_SESSION['user_name'])) and (isset($_SESSION['user_email']))) {
            $this->classLoad = /*"\\App\\adms\\Controllers\\"*/  URLPG . $this->urlController;
        }else{
            $_SESSION['msg'] = "<p style='color:#f00;'>Erro: para acessar a pagina realize o login<p>";
            $urlRedirect = URLADM . "Login/index";
            header("location:  $urlRedirect");
        }
    }
}
