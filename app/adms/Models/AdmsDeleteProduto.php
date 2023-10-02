<?php

namespace App\adms\Models;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

//ARQUIVO PARA APAGAR USUARIO NO BANCO DE DADOS
class AdmsDeleteProduto
{

  private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private int $id; // RECEBE O ID PASSADO COMO PARAMETRO
  private array $value; // RECEBE O ID PASSADO COMO PARAMETRO
  private array $data; // RECEBE UM ARREY DE DADOS
  private array|null $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
  private string $delDirectory; //$diretório Recebe o endereço para excluir a imagem 
  private  string $delImg; //RECEBE A IMAGEM PARA SER DELETADA
  private string $table; // RECEBE O NOME DA TABELA ACESSADA
  //RECEBE O RESULTADO DA CLASSE E RETORNA O RESULTADO DA CLASSE
  public function getResult(): bool
  {
    return $this->result;
  }

  public function deleteProduto(int $id): void
  {
    
    if (!empty($_SESSION['name_tabDia'])) {
      $this->table = $_SESSION['name_tabDia'];
  } else {
      date_default_timezone_set('America/Sao_Paulo');
      $dataDia = date("d-M-Y");
      $nomeTable = str_replace("-", "", $dataDia);
      $this->table = "compras" . $nomeTable;
      $data = $dataDia;
  }

    $this->id = (int) $id;
    if ($this->viewProduto()) {
      $this->value = $this->resultBd[0];

      $deleteUser = new \App\adms\Models\helper\AdmsDelete();
      $deleteUser->exeDelete($this->table, "WHERE id =:id ", "id={$this->id}");
      if ($deleteUser->getResult()) {
        $this->deliteCompraMes();
      } else {
        $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuário não Apagado com sucesso!<p>";
        $this->result = false;
      }
    } else {
      $this->result = false;
    }
  }
  //busca os dados no banco de 
  private function viewProduto(): bool
  {
    $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
    $viewAdmsRead->fullRead("SELECT id,produto,totsValor FROM $this->table WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");
    $this->resultBd = $viewAdmsRead->getResult();
    if ($this->resultBd) {

      return true;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Produto não encontrado!<p>";
      return false;
    }
  }
  //deleta a imagem e o diretório 
  private function deliteCompraMes(): void
  {

    date_default_timezone_set('America/Sao_Paulo');
    $data = date("M-Y");
    $nomeTable = strtolower(str_replace("-", "", $data));
    $tableCompraMes = "compras_mes" . $nomeTable;

    $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
    $viewAdmsRead->fullRead("SELECT compras_cartao,pontos_mes,compras_pix FROM $tableCompraMes");
    $resultMes = $viewAdmsRead->getResult()[0];

    $id = 1;
    if (($this->value['produto'] != 'CarneSeca') && ($this->value['produto'] != 'Descartaveis')) {
      $admsDelProduto = new \App\adms\Models\AdmsEditeProduto;
      $admsDelProduto->dolar();
      $dolar = $admsDelProduto->getResultBd();

      $valorCompra = (float) $this->value['totsValor'];
      $totPontos = (float) $resultMes['pontos_mes'];
      $totCompra = (float) $resultMes['compras_cartao'];

      $this->data['compras_cartao'] = $totCompra - $valorCompra;
      $this->data['pontos_mes'] = $totPontos - $valorCompra / $dolar['dolar'] * 2.5;
    } else {

      $valorCompra = (float) $this->value['totsValor'];
      $totCompra = (float) $resultMes['compras_pix'];

      $this->data['compras_pix'] = $totCompra - $valorCompra;
    }
    $upDateSist = new \App\adms\Models\AdmsEditeProduto;
    $upDateSist->upDateSist($this->data, $id, $tableCompraMes);
    if ($upDateSist->getResult()) {
      $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
      $viewAdmsRead->fullRead("SELECT compras_cartao,pontos_mes,compras_pix FROM $tableCompraMes");
      if ($viewAdmsRead->getResult()) {
        $resultMes = $viewAdmsRead->getResult()[0];
        $this->deliteResultMes($resultMes);
      }
    } else {
      $this->result = false;
    }
  }
  private function deliteResultMes(array $table): void
  {
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("M-Y");
    $nomeTable = str_replace("-", "", $data);
    $tableResult = "result_" . $nomeTable;
    $id = 1;
    $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
    $viewAdmsRead->fullRead("SELECT compras_cartao,compras_pix,pontos_mes,tots_compras FROM $tableResult");
    $resultMes = $viewAdmsRead->getResult()[0];

    $totResultMes['compras_cartao'] = (float) $table['compras_cartao'];
    $totResultMes['compras_pix'] = (float)  $table['compras_pix'];
    $totResultMes['pontos_mes'] = (float) $table['pontos_mes'];
    $totResultMes['tots_compras'] = $table['compras_cartao'] + $table['compras_pix'];
   
    $upDateSist = new \App\adms\Models\AdmsEditeProduto;
    $upDateSist->upDateSist($totResultMes, $id, $tableResult);
    if($upDateSist->getResult()){
      $this->result = true;
    }else{
      $this->result = false;
    }
  }
}
