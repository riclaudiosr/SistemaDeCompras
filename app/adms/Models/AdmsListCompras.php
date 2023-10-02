<?php

namespace App\adms\Models;

if (!defined('RSR1937NA')) {
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
}

//ARQUIVO para lista usuários do banco
class AdmsListCompras
{
    private bool $result; // $result Recebe true quando executar o processo com sucesso e false quando houver erro 
    private array|null $resultBd; //$resultBd Recebe os registros do banco de dados
    private int $page; //$page Recebe o número página 
    private int $limitResult = 8; // $page Recebe a quantidade de registros que deve retornar do banco de dados 
    private string|null $resultPg; // $page Recebe a páginação 
    private string|null $searchName; // $searchName Recebe o nome do usuario 
    private string|null $searchEmail; //$searchEmail Recebe o email do usuario  
    private string|null $searchNameValue; // $searchNameValue Recebe o nome do usuario 
    private string|null $searchEmailValue; // $searchEmailValue Recebe o e-mail do usuario 

    function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }
    function getResult(): bool
    {
        return $this->result;
    }
    public function listCompras(int $page = null, string $tabela = null): void
    {
        if (!empty($tabela)) {
            $tabela = $tabela;
        } else {
            date_default_timezone_set('America/Sao_Paulo');
            $dataDia = date("d-M-Y");
            $nomeTable = str_replace("-", "", $dataDia);
            $tabela = "compras" . $nomeTable;
            $data = $dataDia;
        }
        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'dashboard/index');
        $pagination->condition($this->page, $this->limitResult);
        $resultCompraDia = new \App\adms\Models\helper\AdmsRead();
        $resultCompraDia->fullRead("SELECT id,produto,quantidade,valor_unitario,totsValor,pontos FROM  $tabela");

        if (($resultCompraDia->getResult() && (!empty($resultCompraDia->getResult())))) {
            $valorDia = new \App\adms\Models\helper\AdmsRead();
            $valorDia->fullRead("SELECT SUM(totsValor) AS totsDia, SUM(pontos) AS totPontos FROM  $tabela");
            if ($valorDia->getResult()) {
                $this->resultBd['totsDia'] = $valorDia->getResult()[0];
            }

            $pagination->pagination("SELECT COUNT(id) AS num_result FROM $tabela");
            $this->resultPg = $pagination->getResult();

            $this->result = true;
            $resultCompraDia = new \App\adms\Models\helper\AdmsRead();
            $resultCompraDia->fullRead("SELECT id, produto,quantidade,valor_unitario,totsValor,pontos 
              FROM $tabela ORDER BY id DESC
               LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffSet()}");
            if ($resultCompraDia->getResult()) {
                $this->resultBd['compraDia'] = $resultCompraDia->getResult();
                $_SESSION['msg'] = "<p style='color:#0f0'>Compras Buscada com Sucesso! </p>";
                $this->resultMes();
            } else {
                $_SESSION['msg'] = "<p style='color:#f00'>Não Houve Compras neste Dia</p>";
                $this->result = false;
            }
        } else {
            $this->resultPg = 1;
            $this->resultMes();
            $this->result = false;
        }
    }
    public function resultMes(int $page = null, string $table = null): void
    {
        if (empty($table)) {
            date_default_timezone_set('America/Sao_Paulo');
            $data = date("M-Y");
            $nomeTable = str_replace("-", "", $data);
            $tabela2 = "compras_mes" . $nomeTable;
        } else {
            if (isset($_SESSION['name_tabDia'])) {
                $tabela2 = $_SESSION['name_tabDia'];
            } else {
                $tabela2 = "semTabela";
            }
        } 
        date_default_timezone_set('America/Sao_Paulo');
        $data = date("M-Y");
        $nomeTable = str_replace("-", "", $data);
        $tabela1 = "result_" . $nomeTable;

        $resultCartao = new \App\adms\Models\helper\AdmsRead();
        $resultCartao->fullRead("SELECT compras_cartao,pontos_mes FROM $tabela2");
        if ($resultCartao->getResult()) {
            $this->resultBd['resultCartao'] =  $resultCartao->getResult()[0];

            $resultMes = new \App\adms\Models\helper\AdmsRead();
            $resultMes->fullRead("SELECT compras_cartao,pontos_mes,compras_pix,tots_compras,pix_mes,add_fatura,salario FROM  $tabela1");
            if ($resultMes->getResult()) {
                $this->resultBd['resultMes'] =  $resultMes->getResult()[0];
                $this->resultBd['saldo'] = $this->resultBd['resultMes']['pix_mes'] - $this->resultBd['resultMes']['tots_compras'];
            } else {
                $this->result = false;
            }
        } else {
            $resultMes = new \App\adms\Models\helper\AdmsRead();
            $resultMes->fullRead("SELECT compras_cartao,pontos_mes,compras_pix,tots_compras,pix_mes,add_fatura,salario FROM  $tabela1");
            if ($resultMes->getResult()) {
                $this->resultBd['resultMes'] =  $resultMes->getResult()[0];
                $this->resultBd['saldo'] = $this->resultBd['resultMes']['pix_mes'] - $this->resultBd['resultMes']['tots_compras'];
            }else{
                $this->result = false;
               // var_dump($data);
            }
        }
    }
}
