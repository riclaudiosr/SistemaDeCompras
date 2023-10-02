<?php
namespace Core;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

class ConfigController extends Config
{
    private string $url;
    private array $urlArray;
    private string $urlController;
    private string $urlMetodo;
    private string $urlParametro;
    private array $format;
    /**faz a configuração dos dados enviada pel url */
    public function __construct()
    {
        /**Metodo de configuração principal da pagina */
        $this->configAdm();
        /** verifica se a url exixte e redireciona para cada pagina */
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
           //  var_dump($this->url);

            /** Limpa e converte os caracter da url*/
            $this->clearUrl();
            /**tranforma a string passada pela url em arrey de dados */
            $this->urlArray = explode("/", $this->url);
            //   var_dump($this->urlArray);
            /**verifica a existencia da string, e faz o redirecionamente como nome da pagina */
            if (isset($this->urlArray[0])) {
                $slugController = new \App\adms\Models\helper\AdmsSlugText();
                $this->urlController = $slugController->slugController($this->urlArray[0]);
            } else {
                $slugController = new \App\adms\Models\helper\AdmsSlugText();
                $this->urlController = $slugController->slugController(CONTROLLER);
            
            }
            /**verifica a existencia da string, e faz o redirecionamente como nome do metodo */
            if (isset($this->urlArray[1])) {
                if ($this->urlArray[1]) {
                    $urlSlugMetodo = new \App\adms\Models\helper\AdmsSlugText();
                    $this->urlMetodo = $urlSlugMetodo->slugMetodo($this->urlArray[1]);
                }
            } else {
                $urlSlugMetodo = new \App\adms\Models\helper\AdmsSlugText();
                $this->urlMetodo = $urlSlugMetodo->slugMetodo(METODO);
            }
            /**verifica a existencia da string, e faz o redirecionamente como parametro */
            if (isset($this->urlArray[2])) {
                $this->urlParametro = $this->urlArray[2];
            } else {
                $this->urlParametro = "";
            }
        } else {
            /**caso a url estiver vazia chama uma pagina estatica */

               $slugController = new \App\adms\Models\helper\AdmsSlugText();
              $this->urlController = $slugController->slugController(CONTROLLER);
             $urlSlugMetodo = new \App\adms\Models\helper\AdmsSlugText();
             $this->urlMetodo = $urlSlugMetodo->slugMetodo(METODO);
            $this->urlParametro = "";
        }
    }
    /** Limpa e converte os caracter da url*/
    private function clearUrl(): void
    { //ELIMINAR TEGS
        $this->url = strip_tags($this->url);
        //ELIMINAR ESPAÇOS EM BRANCO
        $this->url = trim($this->url);
        //ELIMINAR A BARRA DO FINAL
        $this->url = rtrim($this->url, "/");
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-------------------------------------------------------------------------------------------------';
        $this->url = strtr(utf8_decode($this->url), utf8_decode($this->format['a']), $this->format['b']);
    }

    /**Metodo que rediresiona os os arquivo ao nome que vem da url */
    public function loadPage(): void
    {
   
        $loadPagAdm = new \Core\ConfigControllerPgAdm();
        $loadPagAdm->loadPage($this->urlController, $this->urlMetodo, $this->urlParametro);
    }
}
