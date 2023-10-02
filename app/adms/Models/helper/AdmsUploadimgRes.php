<?php

namespace App\adms\Models\helper;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

//ARQUIVO RELPE DE BUSCAR  DE REDIMENSIONAR IMAGEM PARA O BANCO DE DADOS.
class AdmsUploadimgRes
{
  private array $imageData;
  private string $diretory;
  private string $name;
  private int $width;
  private int $height;
  private $newImage;
  private bool $result;
  private  $imgResize;

  public function getResult(): bool
  {
    return $this->result;
  }
  public function upload(array $imageData, string $diretory, string $name, int $width, int $height): void
  {
    $this->imageData = $imageData;
    $this->diretory = $diretory;
    $this->name = $name;
    $this->width = $width;
    $this->height = $height;


    $this->valDiretory();
  }
  //VALIDA O DIRETÓRIO
  private function valDiretory(): void
  {
    if ((file_exists($this->diretory)) and (!is_dir($this->diretory))) {

      $this->createDir();
    } elseif (!file_exists($this->diretory)) {
      $this->createDir();
    } else {
      $this->uploadFile();
    }
  }
  //CRIA O DIRETÓRIO
  private function createDir(): void
  {
    mkdir($this->diretory, 0755);
    if (!file_exists($this->diretory)) {
      $_SESSION['msg'] = "<p style='color:green'> Upload da imagem não realizada com sucesso!</p>";

      $this->result = false;
    } else {

      $this->uploadFile();
    }
  }
  // REALIZA O UPLOAD DO ARQUIVO
  private function uploadFile(): void
  {
    switch ($this->imageData['type']) {
      case 'image/jpeg':
      case 'image/jpg':
      case 'image/JPG':
      case 'image/pjpeg':
        $this->uploadFileJpg();
        break;
      case 'image/png':
      case 'image/x-png':
        $this->uploadFilePng();
        break;
      default:
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Imagem ou a Extenção invalida necessario PNG/JPEG/!!!</p>";
        $this->result = false;
    }
  }
  // CRIA A IMAGE JPG
  private function uploadFileJpg(): void
  {
    $this->newImage = imagecreatefromjpeg($this->imageData['tmp_name']);
    $this->redImg();
    if (imagejpeg($this->imgResize, $this->diretory . $this->name, 100)) {
      $_SESSION['msg'] = "<p style='color:green'> Upload da imagem JPG realizada com sucesso!</p>";
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Upload da imagem JPG não realizada com sucesso !</p>";
      $this->result = false;
    }
  }
  // CRIA A IMAGE PNG
  private function uploadFilePng(): void
  {
    $this->newImage = imagecreatefrompng($this->imageData['tmp_name']);
    $this->redImg();
    if (imagepng($this->imgResize, $this->diretory . $this->name, 1)) {
      $_SESSION['msg'] = "<p style='color:green'> Upload da imagem PNG realizada com sucesso!</p>";
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Upload da imagem PNG não realizada com sucesso !</p>";
      $this->result = false;
    }
  }


  //redimensionar a imagaem
  private function redImg(): void
  {
    //pegando a largura originaal 
    $width_original = imagesx($this->newImage);
    //pegando a altura originaal 
    $heigth_original = imagesy($this->newImage);
    //criar uma imagem usando o php imagecreatetruecolor com as dimensões recebida
    $this->imgResize = imagecreatetruecolor($this->width, $this->height);

    //redimensionar parte a imagem enviada pelo usuário e interpolar com a imagem do tamanho modelo
    imagecopyresampled($this->imgResize, $this->newImage,  0, 0, 0, 0, $this->width, $this->height, $width_original, $heigth_original);
  }
}
