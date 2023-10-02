<?php

namespace App\adms\Controllers;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

class Dashboard
{
  private array|string|null $data = [];
  /** @var string|int|null $page Recebe o número página */
  private string|int|null $page;
  /** @var array $dataForm Recebe os dados do formulario */
  private array|null $dataForm;

  public function index(string|int|null $page = null): void
  {
    $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($this->dataForm['datLocal'])) {
      $this->page = (int) $page ? $page : 1;
      $data = date("d-M-Y", strtotime($this->dataForm['datLocal']));
      $data  = str_replace("-", "", $data);
      $select = "compras" . $data;
      //SUPER GLOBAL COM O NOME DA PASTA DE COMPRA DAQUELE DIA
      $listCompras = new \App\adms\Models\AdmsListCompras;
      $listCompras->listCompras($this->page, $select);
      if ($listCompras->getResult()) {
        $this->data['result'] = $listCompras->getResultBd();
        $this->data['pagination'] = $listCompras->getResultPg();
        if (isset($this->dataForm['datLocal'])) {
          $this->data['datCompra'] = date("d-M-Y", strtotime($this->dataForm['datLocal']));
        } else {
          $this->data['datCompra'] = date("d-M-Y");
        }
        $this->loadHome();
      } else {
        $listCompras->resultMes($this->page, $select);
        $this->data['result']  =  $listCompras->getResultBd();
        if (isset($this->dataForm['datLocal'])) {
          $this->data['datCompra'] = date("d-M-Y", strtotime($this->dataForm['datLocal']));
        } else {
          $this->data['datCompra'] = date("d-M-Y");
        }
        $_SESSION['msg'] = "<p style='color:#f00'> Não Houve Compras nesta Data. </p>";
        $this->loadHome();
      }
    } elseif (isset($_POST['formAddValores'])) {
      $valor['addFatt'] = $_POST['addFatt'];
      $valor['pixDia'] = $_POST['pixDia'];
      $valor['valorSemana'] = $_POST['valorSemana'];
      $listCompras = new \App\adms\Models\AdmsAddResultMes;
      $listCompras->addResultMes($valor);
      if ($listCompras->getResult()) {
        $listCompras->getResultBd();
        $this->data['result'] = $listCompras->getResultBd();
        $listCompras->getResultPg();
        $this->data['pagination'] = $listCompras->getResultPg();
        if (isset($this->dataForm['datLocal'])) {
          $this->data['datCompra'] = date("d-M-Y", strtotime($this->dataForm['datLocal']));
        } else {
          $this->data['datCompra'] = date("d-M-Y");
        }
        $this->loadHome();
      }
    } elseif (!empty($page)) {
    
      if (!empty($_SESSION['name_tabDia'])) {
        $select = $_SESSION['name_tabDia'];
      } else {
        date_default_timezone_set('America/Sao_Paulo');
        $dataDia = date("d-M-Y");
        $nomeTable = str_replace("-", "", $dataDia);
        $select = "compras" . $nomeTable;
        $data = $dataDia;
      }
      $listCompras = new \App\adms\Models\AdmsListCompras;
      $listCompras->listCompras($page, $select);
      if ($listCompras->getResult()) {
        $this->data['result'] = $listCompras->getResultBd();
        $this->data['pagination'] = $listCompras->getResultPg();
        if (isset($this->dataForm['datLocal'])) {
          $this->data['datCompra'] = date("d-M-Y", strtotime($this->dataForm['datLocal']));
        } else {
          $this->data['datCompra'] = date("d-M-Y");
        }
        $this->loadHome();
      }
    } else {
      $listCompras = new \App\adms\Models\AdmsListCompras();
      $listCompras->listCompras();
      if ($listCompras->getResult()) {
        if ($listCompras->getResultBd()) {
          $this->data['result'] = $listCompras->getResultBd();
          $this->data['pagination'] = $listCompras->getResultPg();
          if (isset($this->dataForm['datLocal'])) {
            $this->data['datCompra'] = date("d-M-Y", strtotime($this->dataForm['datLocal']));
          } else {
            $this->data['datCompra'] = date("d-M-Y");
          }
          $this->loadHome();
        }
        /*
      } else {
        $listCompras = new \App\adms\Models\AdmsListCompras();
        $listCompras->resultMes();
        if ($listCompras->getResult()) {
          if ($listCompras->getResultBd()) {
            $this->data['result'] = $listCompras->getResultBd();
            if (isset($this->dataForm['datLocal'])) {
              $this->data['datCompra'] = date("d-M-Y", strtotime($this->dataForm['datLocal']));
            } else {
              $this->data['datCompra'] = date("d-M-Y");
            }
            $this->loadHome();
          }
        } else {
          if (isset($this->dataForm['datLocal'])) {
            $this->data['datCompra'] = date("d-M-Y", strtotime($this->dataForm['datLocal']));
          } else {
            $this->data['datCompra'] = date("d-M-Y");
          }
          $this->loadHome();
        }
      */}
    }
    $this->data['datCompra'] = date("d-M-Y");
    $this->loadHome();
  }
  private function loadHome(): void
  {
    $viewCon = new \Core\ConfigView("adms/Views/users/dashboard", $this->data);
    $viewCon->loadViewHome();
  }
}
