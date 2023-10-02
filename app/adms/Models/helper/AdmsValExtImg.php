<?php

namespace App\adms\Models\helper;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }
   
//ARQUIVO RELPE DE VALIDAÇÃODE AEXTENÇÃO DA IMAGEM

class AdmsValExtImg
{
    private string $mimeType; // recebe o type da image
    private bool $result;
    public function getResult(): bool
    {
        return $this->result;
    }
    public function validateExtImg(string $mimeType): void
    {
        $this->mimeType = $mimeType;
        //var_dump($this->mimeType);

        switch ($this->mimeType) {
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->result = true;
                break;
            case 'image/png':
            case 'image/x-png':
                $this->result = true;
                break;
            default:
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Imagem ou a Extenção invalida necessario PNG/JPG!2</p>";

                $this->result = false;
        }
    }
}
