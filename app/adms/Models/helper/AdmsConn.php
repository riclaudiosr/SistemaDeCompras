<?php

namespace App\adms\Models\helper;

if (!defined('RSR1937NA')) {
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
}


use mysqli;
use PDO;
use PDOException;
//ARQUIVO DE CONECÇÃO COM O BANCO



abstract class AdmsConn
{
    private string $db = DB;
    private string $host = HOST;
    private string $user = USER;
    private string $pass = PASS;
    private string $dbname = DBNAME;
    private string|int $port = PORT;
    protected object $connect;
    protected string $nameTable;

    private $servername = HOST;
    private $username = USER;
    private $password = PASS;
    //private $dbname = DBNAME;
    private bool $result;

    function getResult()
    {
        return $this->result;
    }
    protected function connectDb(): object
    {
        try { //com a porta
            $this->connect = new PDO($this->db . ':host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname, $this->user, $this->pass);
            //Sem a porta
            //   $this->connect = new PDO($this->db . ':host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->pass);
            //  echo "Conexão realizada com Sucesso! <br>";
            return $this->connect;
        } catch (PDOException $err) {
            die('Erro:001, entre em contato com o suporte! ' . EMAILADM);
        }
    }

    function tableCompras()
    {

        date_default_timezone_set('America/Sao_Paulo');
        $data = date("d-M-Y");
        $nomeTable = str_replace("-", "", $data);
        $this->nameTable = "compras" . $nomeTable;
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // sql to create table
            $sql =  "CREATE TABLE IF NOT EXISTS $this->nameTable (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             produto VARCHAR(100),quantidade INT (10),valor_unitario FLOAT(10),totsValor FLOAT (10),pontos FLOAT (10), creatdat TIMESTAMP,modified TIMESTAMP)";
            $conn->exec($sql);
        } catch (PDOException $err) {
            echo $sql . "<br>" . $err->getMessage();
        }
        $conn = null;
    }
    /*
    public function verifique($data): void
    {
        $table = $data;
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql =  "CREATE TABLE IF NOT EXISTS $table";
            $conn->exec($sql);
            $this->result = true;
        } catch (PDOException $err) {
            $this->result = false;
        }
        $conn = null;
        if ($this->result) {
              
        } else {
           $this->tableAddCartao($table);
        }
        //$this->tableAddResultMes($table); 
    }
  */
    function tableAddResultMes(string $table)
    {
        $table = $table;
        try {
            // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "CREATE TABLE IF NOT EXISTS $table (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            compras_cartao FLOAT(20),compras_pix FLOAT(20),pontos_mes FLOAT (20), tots_compras FLOAT(20),pix_mes FLOAT(20),add_fatura FLOAT(20),salario FLOAT(20),
            creatdat TIMESTAMP)";
            $conn->exec($sql);
            // var_dump($table);
            $this->result = true;
        } catch (PDOException $err) {
            echo $sql . "<br>" . $err->getMessage();
        }
        $conn = null;
    }
    function tableAddCartao(string $table)
    {
        $table = $table;
        try {
            // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql =  "CREATE TABLE IF NOT EXISTS $table (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             compras_cartao FLOAT(20),pontos_mes FLOAT (20),compras_pix FLOAT(20),creatdat TIMESTAMP)";
            $conn->exec($sql);
            // var_dump($table);
            $this->result = true;
        } catch (PDOException $err) {
            echo $sql . "<br>" . $err->getMessage();
        }
        $conn = null;
        
        
    }
}
