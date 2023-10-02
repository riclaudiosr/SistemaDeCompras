<?php

namespace App\adms\Models\helper;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

use PDOException;
//ARQUIVO RELPE DE INSERÇÃODE DADOS EM BANCO

class AdmsCreate extends AdmsConn
{
  private string $table; //recebe o nome da tabela
  private array $data; // recebe os dados do formulario
  private string|null $result; // recebe o resultado
  protected string $nameTable; //nome da tabela
  private string $query; // recebe a query
  private object $insert; // resebe a query preparada
  private object $conn;  // recebe a coneção com o

  public function creatTable()
  {
    $this->tableCompras();
    $this->result = $this->nameTable;
  }

  function getResult()
  {
    return $this->result;
  }
  public function exeCreate(string $table, array $data): void
  {
    $this->table = $table;
    $this->data = $data;
    
    $this->exeReplaceValue();
  }

  private function exeReplaceValue(): void
  {
    //tranformar as chaves do array em nome de coluna
    $coluns = implode(', ', array_keys($this->data));
    //var_dump($coluns);
    //tranformar as chaves do array em link concatenando o dois pontos
    $values = ':' . implode(', :', array_keys($this->data));
  //  var_dump($values);
    $this->query = "INSERT INTO {$this->table}($coluns) VALUES($values)";
   //  var_dump($this->query);
    $this->exeIntrucao();
  }

  //chama a coneção, realiza o try catch de erro, e executa a query preparada, passando os dados. 
  private function exeIntrucao(): void
  {
    $this->connection();
    try {
//var_dump($this->data);
      $this->insert->execute($this->data);
      
      // Recuperar o ultima Id incerida
      $this->result = $this->conn->lastInsertId();
    } catch (PDOException $erro) {
      $this->result = null;
    }
  }
  //intancia o metodo coneção com o banco e prepara a query, e manda para o atributo insert
  private function connection(): void
  {
    $this->conn = $this->connectDb();
    $this->insert = $this->conn->prepare($this->query);
  }
}
