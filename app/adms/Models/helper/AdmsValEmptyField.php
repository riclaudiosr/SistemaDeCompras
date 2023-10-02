<?php
namespace App\adms\Models\helper;
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }
 
//ARQUIVO RELPE DE VALIDAÇÃO DE FORMULARIO EM PHP
class AdmsValEmptyField 
{
    private array|null $data;
    private bool $result;
    public function getResult()
    {
    return $this->result;

    }

    public function valField(array $data = null)
    {
      $this->data = $data;
      if((isset($this->data['nickname'])) AND ($this->data['nickname']==="")){
        unset($this->data['nickname']);
      }
      if(!empty($this->data['new_image'])){
        unset($this->data['new_image']);
      }
     // var_dump($this->data);
      //verificar e existe alguma teg, se houver retirar
      $this->data = array_map('strip_tags', $this->data);
      // verivicar se existe espasso em branco.
      $this->data = array_map('trim', $this->data);
      //verificar se o array de dados esta vazio
      if(in_array('',$this->data)){
          //se o array estiver vazio
       $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Necessário Preencher todos os Campos!</p>"; 
       $this->result = false;
      }else{
         //se o array conter dados
        $this->result = true;
      }
    }
}