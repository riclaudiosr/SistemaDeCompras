<?php

namespace App\adms\Models\helper;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

use LDAP\Result;
use PDOException;
use PDO;
//ARQUIVO RELPE DE BUSCAR DADOS EM BANCO
class AdmsPagination
{
  private int $page; //RECEBE O NUMERO DA PAGINA EM QUE O USUÁRIO ESTA
  private int $limitResult; //RECEBE O NUMERO DE RESULTADO POR PAGINA
  private int $offSet; // RECEBE O NUMERO DE DADOS DA PAGINA 
  private string $query; //RECEBE A QUERY DE BUSCA
  private string|null $parseString; // RECEPE O PARAMETRO PASSADO PARA A BUSCA
  private  $resultBd; // RECEBE O RESULTADO DA BUSCA NO BANCO DE DADOS
  private string|null $result; // RECEBE O RESULTADO DA CLASSE
  private int $totPage; //RECEBE  O TATAL DAS PAGINA GERADA
  private int $maxLinks = 2; // RECEBE O LIMITE DE LINK DAS PAGINAS A SER APRESENTADA
  private string $link; //RECEBE O LINK DA URL
  private string|null $var; //RECEBE AVARIAVEL DE PESQUISA

  function getOffSet(): int
  {
    return $this->offSet;
  }
  function getResult(): string|null
  {
    return $this->result;
  }
  function __construct(string $link, string|null $var = null)
  {
    $this->link = $link;
    $this->var = $var;
  }
  public function condition(int $page, int $limitResult): void
  {
    $this->page = (int) $page ? $page : 1;
    $this->limitResult = (int) $limitResult;
    $this->offSet = (int) ($this->page * $this->limitResult) - $this->limitResult;
  }
  public function pagination(string $query, string|null $parseString = null): void
  {
    $this->query = (string) $query;
    $this->parseString = (string) $parseString;

    $count = new \App\adms\Models\helper\AdmsRead();
    $count->fullRead($this->query, $this->parseString);
    $this->resultBd = $count->getResult();
    $this->pageInstruction();
  }
  private function pageInstruction(): void
  {
    $this->totPage = (int) ceil($this->resultBd[0]['num_result'] / $this->limitResult);
    if ($this->totPage >= $this->page) {
      $this->leyoutPagination();
    } else {
      header("Location: {$this->link}");
    }
  }
  private function leyoutPagination(): void
  {
  //  $this->result = "<ul>";
    $this->result = "<a href='{$this->link}{$this->var}'></a>";
    
    for ($beforePage = $this->page - $this->maxLinks; $beforePage <= $this->page - 1; $beforePage++) {
      if ($beforePage >= 1) {
        $this->result .= "<a href='{$this->link}/$beforePage{$this->var}'>$beforePage</a>";
      }
    }
    $this->result .= "{$this->page}";

    for ($afterPage = $this->page + 1; $afterPage <= $this->page + $this->maxLinks; $afterPage++) {
      if ($afterPage <= $this->totPage) {
        $this->result .= "<a href='{$this->link}/$afterPage{$this->var}'>$afterPage</a>";
      }
    }
    $this->result .= "<a href='{$this->link}/{$this->totPage}{$this->var}'></a>";
   // $this->result .= "</ul>";
  }
}
