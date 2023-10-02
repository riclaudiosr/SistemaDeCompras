<?php

namespace App\adms\Controllers;

use App\adms\Models\helper\AdmsConn;

if (!defined('RSR1937NA')) {
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
}

class AddCompras extends AdmsConn
{
    private array|null $data = [];
    //$dataForm, recebe os dados do formulario
    private array|null $dataForm;
    private array|null $dataForm2;
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

         //var_dump($this->dataForm);


        if (!empty($this->dataForm['addCompras'])) {
            unset($this->dataForm['addCompras']);

            if ((isset($this->dataForm['catupiry'])) or (isset($this->dataForm['chedder'])) or (isset($this->dataForm['requeijao']))
                or (isset($this->dataForm['cremeLeite'])) or (isset($this->dataForm['tomateSeco'])) or (isset($this->dataForm['manteiga']))
                or (isset($this->dataForm['semCadastro'])) or (isset($this->dataForm['cubas']))  or (isset($this->dataForm['prato']))
                or (isset($this->dataForm['sacoLixo'])) or (isset($this->dataForm['interfolhas'])) or (isset($this->dataForm['candida'])) or (isset($this->dataForm['alcool']))
                or (isset($this->dataForm['luva']))  or (isset($this->dataForm['perfex'])) or (isset($this->dataForm['cocaLata']))
                or (isset($this->dataForm['agua'])) or (isset($this->dataForm['aguaGas'])) or (isset($this->dataForm['fantaL']))
                or (isset($this->dataForm['fantaU'])) or (isset($this->dataForm['sprity'])) or (isset($this->dataForm['citros']))
                or (isset($this->dataForm['sucos'])) or (isset($this->dataForm['pets'])) or (isset($this->dataForm['moida']))
                or (isset($this->dataForm['bacalhau'])) or (isset($this->dataForm['leite'])) or (isset($this->dataForm['champy']))
                or (isset($this->dataForm['bacon'])) or (isset($this->dataForm['palmito'])) or (isset($this->dataForm['azeitonaV']))
                or (isset($this->dataForm['azeitonaP'])) or (isset($this->dataForm['margarina'])) or (isset($this->dataForm['gordura']))
                or (isset($this->dataForm['calabresa'])) or (isset($this->dataForm['extrato'])) or (isset($this->dataForm['ketchup']))
                or (isset($this->dataForm['milho'])) or (isset($this->dataForm['amido'])) or (isset($this->dataForm['farinha']))
                or (isset($this->dataForm['azeite'])) or (isset($this->dataForm['caldoCarne'])) or (isset($this->dataForm['caldoGalinha']))
                or (isset($this->dataForm['molhoIngle'])) or (isset($this->dataForm['barbecue'])) or (isset($this->dataForm['salchicha']))
                or (isset($this->dataForm['carneSeca'])) or (isset($this->dataForm['frango'])) or (isset($this->dataForm['alho']))
            ) {
                $creatAdduser = new \App\adms\Models\AdmsAddCompras();
                $creatAdduser->creatCompras($this->dataForm);
                if ($creatAdduser->getResult()) {
                    $_SESSION['msg'] = "<p style='color:green;'> Produtos Cadastrado com Sucesso! </p>";
                    $urlRedirect = URLADM . "dashboard/index";
                    header("location:  $urlRedirect");
                } else {
                    $_SESSION['msg'] = "<p style='color: #f00;'> Produtos ja Cadastrado! </p>";
                    $urlRedirect = URLADM . "add-compras/index";
                  header("location:  $urlRedirect");
                }
            } else {
                $this->viewAddCompras();
            }
        } else {
            $this->viewAddCompras();
        }
    }
    private function viewAddCompras(): void
    {
        $viewCon = new \Core\ConfigView("adms/Views/compras/compras", $this->data);
        $viewCon->loadViewHome();
    }
}
