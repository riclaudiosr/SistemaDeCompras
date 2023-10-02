<?php

namespace App\adms\Models;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

//ARQUIVO PARA EDITAR USUARIO NO BANCO DE DADOS
class AdmsEditeProduto
{
  private array|null $resultBd; //RECEBE OS DADOS DO BANCO DE DADOS
  private bool $result = false; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  private string|int|null $id; // RECEBE O ID PASSADO COMO PARAMETRO
  private string $nameTable; // RECEBE O NOME DA TABELA 
  private array|null $data; // RECEBE OS DADOS DO FORMULARIO
  private float $valor_dolar; //RECEBE O VALOR DO DOLAR NA COTAÇÃO ATUAL
  private float $precoAnt;
  private float $quantAnt;
  private $listRegistryAdd;
  //RECEBE O RESULTADO DA CLASSE E RETORNA OS REGISTRO DO BANCO
  public function getResult(): bool
  {
    return $this->result;
  }
  //RECEBE O RESULTADO DA BUSCA NO BANCO, E RETORNA
  public function getResultBd(): array|null
  {
    return $this->resultBd;
  }
  /*
NOME DA TABELA COMPRA DO MES
         date_default_timezone_set('America/Sao_Paulo');
        $data = date("M-Y");
        $tableMes = str_replace("-", "", $data);
$this->nameTable =  "compras_mes" . $tableMes;

NOME DA TABELA DE COMPRA DO DIA
   date_default_timezone_set('America/Sao_Paulo');
        $data = date("d-M-Y");
        $tableDia = str_replace("-", "", $data);
        $this->nameTable = "compras" . $tableDia;

NOME DA TABELA RESULTADO DO MES
  date_default_timezone_set('America/Sao_Paulo');
        $data = date("M-Y");
        $tableResultMes = str_replace("-", "", $data);
        $this->nameTable =  "result_" . $tableResultMes;
  */

  public function editProduto(string|int|null $id): void
  {
    $this->id = $id;
    if (isset($_SESSION['name_tabDia'])) {
      $this->nameTable = $_SESSION['name_tabDia'];
    } else {
      date_default_timezone_set('America/Sao_Paulo');
      $data = date("d-M-Y");
      $tableDia = str_replace("-", "", $data);
      $this->nameTable = "compras" . $tableDia;
    }
    $viewAdmsRead = new \App\adms\Models\helper\AdmsRead();
    $viewAdmsRead->fullRead("SELECT id,produto,quantidade,valor_unitario FROM $this->nameTable WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");
    $this->resultBd = $viewAdmsRead->getResult();

    if ($this->resultBd) {
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color:#f00;'>Erro: Usuario não encontrado!<p>";
      $this->result = false;
    }
  }
  public function upDate(array $data = null, int $id = null): void
  {
    //  var_dump($this->resultBd,$this->nameTable);
    $this->data = $data;
    $this->id = $id;
    //   var_dump($this->data);

    $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
    $valEmptyField->valField($this->data);
    //intanciar o resultado da validação, dentro de uma condição
    if ($valEmptyField->getResult()) {
      $this->edit();
    } else {
      $this->result = false;
    }
  }

  private function edit(): void
  {
    $this->dolar();


    if (isset($_SESSION['name_tabDia'])) {
      $this->nameTable = $_SESSION['name_tabDia'];
      //  unset($_SESSION['name_tabDia']);
    } else {
      date_default_timezone_set('America/Sao_Paulo');
      $data = date("d-M-Y");
      $tableDia = str_replace("-", "", $data);
      $this->nameTable = "compras" . $tableDia;
    }

    $upEdit = new \App\adms\Models\helper\AdmsRead();
    $upEdit->fullRead("SELECT produto,quantidade,valor_unitario FROM $this->nameTable WHERE id=:id", "id={$this->id}");
    $dados = $upEdit->getResult()[0];
    $this->resultBd['precoAnt'] = (float) $dados['valor_unitario'];
    $this->resultBd['quantAnt']  = (float) $dados['quantidade'];
    $this->resultBd['totsValor'] = $this->resultBd['quantAnt'] * $this->resultBd['precoAnt'];
    $this->resultBd['totsPontos']  = $this->resultBd['totsValor'] / $this->valor_dolar * 2.5;

    if (isset($this->data['quantidade'])) {
      $this->data['quantidade'] = (float) $this->data['quantidade'];
    }
    if (isset($this->data['valor_unitario'])) {
      $this->data['valor_unitario'] = (float) $this->data['valor_unitario'];
    }
    $this->upDateSist($this->data, $this->id, $this->nameTable);
    if ($this->getResult()) {
      $this->editFechamento();
    }
  }
  public function editFechamento()
  {
    $upEdit = new \App\adms\Models\helper\AdmsRead();
    $upEdit->fullRead("SELECT produto,quantidade,valor_unitario FROM $this->nameTable WHERE id=:id", "id={$this->id}");
    $dados = $upEdit->getResult()[0];
    $preco = (float) $dados['valor_unitario'];
    $quantidade = (float) $dados['quantidade'];

    if (($dados == "CarneSeca") or ($dados['produto'] == "Descartaveis")) {
      $this->data['totsValor'] = $quantidade * $preco;
      $this->data['modified'] = date("Y-m-d H:i:s");
    } else {
      $this->data['totsValor'] = $quantidade * $preco;
      $this->data['pontos'] = $this->data['totsValor'] / $this->valor_dolar * 2.5;
      $this->data['modified'] = date("Y-m-d H:i:s");
    }
    //METODO DE ediçao de dados
    $this->upDateSist($this->data, $this->id, $this->nameTable);
    if ($this->getResult()) {
      $this->editMesCompras($this->data);
    }
  }
  public function editMesCompras(array $value): void
  {
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("M-Y");
    $nomeTable = strtolower(str_replace("-", "", $data));
    $tableCompraMes = "compras_mes" . $nomeTable;

    $upEdit = new \App\adms\Models\helper\AdmsRead();
    $upEdit->fullRead("SELECT produto,quantidade,valor_unitario FROM $this->nameTable WHERE id=:id", "id={$this->id}");
    $dados = $upEdit->getResult()[0];

    $id = 1;
    if (($dados['produto'] == "CarneSeca") or ($dados['produto'] == "Descartaveis")) {
      $resultCartao = new \App\adms\Models\helper\AdmsRead();
      $resultCartao->fullRead("SELECT compras_pix FROM $tableCompraMes");
      $dados =  $resultCartao->getResult()[0];
      $valor['compras_pix'] = (float)  $dados['compras_pix'];

      $valor['compras_pix'] = ($valor['compras_pix'] + $value['totsValor']) - $this->resultBd['totsValor'];
    } else {
      $resultCartao = new \App\adms\Models\helper\AdmsRead();
      $resultCartao->fullRead("SELECT compras_cartao,pontos_mes FROM $tableCompraMes");
      $dados =  $resultCartao->getResult()[0];

      $valor['compras_cartao'] = (float)  $dados['compras_cartao'];
      $valor['pontos_mes'] = (float)  $dados['pontos_mes'];

      $valor['compras_cartao'] = $valor['compras_cartao'] + $value['totsValor'] - $this->resultBd['totsValor'];
      $valor['pontos_mes'] = $valor['pontos_mes'] + $value['pontos'] - $this->resultBd['totsPontos'];
    }

    $this->upDateSist($valor, $id, $tableCompraMes);
    if ($this->getResult()) {

      $this->resultMes($value);
    }
  }
  public function resultMes(array $value): void
  {
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("M-Y");
    $nomeTable = strtolower(str_replace("-", "", $data));
    $tableResultMes = "result_" . $nomeTable;

    $upEdit = new \App\adms\Models\helper\AdmsRead();
    $upEdit->fullRead("SELECT produto,quantidade,valor_unitario FROM $this->nameTable WHERE id=:id", "id={$this->id}");
    $dados = $upEdit->getResult()[0];
    $this->id = 1;
    if (($dados['produto'] == "CarneSeca") or ($dados['produto'] == "Descartaveis")) {
      $resultCartao = new \App\adms\Models\helper\AdmsRead();
      $resultCartao->fullRead("SELECT compras_pix,tots_compras FROM $tableResultMes");
      $dados =  $resultCartao->getResult()[0];

      $valor['compras_pix'] = (float)  $dados['compras_pix'];
      $valor['tots_compras'] = (float)  $dados['tots_compras'];
      var_dump($valor);
      $valor['compras_pix'] = ($valor['compras_pix'] + $value['totsValor']) - $this->resultBd['totsValor'];
      $valor['tots_compras'] = ($valor['tots_compras'] + $value['totsValor']) - $this->resultBd['totsValor'];
    } else {
      $resultCartao = new \App\adms\Models\helper\AdmsRead();
      $resultCartao->fullRead("SELECT compras_cartao,pontos_mes,tots_compras FROM $tableResultMes");
      $dados =  $resultCartao->getResult()[0];

      $valor['compras_cartao'] = (float)  $dados['compras_cartao'];
      $valor['pontos_mes'] = (float)  $dados['pontos_mes'];
      $valor['tots_compras'] = (float)  $dados['tots_compras'];

      $valor['compras_cartao'] = ($valor['compras_cartao'] + $value['totsValor']) - $this->resultBd['totsValor'];
      $valor['pontos_mes'] = ($valor['pontos_mes'] + $value['pontos']) - $this->resultBd['totsPontos'];
      $valor['tots_compras'] = ($valor['tots_compras'] + $value['totsValor']) - $this->resultBd['totsValor'];
    }
    $this->upDateSist($valor, $this->id, $tableResultMes);
    if ($this->getResult()) {
      //  var_dump($valor);
    }
  }

  public function upDateSist(array $data, int|null $id, string $table): void
  {
    $upEdit = new \App\adms\Models\helper\AdmsUpdate();
    $upEdit->exeUpdate($table, $data, "WHERE id=:id", "id={$id}");
    if ($upEdit->getResult()) {
      $_SESSION['msg'] = "<p style='color:green;'> Quantidade/Valor, Editdo com Secesso!</p>";
      $this->result = true;
    } else {
      $_SESSION['msg'] = "<p style='color:green;'> Quantidade/Valor, Não editado com Secesso!</p>";
      $this->result = false;
    }
  }

  public function dolar(): void
  {
    //PEGANDO A DATA DO SISTEMA DE SETE DIAS ANTES FORMATO MEIS DIA ANO
    $inicio = date("m-d-Y", strtotime("-7 days"));
    //PEGANDO A DATA ATUAL DO SISTEMA FORMATO MEIS DIA ANO
    $fim = date("m-d-Y");
    //$URL RECEBE O VALOR QUE VEM DA COTAÇÃO DO DIA DO BANCO CENTRAL
    $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'' . $inicio . '\'&@dataFinalCotacao=\'' . $fim . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
    //DECODIFICANDO FORMATO DE ARQUIVO JSON
    $dados = json_decode(file_get_contents($url), true);
    //VALOR DA COTAÇÃO
    $this->valor_dolar = $dados['value'][0]['cotacaoCompra'];
    $this->resultBd['dolar'] = $this->valor_dolar;
  }
  /*
  public function listSelect(): array
  {
    $list = new \App\adms\Models\helper\AdmsRead();
    $list->fullRead("SELECT id AS id_sit, name AS name_sit FROM adms_sits_users ORDER BY name ASC");

    $registry['sit'] = $list->getResult();
    $this->listRegistryAdd = ['sit' => $registry['sit']];
    return $this->listRegistryAdd;
  }
  */
}
