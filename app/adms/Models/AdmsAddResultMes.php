<?php

namespace App\adms\Models;

use App\adms\Controllers\ListUsers;

if (!defined('RSR1937NA')) {
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
}

//ARQUIVO para lista usuários do banco
class AdmsAddResultMes
{
    private bool $result; // $result Recebe true quando executar o processo com sucesso e false quando houver erro 
    private array|null $resultBd; //$resultBd Recebe os registros do banco de dados
    private  $data;
    private int $page; //$page Recebe o número página 
    private int $limitResult = 40; // $page Recebe a quantidade de registros que deve retornar do banco de dados 
    private string|null $resultPg; // $page Recebe a páginação 
    private string|null $valor; // $searchName Recebe o nome do usuario 
    private string|null $table; //$searchEmail Recebe o email do usuario  
    private string|null $dataSist; // $searchNameValue Recebe o nome do usuario 
    private string|null $searchEmailValue; // $searchEmailValue Recebe o e-mail do usuario 


    function getResult(): bool
    {
        return $this->result;
    }

    function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    public function readCompra(int $page = null, string $table): void
    {
        $listCompras = new \App\adms\Models\AdmsListCompras();
        $listCompras->listCompras($page, $table);
        $this->resultBd = $listCompras->getResultBd();
    }
    public function addResultMes(int|array $data = null): void
    {
        $key = $data;
        date_default_timezone_set('America/Sao_Paulo');
        $data = date("M-Y");
        $nomeTable = str_replace("-", "", $data);
        $this->table =  "result_" . $nomeTable;

        date_default_timezone_set('America/Sao_Paulo');
        $data = date("M-Y");
        $nomeTable = str_replace("-", "", $data);
        $resultCartaoMes =  "compras_mes" . $nomeTable;

        $resultMes = new \App\adms\Models\helper\AdmsCreate();
        $resultMes->tableAddResultMes($this->table);

        $this->dataSist = date("Y-m-d H:i:s");

        if (!empty($key['pixDia'])) {
            $valor = $key['pixDia'];
            //  var_dump($valor);
            $this->addValorPix($valor);
        } elseif (!empty($key['addFatt'])) {
            $valor = $key['addFatt'];
            $this->addValorFat($valor);
        } elseif (!empty($key['valorSemana'])) {
            $valor = $key['valorSemana'];
            $this->addValorSemana($valor);
        } else {
            $this->result = false;
        }
        if ($this->getResult()) {
            $listCompras = new \App\adms\Models\AdmsListCompras();
            $listCompras->listCompras();

            if ($listCompras->getResultBd()) {
                
                $this->resultBd = $listCompras->getResultBd();
                $this->resultPg = $listCompras->getResultPg();
                
                $this->result = true;
            } else {
                $this->result = false;
            }
        }
    }
    private function addValorPix(int $valor): void
    {
        $resultMes = new \App\adms\Models\helper\AdmsRead();
        $resultMes->fullRead("SELECT compras_cartao,compras_pix,pix_mes,add_fatura FROM $this->table");
        if ($resultMes->getResult()) {
            $n1 = $resultMes->getResult();
            $col['pix_mes'] = $n1[0]['pix_mes'];
            $resultMes = new \App\adms\Models\helper\AdmsUpdate();
            $col['pix_mes'] += (int) $valor;
            $col['creatdat'] = $this->dataSist;
            $resultMes->exeUpdate($this->table, $col);
        } else {
            $col['pix_mes'] = (int) $valor;
            $col['creatdat'] = $this->dataSist;
            $resultMes = new \App\adms\Models\helper\AdmsCreate();
            $resultMes->exeCreate($this->table, $col);
        }
        if ($resultMes->getResult()) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
    private function addValorFat(int $valor): void
    {
        $resultMes = new \App\adms\Models\helper\AdmsRead();
        $resultMes->fullRead("SELECT compras_cartao,compras_pix,tots_compras,pix_mes,add_fatura FROM $this->table");
        if ($resultMes->getResult()) {
            $n1 = $resultMes->getResult();
            $col['add_fatura'] = $n1[0]['add_fatura'];
            $resultMes = new \App\adms\Models\helper\AdmsUpdate();
            $col['add_fatura'] += (int) $valor;
            $col['creatdat'] = $this->dataSist;
            // var_dump($this->table,$col);
            $resultMes->exeUpdate($this->table, $col);
        } else {
            $col['add_fatura'] = (int) $valor;
            $col['creatdat'] = $this->dataSist;
            $resultMes = new \App\adms\Models\helper\AdmsCreate();
            $resultMes->exeCreate($this->table, $col);
        }
        if ($resultMes->getResult()) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
    private function addValorSemana(int $valor): void
    {
        $resultMes = new \App\adms\Models\helper\AdmsRead();
        $resultMes->fullRead("SELECT compras_cartao,compras_pix,tots_compras,pix_mes,add_fatura,salario FROM $this->table");
        if ($resultMes->getResult()) {
            $n1 = $resultMes->getResult();
            $col['salario'] = $n1[0]['salario'];
            $resultMes = new \App\adms\Models\helper\AdmsUpdate();
            $col['salario'] += (int) $valor;
            $resultMes->exeUpdate($this->table, $col);
        } else {
            $col['salario'] = (int) $valor;
            $col['creatdat'] = $this->dataSist;
            $resultMes = new \App\adms\Models\helper\AdmsCreate();
            $resultMes->exeCreate($this->table, $col);
        }
        if ($resultMes->getResult()) {
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
}
