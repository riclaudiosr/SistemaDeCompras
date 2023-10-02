<?php

namespace App\adms\Models\helper;
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }
   
//ARQUIVO RELPE DE VALIDAÇÃODE EMAIL
class AdmsUpload
{
    private bool $result; // RECEBE O RESULTADO DA CLASSE
    private string $diretory; // RECEBE OS DADOS DO DIRETORIO
    private string $tmpName;
    private string $name;

    public function getResult(): bool
    {
        return $this->result;
    }
    //RECEBE OS DADOS QUE VAO SER PROCESSADO PELA CLASSE
    public function upload(string $diretory, string $tmpName, string $name): void
    {
        $this->diretory = $diretory;
        $this->tmpName = $tmpName;
        $this->name = $name;
        if ($this->valDiretory()) {
            $this->uploadFile();
        } else {
            $this->result = false;
        }
    }
    //VERIFICA O DIRETORIO
    private function valDiretory(): bool
    {
        if ((!file_exists($this->diretory)) and (!is_dir($this->diretory))) {
            mkdir($this->diretory, 0755);
            if ((!file_exists($this->diretory)) and (!is_dir($this->diretory))) {
                  $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Não realizado com sucesso.tente novamente!</p>";
                  return false;
            }else{
                return true;
            }
          
        } else {
            return true;
        }
    }
  //REALIZA O UPLOAD DO ARQUIVO
    private function uploadFile():void
    {
        if (move_uploaded_file($this->tmpName, $this->diretory . $this->name)) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Não realizado com sucesso.tente novamente!</p>";
            $this->result = false;
        }
    }
}
