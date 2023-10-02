<?php

namespace App\adms\Models\helper;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }
   
//ARQUIVO RELPE DE ALTOMATIZAÇÃO DE ESCRITA
class AdmsSlugText
{
    private string $urlSlugController;
    private string $urlSlugMetodo;
    private string $text; // RECEBE O NOME QUE DEVE SER CONVERTIDO
    private array $format;
 
    public function slug(string $text):string|null
    {
        $this->text = $text;
    //SUBSTITUIÇÃO DE CARACTER ESPECIAIS
        $this->format['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:,\\\'<>°ºª';
        $this->format['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr-----------------------------------------------------------------------------------------------';
        $this->text = strtr(utf8_decode($this->text), utf8_decode($this->format['a']), $this->format['b']);
        // CONVERTAR ESPAÇO EM BRANCO EM TRAÇO
        $this->text = str_replace(" ", "-", $this->text);
        //RETIRAR MAIS DE UM TRAÇO, COVERTENDO EM APENAS UM TRAÇO
        $this->text = str_replace(array('-----', '----', '---','--' ), '-', $this->text);
        $this->text = strtolower($this->text);
        //var_dump($this->text);
        return $this->text;
    }

    public function slugController($slugController): string
    {
        $this->urlSlugController = $slugController;
        //CONVERTER PARA MINUSCULA
        $this->urlSlugController = strtolower($this->urlSlugController);
        //CONVERTER TRAÇO EM ESPAÇO EM BRANCO
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        //CONVERTER A PRIMEIRA LETRA DE CADA PALAVRA EM MAIUSCULA
        $this->urlSlugController = ucwords($this->urlSlugController);
        //RETIRANDO ESPAÇO EM BRANCO
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);
     //   var_dump($this->urlSlugController);
        return $this->urlSlugController;
    }

    public function slugMetodo($urlSlugMetodo): string
    {
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        //CONVERTER PARA MINUSCULA A PRIMEIRA LETRA
        $this->urlSlugMetodo = lcfirst($this->urlSlugMetodo);
  //      var_dump($this->urlSlugMetodo);
        return $this->urlSlugMetodo;
    }
}