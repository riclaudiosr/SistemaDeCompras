<?php

namespace App\adms\Models;

if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

//ARQUIVO DA CADASTRO DE USUÁRIO
class AdmsAddCompras
{
  private float|int $valor_dolar;
  private array|null $data; // RECEBE OS DADOS DO FORMULARIO
  private array|null $data2; // RECEBE OS DADOS DO FORMULARIO
  private $result; //RECEBE O RESULTADO DA EXECUÇÃO DA CLASSE
  protected string $nameTable; //nome da tabela
  private array $listRegistryAdd; // RECEBE OS DADOS DO BANCO DE DADOS APRAVES DO RELPE ADMSREAD

  public function getResult()
  {
    return $this->result;
  }
  public function creatCompras(array $data = null)
  {
    $this->data = $data;
    $this->addTable();
    $this->dolar();
    $this->edit();
  }
  private function addTable(): void
  {
    $creatTable =  new \App\adms\Models\helper\AdmsCreate();
    $creatTable->creatTable();
    $this->nameTable = $creatTable->getResult();
  }
  private function dolar(): void
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
  }
  private function edit()
  {
    $readProduto =  new \App\adms\Models\helper\AdmsRead();
    $readProduto->fullRead("SELECT produto FROM $this->nameTable");
    $this->listRegistryAdd = $readProduto->getResult();


    if ((isset($this->data['catupiry'])) && (!empty($this->data['quntidade1'])) && (!empty($this->data['valor_unitario1']))) {
      unset($this->data['catupiry']);
      if (!empty($this->listRegistryAdd)) {
        foreach ($this->listRegistryAdd as $value) {
          if ($value['produto'] == "Catupiry") {
            $exitCat = true;
          }
        }
        if (!isset($exitCat)) {
          $produto['catupiry'] = [$this->data['produto'] = "Catupiry", $this->data['quntidade1'], $this->data['valor_unitario1']];
        }
      } else {
        $produto['catupiry'] = [$this->data['produto'] = "Catupiry", $this->data['quntidade1'], $this->data['valor_unitario1']];
      }
    } else {
      unset($this->data['quntidade1']);
      unset($this->data['valor_unitario1']);
      unset($this->data['catupiry']);
    }

    if (isset($this->data['chedder'])) {
      unset($this->data['chedder']);
      if ((empty($this->data['quntidade2'])) or (empty($this->data['valor_unitario2']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Chedder") {
              $exitChdd = true;
            }
          }
          if (!isset($exitChdd)) {
            $produto['chedder'] = [$this->data['produto'] = "Chedder", $this->data['quntidade2'], $this->data['valor_unitario2']];
          }
        } else {
          $produto['chedder'] = [$this->data['produto'] = "Chedder", $this->data['quntidade2'], $this->data['valor_unitario2']];
        }
      }
    } else {
      unset($this->data['quntidade2']);
      unset($this->data['valor_unitario2']);
    }


    if (isset($this->data['requeijao'])) {
      unset($this->data['requeijao']);
      if ((empty($this->data['quntidade3'])) or (empty($this->data['valor_unitario3']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Requeijao") {
              $exitReq = true;
            }
          }
          if (!isset($exitReq)) {

            $produto['requeijao'] = [$this->data['produto'] = "Requeijao", $this->data['quntidade3'], $this->data['valor_unitario3']];
          }
        } else {
          $produto['requeijao'] = [$this->data['produto'] = "Requeijao", $this->data['quntidade3'], $this->data['valor_unitario3']];
        }
      }
    } else {
      unset($this->data['quntidade3']);
      unset($this->data['valor_unitario3']);
    }

    if (isset($this->data['cremeLeite'])) {
      unset($this->data['cremeLeite']);
      if ((empty($this->data['quntidade4'])) or (empty($this->data['valor_unitario4']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          //  var_dump($this->listRegistryAdd);

          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "CremeLeite") {
              $exitCleit = true;
            }
          }
          if (!isset($exitCleit)) {
            $produto['cremeLeite'] = [$this->data['produto'] = "CremeLeite", $this->data['quntidade4'], $this->data['valor_unitario4']];
          }
        } else {
          $produto['cremeLeite'] = [$this->data['produto'] = "CremeLeite", $this->data['quntidade4'], $this->data['valor_unitario4']];
        }
      }
    } else {
      unset($this->data['quntidade4']);
      unset($this->data['valor_unitario4']);
    }

    if (isset($this->data['tomateSeco'])) {
      unset($this->data['tomateSeco']);
      if ((empty($this->data['quntidade5'])) or (empty($this->data['valor_unitario5']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "TomateSeco") {
              $exitTseco = true;
            }
          }
          if (!isset($exitTseco)) {
            $produto['tomateSeco'] = [$this->data['produto'] = "TomateSeco", $this->data['quntidade5'], $this->data['valor_unitario5']];
          }
        } else {
          $produto['tomateSeco'] = [$this->data['produto'] = "TomateSeco", $this->data['quntidade5'], $this->data['valor_unitario5']];
        }
      }
    } else {
      unset($this->data['quntidade5']);
      unset($this->data['valor_unitario5']);
    }

    if (isset($this->data['manteiga'])) {
      unset($this->data['manteiga']);
      if ((empty($this->data['quntidade6'])) or (empty($this->data['valor_unitario6']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Manteiga") {
              $exitMant = true;
            }
          }
          if (!isset($exitMant)) {
            $produto['manteiga'] = [$this->data['produto'] = "Manteiga", $this->data['quntidade6'], $this->data['valor_unitario6']];
          }
        } else {
          $produto['manteiga'] = [$this->data['produto'] = "Manteiga", $this->data['quntidade6'], $this->data['valor_unitario6']];
        }
      }
    } else {
      unset($this->data['quntidade6']);
      unset($this->data['valor_unitario6']);
    }

    if (isset($this->data['cubas'])) {
      unset($this->data['cubas']);
      if ((empty($this->data['quntidade7'])) or (empty($this->data['valor_unitario7']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Cubas") {
              $exitCubas = true;
            }
          }
          if (!isset($exitCubas)) {
            $produto['cubas'] = [$this->data['produto'] = "Cubas", $this->data['quntidade7'], $this->data['valor_unitario7']];
          }
        } else {
          $produto['cubas'] = [$this->data['produto'] = "Cubas", $this->data['quntidade7'], $this->data['valor_unitario7']];
        }
      }
    } else {
      unset($this->data['quntidade7']);
      unset($this->data['valor_unitario7']);
    }

    if (isset($this->data['prato'])) {
      unset($this->data['prato']);
      if ((empty($this->data['quntidade8'])) or (empty($this->data['valor_unitario8']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Prato") {
              $exitPrat = true;
            }
          }
          if (!isset($exitPrat)) {
            $produto['prato'] = [$this->data['produto'] = "Prato", $this->data['quntidade8'], $this->data['valor_unitario8']];
          }
        } else {
          $produto['prato'] = [$this->data['produto'] = "Prato", $this->data['quntidade8'], $this->data['valor_unitario8']];
        }
      }
    } else {
      unset($this->data['quntidade8']);
      unset($this->data['valor_unitario8']);
    }

    if (isset($this->data['sacoLixo'])) {
      unset($this->data['sacoLixo']);
      if ((empty($this->data['quntidade9'])) or (empty($this->data['valor_unitario9']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "SacoLixo") {
              $exitsacoLixo = true;
            }
          }
          if (!isset($exitsacoLixo)) {
            $produto['sacoLixo'] = [$this->data['produto'] = "SacoLixo", $this->data['quntidade9'], $this->data['valor_unitario9']];
          }
        } else {
          $produto['sacoLixo'] = [$this->data['produto'] = "SacoLixo", $this->data['quntidade9'], $this->data['valor_unitario9']];
        }
      }
    } else {
      unset($this->data['quntidade9']);
      unset($this->data['valor_unitario9']);
    }

    if (isset($this->data['interfolhas'])) {
      unset($this->data['interfolhas']);
      if ((empty($this->data['quntidade10'])) or (empty($this->data['valor_unitario10']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Interfolhas") {
              $exitinterfolhas = true;
            }
          }
          if (!isset($exitinterfolhas)) {
            $produto['interfolhas'] = [$this->data['produto'] = "Interfolhas", $this->data['quntidade10'], $this->data['valor_unitario10']];
          }
        } else {
          $produto['interfolhas'] = [$this->data['produto'] = "Interfolhas", $this->data['quntidade10'], $this->data['valor_unitario10']];
        }
      }
    } else {
      unset($this->data['quntidade10']);
      unset($this->data['valor_unitario10']);
    }


    if (isset($this->data['candida'])) {
      unset($this->data['candida']);
      if ((empty($this->data['quntidade11'])) or (empty($this->data['valor_unitario11']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Candida") {
              $exitcandida = true;
            }
          }
          if (!isset($exitcandida)) {
            $produto['candida'] = [$this->data['produto'] = "Candida", $this->data['quntidade11'], $this->data['valor_unitario11']];
          }
        } else {
          $produto['candida'] = [$this->data['produto'] = "Candida", $this->data['quntidade11'], $this->data['valor_unitario11']];
        }
      }
    } else {
      unset($this->data['quntidade11']);
      unset($this->data['valor_unitario11']);
    }

    if (isset($this->data['alcool'])) {
      unset($this->data['alcool']);
      if ((empty($this->data['quntidade12'])) or (empty($this->data['valor_unitario12']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Alcool") {
              $exitalcool = true;
            }
          }
          if (!isset($exitalcool)) {
            $produto['alcool'] = [$this->data['produto'] = "Alcool", $this->data['quntidade12'], $this->data['valor_unitario12']];
          }
        } else {
          $produto['alcool'] = [$this->data['produto'] = "Alcool", $this->data['quntidade12'], $this->data['valor_unitario12']];
        }
      }
    } else {
      unset($this->data['quntidade12']);
      unset($this->data['valor_unitario12']);
    }

    if (isset($this->data['luva'])) {
      unset($this->data['luva']);
      if ((empty($this->data['quntidade13'])) or (empty($this->data['valor_unitario13']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Luva") {
              $exitluva = true;
            }
          }
          if (!isset($exitluva)) {
            $produto['luva'] = [$this->data['produto'] = "Luva", $this->data['quntidade13'], $this->data['valor_unitario13']];
          }
        } else {
          $produto['luva'] = [$this->data['produto'] = "Luva", $this->data['quntidade13'], $this->data['valor_unitario13']];
        }
      }
    } else {
      unset($this->data['quntidade13']);
      unset($this->data['valor_unitario13']);
    }

    if (isset($this->data['perfex'])) {
      unset($this->data['perfex']);
      if ((empty($this->data['quntidade14'])) or (empty($this->data['valor_unitario14']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Perfex") {
              $exitperfex = true;
            }
          }
          if (!isset($exitperfex)) {
            $produto['perfex'] = [$this->data['produto'] = "Perfex", $this->data['quntidade14'], $this->data['valor_unitario14']];
          }
        } else {
          $produto['perfex'] = [$this->data['produto'] = "Perfex", $this->data['quntidade14'], $this->data['valor_unitario14']];
        }
      }
    } else {
      unset($this->data['quntidade14']);
      unset($this->data['valor_unitario14']);
    }

    if (isset($this->data['cocaLata'])) {
      unset($this->data['cocaLata']);
      if ((empty($this->data['quntidade15'])) or (empty($this->data['valor_unitario15']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "CocaLata") {
              $exitcocaLata = true;
            }
          }
          if (!isset($exitcocaLata)) {
            $produto['cocaLata'] = [$this->data['produto'] = "CocaLata", $this->data['quntidade15'], $this->data['valor_unitario15']];
          }
        } else {
          $produto['cocaLata'] = [$this->data['produto'] = "CocaLata", $this->data['quntidade15'], $this->data['valor_unitario15']];
        }
      }
    } else {
      unset($this->data['quntidade15']);
      unset($this->data['valor_unitario15']);
    }

    if (isset($this->data['agua'])) {
      unset($this->data['agua']);
      if ((empty($this->data['quntidade16'])) or (empty($this->data['valor_unitario16']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Agua") {
              $exitagua = true;
            }
          }
          if (!isset($exitagua)) {
            $produto['agua'] = [$this->data['produto'] = "Agua", $this->data['quntidade16'], $this->data['valor_unitario16']];
          }
        } else {
          $produto['agua'] = [$this->data['produto'] = "Agua", $this->data['quntidade16'], $this->data['valor_unitario16']];
        }
      }
    } else {
      unset($this->data['quntidade16']);
      unset($this->data['valor_unitario16']);
    }

    if (isset($this->data['aguaGas'])) {
      unset($this->data['aguaGas']);
      if ((empty($this->data['quntidade17'])) or (empty($this->data['valor_unitario17']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "AguaC/Gas") {
              $exitaguaGas = true;
            }
          }
          if (!isset($exitaguaGas)) {
            $produto['aguaGas'] = [$this->data['produto'] = "AguaC/Gas", $this->data['quntidade17'], $this->data['valor_unitario17']];
          }
        } else {
          $produto['aguaGas'] = [$this->data['produto'] = "AguaC/Gas", $this->data['quntidade17'], $this->data['valor_unitario17']];
        }
      }
    } else {
      unset($this->data['quntidade17']);
      unset($this->data['valor_unitario17']);
    }

    if (isset($this->data['fantaL'])) {
      unset($this->data['fantaL']);
      if ((empty($this->data['quntidade18'])) or (empty($this->data['valor_unitario18']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "FantaLaranja") {
              $exitfantaL = true;
            }
          }
          if (!isset($exitfantaL)) {
            $produto['fantaL'] = [$this->data['produto'] = "FantaLaranja", $this->data['quntidade18'], $this->data['valor_unitario18']];
          }
        } else {
          $produto['fantaL'] = [$this->data['produto'] = "FantaLaranja", $this->data['quntidade18'], $this->data['valor_unitario18']];
        }
      }
    } else {
      unset($this->data['quntidade18']);
      unset($this->data['valor_unitario18']);
    }

    if (isset($this->data['fantaU'])) {
      unset($this->data['fantaU']);
      if ((empty($this->data['quntidade19'])) or (empty($this->data['valor_unitario19']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "FantaUva") {
              $exitfantaU = true;
            }
          }
          if (!isset($exitfantaU)) {
            $produto['fantaU'] = [$this->data['produto'] = "FantaUva", $this->data['quntidade19'], $this->data['valor_unitario19']];
          }
        } else {
          $produto['fantaU'] = [$this->data['produto'] = "FantaUva", $this->data['quntidade19'], $this->data['valor_unitario19']];
        }
      }
    } else {
      unset($this->data['quntidade19']);
      unset($this->data['valor_unitario19']);
    }

    if (isset($this->data['sprity'])) {
      unset($this->data['sprity']);
      if ((empty($this->data['quntidade20'])) or (empty($this->data['valor_unitario20']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Sprity") {
              $exitsprity = true;
            }
          }
          if (!isset($exitsprity)) {
            $produto['sprity'] = [$this->data['produto'] = "Sprity", $this->data['quntidade20'], $this->data['valor_unitario20']];
          }
        } else {
          $produto['sprity'] = [$this->data['produto'] = "Sprity", $this->data['quntidade20'], $this->data['valor_unitario20']];
        }
      }
    } else {
      unset($this->data['quntidade20']);
      unset($this->data['valor_unitario20']);
    }

    if (isset($this->data['citros'])) {
      unset($this->data['citros']);
      if ((empty($this->data['quntidade21'])) or (empty($this->data['valor_unitario21']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Citros") {
              $exitcitros = true;
            }
          }
          if (!isset($exitcitros)) {
            $produto['citros'] = [$this->data['produto'] = "Citros", $this->data['quntidade21'], $this->data['valor_unitario21']];
          }
        } else {
          $produto['citros'] = [$this->data['produto'] = "Citros", $this->data['quntidade21'], $this->data['valor_unitario21']];
        }
      }
    } else {
      unset($this->data['quntidade21']);
      unset($this->data['valor_unitario21']);
    }

    if (isset($this->data['sucos'])) {
      unset($this->data['sucos']);
      if ((empty($this->data['quntidade22'])) or (empty($this->data['valor_unitario22']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Sucos") {
              $exitsucos = true;
            }
          }
          if (!isset($exitsucos)) {
            $produto['sucos'] = [$this->data['produto'] = "Sucos", $this->data['quntidade22'], $this->data['valor_unitario22']];
          }
        } else {
          $produto['sucos'] = [$this->data['produto'] = "Sucos", $this->data['quntidade22'], $this->data['valor_unitario22']];
        }
      }
    } else {
      unset($this->data['quntidade22']);
      unset($this->data['valor_unitario22']);
    }

    if (isset($this->data['pets'])) {
      unset($this->data['pets']);
      if ((empty($this->data['quntidade23'])) or (empty($this->data['valor_unitario23']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Pets600") {
              $exitpets = true;
            }
          }
          if (!isset($exitpets)) {
            $produto['pets'] = [$this->data['produto'] = "Pets600", $this->data['quntidade23'], $this->data['valor_unitario23']];
          }
        } else {
          $produto['pets'] = [$this->data['produto'] = "Pets600", $this->data['quntidade23'], $this->data['valor_unitario23']];
        }
      }
    } else {
      unset($this->data['quntidade23']);
      unset($this->data['valor_unitario23']);
    }

    if (isset($this->data['moida'])) {
      unset($this->data['moida']);
      if ((empty($this->data['quntidade24'])) or (empty($this->data['valor_unitario24']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "CarneMoida") {
              $exitmoida = true;
            }
          }
          if (!isset($exitmoida)) {
            $produto['moida'] = [$this->data['produto'] = "CarneMoida", $this->data['quntidade24'], $this->data['valor_unitario24']];
          }
        } else {
          $produto['moida'] = [$this->data['produto'] = "CarneMoida", $this->data['quntidade24'], $this->data['valor_unitario24']];
        }
      }
    } else {
      unset($this->data['quntidade24']);
      unset($this->data['valor_unitario24']);
    }

    if (isset($this->data['bacalhau'])) {
      unset($this->data['bacalhau']);
      if ((empty($this->data['quntidade25'])) or (empty($this->data['valor_unitario25']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Bacalhau") {
              $exitbacalhau = true;
            }
          }
          if (!isset($exitbacalhau)) {
            $produto['bacalhau'] = [$this->data['produto'] = "Bacalhau", $this->data['quntidade25'], $this->data['valor_unitario25']];
          }
        } else {
          $produto['bacalhau'] = [$this->data['produto'] = "Bacalhau", $this->data['quntidade25'], $this->data['valor_unitario25']];
        }
      }
    } else {
      unset($this->data['quntidade25']);
      unset($this->data['valor_unitario25']);
    }

    if (isset($this->data['leite'])) {
      unset($this->data['leite']);
      if ((empty($this->data['quntidade26'])) or (empty($this->data['valor_unitario26']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Leite") {
              $exitleite = true;
            }
          }
          if (!isset($exitleite)) {
            $produto['leite'] = [$this->data['produto'] = "Leite", $this->data['quntidade26'], $this->data['valor_unitario26']];
          }
        } else {
          $produto['leite'] = [$this->data['produto'] = "Leite", $this->data['quntidade26'], $this->data['valor_unitario26']];
        }
      }
    } else {
      unset($this->data['quntidade26']);
      unset($this->data['valor_unitario26']);
    }

    if (isset($this->data['champy'])) {
      unset($this->data['champy']);
      if ((empty($this->data['quntidade27'])) or (empty($this->data['valor_unitario27']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Champhion") {
              $exitchampy = true;
            }
          }
          if (!isset($exitchampy)) {
            $produto['champy'] = [$this->data['produto'] = "Champhion", $this->data['quntidade27'], $this->data['valor_unitario27']];
          }
        } else {
          $produto['champy'] = [$this->data['produto'] = "Champhion", $this->data['quntidade27'], $this->data['valor_unitario27']];
        }
      }
    } else {
      unset($this->data['quntidade27']);
      unset($this->data['valor_unitario27']);
    }

    if (isset($this->data['bacon'])) {
      unset($this->data['bacon']);
      if ((empty($this->data['quntidade28'])) or (empty($this->data['valor_unitario28']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Bacon") {
              $exitbacon = true;
            }
          }
          if (!isset($exitbacon)) {
            $produto['bacon'] = [$this->data['produto'] = "Bacon", $this->data['quntidade28'], $this->data['valor_unitario28']];
          }
        } else {
          $produto['bacon'] = [$this->data['produto'] = "Bacon", $this->data['quntidade28'], $this->data['valor_unitario28']];
        }
      }
    } else {
      unset($this->data['quntidade28']);
      unset($this->data['valor_unitario28']);
    }

    if (isset($this->data['palmito'])) {
      unset($this->data['palmito']);
      if ((empty($this->data['quntidade29'])) or (empty($this->data['valor_unitario29']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Palmito") {
              $exitpalmito = true;
            }
          }
          if (!isset($exitpalmito)) {
            $produto['palmito'] = [$this->data['produto'] = "Palmito", $this->data['quntidade29'], $this->data['valor_unitario29']];
          }
        } else {
          $produto['palmito'] = [$this->data['produto'] = "Palmito", $this->data['quntidade29'], $this->data['valor_unitario29']];
        }
      }
    } else {
      unset($this->data['quntidade29']);
      unset($this->data['valor_unitario29']);
    }

    if (isset($this->data['azeitonaV'])) {
      unset($this->data['azeitonaV']);
      if ((empty($this->data['quntidade30'])) or (empty($this->data['valor_unitario30']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "AzeitonaVerde") {
              $exitazeitonaV = true;
            }
          }
          if (!isset($exitazeitonaV)) {
            $produto['azeitonaV'] = [$this->data['produto'] = "AzeitonaVerde", $this->data['quntidade30'], $this->data['valor_unitario30']];
          }
        } else {
          $produto['azeitonaV'] = [$this->data['produto'] = "AzeitonaVerde", $this->data['quntidade30'], $this->data['valor_unitario30']];
        }
      }
    } else {
      unset($this->data['quntidade30']);
      unset($this->data['valor_unitario30']);
    }

    if (isset($this->data['azeitonaP'])) {
      unset($this->data['azeitonaP']);
      if ((empty($this->data['quntidade31'])) or (empty($this->data['valor_unitario31']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "AzeitonaPreta") {
              $exitazeitonaP = true;
            }
          }
          if (!isset($exitazeitonaP)) {
            $produto['azeitonaP'] = [$this->data['produto'] = "AzeitonaPreta", $this->data['quntidade31'], $this->data['valor_unitario31']];
          }
        } else {
          $produto['azeitonaP'] = [$this->data['produto'] = "AzeitonaPreta", $this->data['quntidade31'], $this->data['valor_unitario31']];
        }
      }
    } else {
      unset($this->data['quntidade31']);
      unset($this->data['valor_unitario31']);
    }

    if (isset($this->data['margarina'])) {
      unset($this->data['margarina']);
      if ((empty($this->data['quntidade32'])) or (empty($this->data['valor_unitario32']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Margarina") {
              $exitmargarina = true;
            }
          }
          if (!isset($exitmargarina)) {
            $produto['margarina'] = [$this->data['produto'] = "Margarina", $this->data['quntidade32'], $this->data['valor_unitario32']];
          }
        } else {
          $produto['margarina'] = [$this->data['produto'] = "Margarina", $this->data['quntidade32'], $this->data['valor_unitario32']];
        }
      }
    } else {
      unset($this->data['quntidade32']);
      unset($this->data['valor_unitario32']);
    }

    if (isset($this->data['gordura'])) {
      unset($this->data['gordura']);
      if ((empty($this->data['quntidade33'])) or (empty($this->data['valor_unitario33']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Gordura") {
              $exitgordura = true;
            }
          }
          if (!isset($exitgordura)) {
            $produto['gordura'] = [$this->data['produto'] = "Gordura", $this->data['quntidade33'], $this->data['valor_unitario33']];
          }
        } else {
          $produto['gordura'] = [$this->data['produto'] = "Gordura", $this->data['quntidade33'], $this->data['valor_unitario33']];
        }
      }
    } else {
      unset($this->data['quntidade33']);
      unset($this->data['valor_unitario33']);
    }

    if (isset($this->data['calabresa'])) {
      unset($this->data['calabresa']);
      if ((empty($this->data['quntidade34'])) or (empty($this->data['valor_unitario34']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Calabresa") {
              $exitcalabresa = true;
            }
          }
          if (!isset($exitcalabresa)) {
            $produto['calabresa'] = [$this->data['produto'] = "Calabresa", $this->data['quntidade34'], $this->data['valor_unitario34']];
          }
        } else {
          $produto['calabresa'] = [$this->data['produto'] = "Calabresa", $this->data['quntidade34'], $this->data['valor_unitario34']];
        }
      }
    } else {
      unset($this->data['quntidade34']);
      unset($this->data['valor_unitario34']);
    }

    if (isset($this->data['extrato'])) {
      unset($this->data['extrato']);
      if ((empty($this->data['quntidade35'])) or (empty($this->data['valor_unitario35']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Extrato") {
              $exitextrato = true;
            }
          }
          if (!isset($exitextrato)) {
            $produto['extrato'] = [$this->data['produto'] = "Extrato", $this->data['quntidade35'], $this->data['valor_unitario35']];
          }
        } else {
          $produto['extrato'] = [$this->data['produto'] = "Extrato", $this->data['quntidade35'], $this->data['valor_unitario35']];
        }
      }
    } else {
      unset($this->data['quntidade35']);
      unset($this->data['valor_unitario35']);
    }

    if (isset($this->data['ketchup'])) {
      unset($this->data['ketchup']);
      if ((empty($this->data['quntidade36'])) or (empty($this->data['valor_unitario36']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Ketchup") {
              $exitketchup = true;
            }
          }
          if (!isset($exitketchup)) {
            $produto['ketchup'] = [$this->data['produto'] = "Ketchup", $this->data['quntidade36'], $this->data['valor_unitario36']];
          }
        } else {
          $produto['ketchup'] = [$this->data['produto'] = "Ketchup", $this->data['quntidade36'], $this->data['valor_unitario36']];
        }
      }
    } else {
      unset($this->data['quntidade36']);
      unset($this->data['valor_unitario36']);
    }

    if (isset($this->data['milho'])) {
      unset($this->data['milho']);
      if ((empty($this->data['quntidade37'])) or (empty($this->data['valor_unitario37']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Milho") {
              $exitmilho = true;
            }
          }
          if (!isset($exitmilho)) {
            $produto['milho'] = [$this->data['produto'] = "Milho", $this->data['quntidade37'], $this->data['valor_unitario37']];
          }
        } else {
          $produto['milho'] = [$this->data['produto'] = "Milho", $this->data['quntidade37'], $this->data['valor_unitario37']];
        }
      }
    } else {
      unset($this->data['quntidade37']);
      unset($this->data['valor_unitario37']);
    }

    if (isset($this->data['amido'])) {
      unset($this->data['amido']);
      if ((empty($this->data['quntidade38'])) or (empty($this->data['valor_unitario38']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Amido") {
              $exitamido = true;
            }
          }
          if (!isset($exitamido)) {
            $produto['amido'] = [$this->data['produto'] = "Amido", $this->data['quntidade38'], $this->data['valor_unitario38']];
          }
        } else {
          $produto['amido'] = [$this->data['produto'] = "Amido", $this->data['quntidade38'], $this->data['valor_unitario38']];
        }
      }
    } else {
      unset($this->data['quntidade38']);
      unset($this->data['valor_unitario38']);
    }

    if (isset($this->data['farinha'])) {
      unset($this->data['farinha']);
      if ((empty($this->data['quntidade39'])) or (empty($this->data['valor_unitario39']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Farinha") {
              $exitfarinha = true;
            }
          }
          if (!isset($exitfarinha)) {
            $produto['farinha'] = [$this->data['produto'] = "Farinha", $this->data['quntidade39'], $this->data['valor_unitario39']];
          }
        } else {
          $produto['farinha'] = [$this->data['produto'] = "Farinha", $this->data['quntidade39'], $this->data['valor_unitario39']];
        }
      }
    } else {
      unset($this->data['quntidade39']);
      unset($this->data['valor_unitario39']);
    }

    if (isset($this->data['azeite'])) {
      unset($this->data['azeite']);
      if ((empty($this->data['quntidade40'])) or (empty($this->data['valor_unitario40']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Azeite") {
              $exitazeite = true;
            }
          }
          if (!isset($exitazeite)) {
            $produto['azeite'] = [$this->data['produto'] = "Azeite", $this->data['quntidade40'], $this->data['valor_unitario40']];
          }
        } else {
          $produto['azeite'] = [$this->data['produto'] = "Azeite", $this->data['quntidade40'], $this->data['valor_unitario40']];
        }
      }
    } else {
      unset($this->data['quntidade40']);
      unset($this->data['valor_unitario40']);
    }

    if (isset($this->data['caldoCarne'])) {
      unset($this->data['caldoCarne']);
      if ((empty($this->data['quntidade41'])) or (empty($this->data['valor_unitario41']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "CaldoCarne") {
              $exitcaldoCarne = true;
            }
          }
          if (!isset($exitcaldoCarne)) {
            $produto['caldoCarne'] = [$this->data['produto'] = "CaldoCarne", $this->data['quntidade41'], $this->data['valor_unitario41']];
          }
        } else {
          $produto['caldoCarne'] = [$this->data['produto'] = "CaldoCarne", $this->data['quntidade41'], $this->data['valor_unitario41']];
        }
      }
    } else {
      unset($this->data['quntidade41']);
      unset($this->data['valor_unitario41']);
    }

    if (isset($this->data['caldoGalinha'])) {
      unset($this->data['caldoGalinha']);
      if ((empty($this->data['quntidade42'])) or (empty($this->data['valor_unitario42']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "CaldoGalinha") {
              $exitcaldoGalinha = true;
            }
          }
          if (!isset($exitcaldoGalinha)) {
            $produto['caldoGalinha'] = [$this->data['produto'] = "CaldoGalinha", $this->data['quntidade42'], $this->data['valor_unitario42']];
          }
        } else {
          $produto['caldoGalinha'] = [$this->data['produto'] = "CaldoGalinha", $this->data['quntidade42'], $this->data['valor_unitario42']];
        }
      }
    } else {
      unset($this->data['quntidade42']);
      unset($this->data['valor_unitario42']);
    }

    if (isset($this->data['molhoIngles'])) {
      unset($this->data['molhoIngles']);
      if ((empty($this->data['quntidade43'])) or (empty($this->data['valor_unitario43']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "MolhoIngles") {
              $exitmolhoIngles = true;
            }
          }
          if (!isset($exitmolhoIngles)) {
            $produto['molhoIngles'] = [$this->data['produto'] = "MolhoIngles", $this->data['quntidade43'], $this->data['valor_unitario43']];
          }
        } else {
          $produto['molhoIngles'] = [$this->data['produto'] = "MolhoIngles", $this->data['quntidade43'], $this->data['valor_unitario43']];
        }
      }
    } else {
      unset($this->data['quntidade43']);
      unset($this->data['valor_unitario43']);
    }

    if (isset($this->data['barbecue'])) {
      unset($this->data['barbecue']);
      if ((empty($this->data['quntidade44'])) or (empty($this->data['valor_unitario44']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Barbecue") {
              $exitbarbecue = true;
            }
          }
          if (!isset($exitbarbecue)) {
            $produto['barbecue'] = [$this->data['produto'] = "Barbecue", $this->data['quntidade44'], $this->data['valor_unitario44']];
          }
        } else {
          $produto['barbecue'] = [$this->data['produto'] = "Barbecue", $this->data['quntidade44'], $this->data['valor_unitario44']];
        }
      }
    } else {
      unset($this->data['quntidade44']);
      unset($this->data['valor_unitario44']);
    }

    if (isset($this->data['salchicha'])) {
      unset($this->data['salchicha']);
      if ((empty($this->data['quntidade45'])) or (empty($this->data['valor_unitario45']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Salchicha") {
              $exitsalchicha = true;
            }
          }
          if (!isset($exitsalchicha)) {
            $produto['salchicha'] = [$this->data['produto'] = "Salchicha", $this->data['quntidade45'], $this->data['valor_unitario45']];
          }
        } else {
          $produto['salchicha'] = [$this->data['produto'] = "Salchicha", $this->data['quntidade45'], $this->data['valor_unitario45']];
        }
      }
    } else {
      unset($this->data['quntidade45']);
      unset($this->data['valor_unitario45']);
    }

    if (isset($this->data['carneSeca'])) {
      unset($this->data['carneSeca']);
      if ((empty($this->data['quntidade46'])) or (empty($this->data['valor_unitario46']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "CarneSeca") {
              $exitcarneSeca = true;
            }
          }
          if (!isset($exitcarneSeca)) {
            $produto['carneSeca'] = [$this->data['produto'] = "CarneSeca", $this->data['quntidade46'], $this->data['valor_unitario46']];
          }
        } else {
          $produto['carneSeca'] = [$this->data['produto'] = "CarneSeca", $this->data['quntidade46'], $this->data['valor_unitario46']];
        }
      }
    } else {
      unset($this->data['quntidade46']);
      unset($this->data['valor_unitario46']);
    }

    if (isset($this->data['frango'])) {
      unset($this->data['frango']);
      if ((empty($this->data['quntidade47'])) or (empty($this->data['valor_unitario47']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Frango") {
              $exitfrango = true;
            }
          }
          if (!isset($exitfrango)) {
            $produto['frango'] = [$this->data['produto'] = "Frango", $this->data['quntidade47'], $this->data['valor_unitario47']];
          }
        } else {
          $produto['frango'] = [$this->data['produto'] = "Frango", $this->data['quntidade47'], $this->data['valor_unitario47']];
        }
      }
    } else {
      unset($this->data['quntidade47']);
      unset($this->data['valor_unitario47']);
    }

    if (isset($this->data['alho'])) {
      unset($this->data['alho']);
      if ((empty($this->data['quntidade48'])) or (empty($this->data['valor_unitario48']))) {
      } else {
        if (!empty($this->listRegistryAdd)) {
          foreach ($this->listRegistryAdd as $value) {
            if ($value['produto'] == "Alho") {
              $exitalho = true;
            }
          }
          if (!isset($exitalho)) {
            $produto['alho'] = [$this->data['produto'] = "Alho", $this->data['quntidade48'], $this->data['valor_unitario48']];
          }
        } else {
          $produto['alho'] = [$this->data['produto'] = "Alho", $this->data['quntidade48'], $this->data['valor_unitario48']];
        }
      }
    } else {
      unset($this->data['quntidade48']);
      unset($this->data['valor_unitario48']);
    }


    if ((isset($this->data['semCadastro'])) && (!empty($this->data['semCadastro'])) && (!empty($this->data['quntidade49'])) && (!empty($this->data['valor_unitario49']))) {
      if (!empty($this->listRegistryAdd)) {
        foreach ($this->listRegistryAdd as $value) {
          if ($value['produto'] == $this->data['semCadastro']) {
            $exiSemCadastro = true;
          }
        }
        if (!isset($exiSemCadastro)) {
          $produto[$this->data['semCadastro']] = [$this->data['produto'] = $this->data['semCadastro'], $this->data['quntidade49'], $this->data['valor_unitario49']];
        }
      } else {
        $produto[$this->data['semCadastro']] = [$this->data['produto'] = $this->data['semCadastro'], $this->data['quntidade49'], $this->data['valor_unitario49']];
      }
    } else {
      unset($this->data['quntidade49']);
      unset($this->data['valor_unitario49']);
    }
    if (isset($produto)) {
      date_default_timezone_set('America/Sao_Paulo');

      foreach ($produto as $key) {
        if (($key[0] == "CarneSeca") or ($key[0] == "Descartaveis")) {
          $this->data2['produto'] = $key[0];
          $this->data2['quantidade'] = $key[1];
          $this->data2['valor_unitario'] = $key[2];
          $this->data2['totsValor'] = $key[1] * $key[2];
          $this->pagPix($this->data2['totsValor']);
        } else {
          $this->data2['produto'] = $key[0];
          $this->data2['quantidade'] = $key[1];
          $this->data2['valor_unitario'] = $key[2];
          $this->data2['totsValor'] = $key[1] * $key[2];
          $this->data2['pontos'] = ($this->data2['totsValor'] / $this->valor_dolar) * 2.5;
          $this->pagCartao($this->data2['totsValor'], $this->data2['pontos']);
         
        }
        $this->addCompras();
      }
    }
  }
  private function addCompras(): void
  {
    $this->data2['creatdat'] =  date("Y-m-d H:i:s");
    $creatUser =  new \App\adms\Models\helper\AdmsCreate();
    $creatUser->exeCreate($this->nameTable, $this->data2);
    unset($this->data2);
    if ($creatUser->getResult()) {
    }
  }
  private function pagCartao($compra, $pontos): void
  {
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("M-Y");
    $nomeTable = str_replace("-", "", $data);
    $tab =  "compras_mes" . $nomeTable;

    $resultCartao = new \App\adms\Models\helper\AdmsCreate();
    $resultCartao->tableAddCartao($tab);

    $resultMes['compras_cartao'] = $compra;
    $resultMes['pontos_mes'] = $pontos;

    $readResultMes =  new \App\adms\Models\helper\AdmsRead();
    $readResultMes->fullRead("SELECT compras_cartao,pontos_mes FROM $tab");
    if ($readResultMes->getResult()) {
      $resultMes['creatdat'] =  date("Y-m-d H:i:s");
      $resultMes['compras_cartao'] += $readResultMes->getResult()[0]['compras_cartao'];
      $resultMes['pontos_mes'] += $readResultMes->getResult()[0]['pontos_mes'];
      $upAdmsUpdate = new \App\adms\Models\helper\AdmsUpdate();
      $upAdmsUpdate->exeUpdate($tab, $resultMes);
      if ($upAdmsUpdate->getResult()) {
        $_SESSION['msg'] = "<p style='color:green;'> Compras Atualizada com Secesso!</p>";
        $this->result = true;
      }
    } else {
      $addResultMes =  new \App\adms\Models\helper\AdmsCreate();
      $addResultMes->exeCreate($tab, $resultMes);
      if ($addResultMes->getResult()) {
        $resultMes['creatdat'] =  date("Y-m-d H:i:s");
        $_SESSION['msg'] = "<p style='color:green;'> Compras Cadastrado com Secesso!</p>";
        $this->result = true;
      }
    }
     $this->resultMes($compra, $pontos);
  }
  private function pagPix($pagPix): void
  {
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("M-Y");
    $nomeTable = str_replace("-", "", $data);
    $table = "compras_mes" . $nomeTable;

    $readResultMes =  new \App\adms\Models\helper\AdmsRead();
    $readResultMes->fullRead("SELECT compras_pix,creatdat FROM $table");
    if ($readResultMes->getResult()) {
      $compra_pix = $readResultMes->getResult()[0]['compras_pix'];
      $resultMes['creatdat'] =  date("Y-m-d H:i:s");
      $resultMes['compras_pix'] = $compra_pix + $pagPix;

      $upAdmsUpdate = new \App\adms\Models\helper\AdmsUpdate();
      $upAdmsUpdate->exeUpdate($table, $resultMes);
      if ($upAdmsUpdate->getResult()) {
        $_SESSION['msg'] = "<p style='color:green;'> Compras Atualizada com Secesso!</p>";
        $this->result = true;
      }
    } else {
      $resultMes['compras_pix'] = $pagPix;
      $resultMes['creatdat'] =  date("Y-m-d H:i:s");
      $addResultMes =  new \App\adms\Models\helper\AdmsCreate();
      $addResultMes->exeCreate($table, $resultMes);
      if ($addResultMes->getResult()) {
        $_SESSION['msg'] = "<p style='color:green;'> Compras Cadastrado com Secesso!</p>";
        $this->result = true;
      }
    }
    $pontos = 0;
      $this->resultMes($resultMes['compras_pix'], $pontos);
  }
  private function resultMes($compra, $pontos): void
  {
    date_default_timezone_set('America/Sao_Paulo');
    $data = date("M-Y");
    $nomeTable = str_replace("-", "", $data);
    $table = "result_" . $nomeTable;

    $tableResult = new \App\adms\Models\helper\AdmsCreate();
    $tableResult->tableAddResultMes($table);

    $readResultMes =  new \App\adms\Models\helper\AdmsRead();
    $readResultMes->fullRead("SELECT compras_cartao,pontos_mes,compras_pix FROM $table");
    if ($readResultMes->getResult()) {
      $resultMes['creatdat'] =  date("Y-m-d H:i:s");
      $resultMes['compras_cartao'] = $readResultMes->getResult()[0]['compras_cartao'];
    //  $resultMes['compras_pix'] = $readResultMes->getResult()[0]['compras_pix'];
      $resultMes['pontos_mes'] = $readResultMes->getResult()[0]['pontos_mes'];

      if ($pontos !=  0) {
        $resultMes['compras_cartao'] += $compra;
        $resultMes['pontos_mes'] += $pontos;
      } 
      $upAdmsUpdate = new \App\adms\Models\helper\AdmsUpdate();
      $upAdmsUpdate->exeUpdate($table, $resultMes);
    } else {
      if ($pontos !=  0) {
        $resultMes['creatdat'] =  date("Y-m-d H:i:s");
        $resultMes['compras_cartao'] = $compra;
        $resultMes['pontos_mes'] = $pontos;
      }
      $addResultMes =  new \App\adms\Models\helper\AdmsCreate();
      $addResultMes->exeCreate($table, $resultMes);
    }
    $readResultMes =  new \App\adms\Models\helper\AdmsRead();
    $readResultMes->fullRead("SELECT compras_cartao,compras_pix FROM $table");
    $totCompras = $readResultMes->getResult()[0];

    $resultMes['tots_compras'] = $totCompras['compras_cartao'] + $totCompras['compras_pix'];
    $upAdmsUpdate = new \App\adms\Models\helper\AdmsUpdate();
    $upAdmsUpdate->exeUpdate($table, $resultMes);
  }
}
