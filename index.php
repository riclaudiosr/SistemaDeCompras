<?php
session_start();
ob_start();

define('RSR1937NA', true);

require './vendor/autoload.php';
//intacia a class configController responsavel por tratar a url
$home = new Core\ConfigController();
//intancia o metodo carregar da pagina controller
$home->loadPage();
