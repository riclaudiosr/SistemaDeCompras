<?php
if (!defined('RSR1937NA')) {
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
}

?>
<?php
//var_dump($this->data);
$padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
//  var_dump($hoje, $ontem, $anteontem);
$tableA = '<table class="table">';
$tableF = '</table>';
$tbodyA = '<tbody>';
$tbodyF = '</tbody>';
$trI = "<tr>";
$trF = "</tr>";
$tdI = "<td>";
$tdF = "</td>";
$thI = "<th>";
$thF = "</th>";
$h2I = "<h2>";
$h2F = "</h2>";

if (isset($this->data['result'])) {
    if (isset($this->data['result']['totsDia'])) {
        $compraCartao = (float) $this->data['result']['resultCartao']['compras_cartao'];
        $pontuacaoMes = (float) $this->data['result']['resultCartao']['pontos_mes'];
        $totsDia = (float) $this->data['result']['totsDia']['totsDia'];
        $totsPontos = (float) $this->data['result']['totsDia']['totPontos'];
    } else {
        $compraCartao = (float) $this->data['result']['resultMes']['compras_cartao'];
        $pontuacaoMes = (float) $this->data['result']['resultMes']['pontos_mes'];
    }
    $comprasPix = (float) $this->data['result']['resultMes']['compras_pix'];
    $totsCompras = (float) $this->data['result']['resultMes']['tots_compras'];
    $pixMes = (float) $this->data['result']['resultMes']['pix_mes'];
    $addFatura = (float) $this->data['result']['resultMes']['add_fatura'];
    $salario = (float) $this->data['result']['resultMes']['salario'];
    $saldo = (float) $this->data['result']['saldo'];
}
if (isset($this->data['datCompra'])) {
    $data = $this->data['datCompra'];
}

?>
<div class="container-xxl">
    <div class="telaFundo">
        <div class="wrapper">
            <div class="topoTela">
                <div class="box-first01 table-responsive-md">
                    <table class="table table-light table-hover">
                        <thead class="table-dark">
                            <tr>
                                <td>Compra Cartão</td>
                                <td>Compra Pix</td>
                                <td>Ponto do Mes</td>
                                <td>Total da Compra</td>
                                <td>Pix Mes</td>
                                <td>Add da Fatura</td>
                                <td>Salario Mes</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php
                                    if (isset($this->data['result'])) {
                                        echo numfmt_format_currency($padrao, $compraCartao, "BRL");
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($this->data['result'])) {
                                        echo numfmt_format_currency($padrao, $comprasPix, "BRL");
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($this->data['result'])) {
                                        echo number_format($pontuacaoMes, 2);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($this->data['result'])) {
                                        echo numfmt_format_currency($padrao, $totsCompras, "BRL");
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($this->data['result'])) {
                                        echo numfmt_format_currency($padrao, $pixMes, "BRL");
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($this->data['result'])) {
                                        echo numfmt_format_currency($padrao, $addFatura, "BRL");
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($this->data['result'])) {
                                        echo numfmt_format_currency($padrao, $salario, "BRL");
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-first">
                    <?php
                    if (isset($data)) {
                        $datSist = date("d-M-Y", strtotime($data));
                        echo $h2I . "Compras do dia " . $datSist . $h2F;
                    }
                    ?>
                    <form action="<?= URLADM ?>dashboard/index" method="post">
                        <input type="date" name="datLocal" id="datLocal" value="<?= $data ?>">
                        <input type="submit" class="btn-primary" name="selectDia" value="Buscar">
                    </form>
                </div>
            </div>
            <?php if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            } ?>
            <div class="">
                <table class="table  table-dark table-striped table-hover ">
                    <?php
                    if (isset($this->data['result']['compraDia'])) {  ?>
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Valor_unitario</th>
                                <th>Total</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totDiaCompras = 0;
                            $totPontosDia = 0;
                            foreach ($this->data['result']['compraDia'] as $value) {
                                $totDiaCompras += $value['totsValor'];
                                $totPontosDia +=  $value['pontos'];
                                $total = $value['totsValor'];
                                extract($value);
                            ?> <tr>
                                    <td><?= $id ?></td>
                                    <td><?= $produto ?></td>
                                    <td><?= number_format($quantidade, 1) ?></td>
                                    <td><?= number_format($valor_unitario, 2)  ?></td>
                                    <td><?= numfmt_format_currency($padrao, $total, "BRL") ?></td>
                                    <td class="list-body-content">
                                        <div class="dropdown-action">
                                            <button onclick="actionDropdown(<?= $id ?>)" class="dropdown-btn-action">Ações</button>
                                            <div id="actionDropdown<?= $id ?>" class="dropdown-action-item">
                                                <?php
                                                echo "<a href='" . URLADM . "edite-produto/index/$id'>Editar</a>";
                                                echo "<a href='" . URLADM . "delete-produto/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'>Apagar</a>";
                                                ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot class="footTable">
                            <tr>
                                <td>
                                <th>Tots Compra</th>
                                <td colspan=""><?= numfmt_format_currency($padrao, $totsDia, "BRL") ?> </td>
                                </td>
                                <td>
                                <th>Tots Pontos</th>
                                <td colspan=""><?= number_format($totsPontos, 2) ?></td>
                                </td>
                            </tr>

                        </tfoot>
                    <?php
                    }
                    ?>
                </table>
                <div class="pagination">
                    <?php if (isset($this->data['result']['compraDia'])) {
                        echo $this->data['pagination'];
                    }
                    ?>
                </div>
            </div>
            <div class="valoresAdd">
                <form action="<?= URLADM ?>dashboard/index" method="post">
                    <table class="table table-dark table-bordered">
                        <tbody>
                            <tr>
                                <th>
                                    <label for="addFat">Valor Add Fatura</label>
                                </th>
                                <th>
                                    <label for="pixDia">Valor Pix do dia</label>
                                </th>
                                <th>
                                    <label for="valorSemana">Pag Semana</label>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addFatt" id="addFat">
                                </td>
                                <td>
                                    <input type="text" name="pixDia" id="pixDia">
                                </td>
                                <td>
                                    <input type="text" name="valorSemana" id="valorSemana">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="submit" class=" btn-primary" name="formAddValores" value="Enviar">
                </form>
            </div>

        </div>
    </div>
    <div class="rodape">

        <div class="box-first">

            <span>Saldo <?php
                        if (isset($saldo)) {
                            echo numfmt_format_currency($padrao, $saldo, "BRL");
                        } else {
                            echo numfmt_format_currency($padrao, 0, "BRL");
                        }
                        ?></span>
        </div>
    </div>
</div>
</div>
</article>