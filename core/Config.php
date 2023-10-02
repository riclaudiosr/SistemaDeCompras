<?php
namespace Core;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

abstract class Config
{
    protected function configAdm():void
    {
        define('URL', 'http://localhost/bancoDeDados/');
        define('URLADM', 'http://localhost/bancoDeDados/compras/');
        define('URLPG','\\App\adms\\Controllers\\');
        define('CONTROLLER', 'login');
        define('METODO', 'Index');
        define('CONTROLLERERRO', 'Erro');
        define('EMAILADM', 'claudioDevelopp@gmail.com');
     //Credencial do banco de dados
     define('DB', 'mysql');
     define('HOST', 'localhost');
     define('USER', 'root');
     define('PASS', '');
     define('DBNAME', 'compras');
     define('PORT', 3306);
     define('TABELA', 'adms_users');
    
    }
}