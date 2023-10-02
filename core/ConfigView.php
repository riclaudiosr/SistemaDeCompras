<?php
namespace Core;
if(!defined('RSR1937NA')){
   //   header("Location: /");
   die("Erro: pagina nao encontrada");
  }

class ConfigView
{
  /*
  // PARA PHP INFERIOR A 8.
   private $nameView;
   private  $data;
    public function __construct( $nameView, $data)
    {
      $this->data = $data;
      $this->nameView = $nameView; 
     // var_dump($this->nameView);
    }
    */
    
    //PHP SUPERIOR A 8
    public function __construct(private string $nameView, private array|string|null $data)
    {
    //  var_dump($this->nameView);
    } 
    /**faz o redirecionamente da pagina */
    public function loadView():void
    {
      
      if(file_exists('app/'.$this->nameView . '.php')){
         include 'app/adms/Views/include/head_login.php'; 
         include 'app/'.$this->nameView . '.php';
         include 'app/adms/Views/include/footer_login.php';
      }else{
         die("Erro: 003, controle de acesso as paginas, entre em contato com o suporte".EMAILADM);
      }
    }
    //metodo view login
    public function loadViewLogin():void
    {
      
      if(file_exists('app/'.$this->nameView . '.php')){
         include 'app/adms/Views/include/head.php';
         
         include 'app/adms/Views/include/menu.php';
       
        
         include 'app/'.$this->nameView . '.php';
         include 'app/adms/Views/include/footer.php';
      }else{
         die("Erro: 003.1, controle de acesso as paginas, entre em contato com o suporte".EMAILADM);
      }
    }
    public function loadViewHome():void
    {
      
      if(file_exists('app/'.$this->nameView . '.php')){
         include 'app/adms/Views/include/head.php'; 
         include 'app/adms/Views/include/menu.php';
       
         include 'app/'.$this->nameView . '.php';
         include 'app/adms/Views/include/footer.php';
      }else{
         die("Erro: 003, controle de acesso as paginas, entre em contato com o suporte".EMAILADM);
      }
    }
}
