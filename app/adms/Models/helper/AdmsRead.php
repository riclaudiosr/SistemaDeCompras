<?php

namespace App\adms\Models\helper;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

use PDOException;
use PDO;
//ARQUIVO RELPE DE BUSCAR DADOS EM BANCO
class AdmsRead extends AdmsConn
{
  private string $select;
  private array $values = [];
  private bool|array|null $result;
  private object $query;
  private object $conn;
  // metodo que recebe o resultado da execução da classe
  public function getResult(): bool|array|null
  {
    return $this->result;
  }
  //metode de leitura dos requesito da busca
  public function exeRead(string $table, string|null $terms = null, string|null $parseString = null): void
  {
    if (!empty($parseString)) {
      //converto a variavel em um array
      parse_str($parseString, $this->values);
    }
    $this->select = "SELECT * FROM {$table} {$terms}";
    //  var_dump($this->select);
    $this->exeIntruction();
  }

  //metodo de leitura de busca especifica em uma tabela
  public function fullRead(string $query, string|null $parseString = null): void
  {
    $this->select = $query;
    
    if (!empty($parseString)) {
      //converto a variavel em um array
      parse_str($parseString, $this->values);
    }
    $this->exeIntruction();
  }


  //metodo de execução das intruções, conecção, verificação de parametro, execução de query,
  private function exeIntruction(): void
  {
    $this->connection();
    try {
      $this->exeParameter();
      $this->query->execute();
      $this->result = $this->query->fetchAll();
    } catch (PDOException $err) {
     // die("Erro :004. Leitura, entre em contato com adiministrador " . EMAILADM);
      $this->result = false;
    }
  }
  //metodo de conecção com o banco
  private function connection(): void
  {
    $this->conn = $this->connectDb();
    $this->query = $this->conn->prepare($this->select);
    $this->query->setFetchMode(PDO::FETCH_ASSOC);
  }
  //metodo de inserção dos parametros da busca
  private function exeParameter(): void
  {
    if ($this->values) {
      foreach ($this->values as $link => $value) {
        if (($link == 'limit') or ($link == 'offset') or ($link == 'id')) {
          $value = (int) $value;
        }
        $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
      }
    }
  }

}
