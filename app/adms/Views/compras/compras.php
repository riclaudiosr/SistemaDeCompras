<?php
if (!defined('RSR1937NA')) {
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
}
?>

<div class="wrapper">
    <div class="row table-responsive-sm">
        <div class="list-compras table-responsive-sm">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <form class="table-responsive-xxl " action="<?= URLADM ?>add-compras/index" method="POST">
                <table class="table table-light table-responsive-sm">
                    <thead class="table-dark">
                        <tr class="tr-1">
                            <th>Balcão</th>
                            <th>Cozinha</th>
                            <th>Bebidas</th>
                        </tr>
                    </thead>
                    <tbody class="table-dark">
                        <tr class="align-top">
                            <td class="td-1 table-responsive-sm">
                                <table class="table table-light table-bordered table-hover">
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quant</th>
                                        <th>Preço</th>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="catupiry" id="catupiry"><label for="catupiry">Catupiry</label> </td>
                                        <td><input type="text" name="quntidade1" step="0.001" id="" placeholder="0.00R$"></td>
                                        <td> <input type="text" name="valor_unitario1" id="" step="0.001" placeholder="0.00Un"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="chedder" id="chedder"><label for="chedder">Chedder</label> </td>
                                        <td><input type="text" name="quntidade2" step="0.001" id="" placeholder="0.00R$"></td>
                                        <td><input type="text" name="valor_unitario2" id="" step="0.001" placeholder="0.00Un"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="requeijao" id="requeijao"><label for="requeijao">Requeijão</label> </td>
                                        <td><input type="text" name="quntidade3" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario3" id="" step="0.001" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="cremeLeite" id="cremeLeite"><label for="cremeLeite">Creme de leite</label> </td>
                                        <td><input type="text" name="quntidade4" id=""  placeholder="0.00Cx"></td>
                                        <td> <input type="text" name="valor_unitario4" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="tomateSeco" id="tometeSeco"><label for="tometeSeco">Tomate seco</label> </td>
                                        <td><input type="text" name="quntidade5" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario5" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"> <input type="checkbox" name="manteiga" id="manteiga"><label for="manteiga">Manteiga</label> </td>
                                        <td> <input type="text" name="quntidade6" id=""step="0.001" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario6" id="" step="0.001" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr class="novoProduto">
                                        <td ><input type="text" id="novo" name="semCadastro" placeholder="Novo Produto"></td>
                                        <td><input type="text"  name="quntidade49" id=""  placeholder="0.00Un"></td>
                                        <td><input type="text"  name="valor_unitario49" id=""  placeholder="0.00R$"></td>
                                    </tr>
                                </table>
                            </td>
                            <td class="td-1 table-responsive-sm">
                                <table class="table table-light table-bordered table-hover">
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quant</th>
                                        <th>Preço</th>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="moida" id="carneMoida"><label for="carneMoida">Carne Moida</label></td>
                                        <td><input type="text" name="quntidade24" id="" placeholder="0.00K"></td>
                                        <td><input type="text" name="valor_unitario24" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="bacalhau" id="bacalhau"><label for="bacalhau">Bacalhau</label> </td>
                                        <td><input type="text" name="quntidade25" id="" placeholder="0.00K"></td>
                                        <td><input type="text" name="valor_unitario25" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="leite" id="leite"><label for="leite">Leite</label> </td>
                                        <td><input type="text" name="quntidade26" id="" placeholder="0.00Cx"></td>
                                        <td><input type="text" name="valor_unitario26" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="champy" id="champhion"><label for="champhion">Champhion</label> </td>
                                        <td><input type="text" name="quntidade27" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario27" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="bacon" id="bacon"> <label for="bacon">Bacon</label></td>
                                        <td><input type="text" name="quntidade28" id="" placeholder="0.00K"></td>
                                        <td><input type="text" name="valor_unitario28" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="palmito" id="palmito"><label for="palmito">Palmito</label> </td>
                                        <td><input type="text" name="quntidade29" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario29" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="azeitonaV" id="azeitonaVerde"><label for="azeitonaVerde">AzeitonaVerde</label></td>
                                        <td><input type="text" name="quntidade30" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario30" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="azeitonaP" id="azeitonaP"> <label for="azeitonaP">AzeitonaPreta</label></td>
                                        <td><input type="text" name="quntidade31" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario31" id="" placeholder="0.00R$"></td>
                                    </tr>

                                    <tr>
                                        <td id="desc"><input type="checkbox" name="margarina" id="margarina"> <label for="margarina">Margarina</label></td>
                                        <td><input type="text" name="quntidade32" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario32" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="gordura" id="gordura"> <label for="gordura">Gorduras</label></td>
                                        <td><input type="text" name="quntidade33" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario33" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="calabresa" id="calabresa"> <label for="calabresa">Calabresa</label></td>
                                        <td><input type="text" name="quntidade34" id="" placeholder="0.00K"></td>
                                        <td><input type="text" name="valor_unitario34" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="extrato" id="extrato"><label for="extrato">Extrato</label></td>
                                        <td><input type="text" name="quntidade35" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario35" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="ketchup" id="ketchup"><label for="ketchup">Ketchup</label></td>
                                        <td><input type="text" name="quntidade36" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario36" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="milho" id="milho"><label for="milho">Milho</label></td>
                                        <td><input type="text" name="quntidade37" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario37" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="amido" id="amido"><label for="amido">Amido</label></td>
                                        <td><input type="text" name="quntidade38" id="" placeholder="0.00k"></td>
                                        <td><input type="text" name="valor_unitario38" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="farinha" id="farinha"><label for="farinha">Farinha</label></td>
                                        <td><input type="text" name="quntidade39" id="" placeholder="0.00k"></td>
                                        <td><input type="text" name="valor_unitario39" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="azeite" id="azeite"><label for="azeite">Azeite</label></td>
                                        <td><input type="text" name="quntidade40" id="" placeholder="0.00k"></td>
                                        <td><input type="text" name="valor_unitario40" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="caldoCarne" id="caldoCarne"><label for="caldoCarne">Caldo carne</label></td>
                                        <td><input type="text" name="quntidade41" id="" placeholder="0.00k"></td>
                                        <td><input type="text" name="valor_unitario41" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="caldoGalinha" id="caldoGalinha"><label for="caldoGalinha">Caldo galinha</label></td>
                                        <td><input type="text" name="quntidade42" id=""></td>
                                        <td><input type="text" name="valor_unitario42" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="molhoIngles" id="molhoIngles"><label for="molhoIngles">Molho ingles</label></td>
                                        <td><input type="text" name="quntidade43" id="" placeholder="0.00L"></td>
                                        <td><input type="text" name="valor_unitario43" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="barbecue" id="barbecue"><label for="barbecue">Barbecue</label></td>
                                        <td><input type="text" name="quntidade44" id="" placeholder="0.00l"></td>
                                        <td><input type="text" name="valor_unitario44" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="salchicha" id="salchicha"><label for="salchicha">Salchicha</label></td>
                                        <td><input type="text" name="quntidade45" id="" placeholder="0.00k"></td>
                                        <td><input type="text" name="valor_unitario45" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="carneSeca" id="carneSeca"><label for="carneSeca">Carne seca</label></td>
                                        <td><input type="text" name="quntidade46" id="carneSeca" placeholder="0.00k"></td>
                                        <td><input type="text" name="valor_unitario46" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="frango" id="frango"><label for="frango">Frango</label></td>
                                        <td><input type="text" name="quntidade47" id="frango" placeholder="0.00k"> </td>
                                        <td><input type="text" name="valor_unitario47" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="alho" id="alho"><label for="alho">Alho</label></td>
                                        <td><input type="text" name="quntidade48" id="alho" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario48" id="" placeholder="0.00R$"></td>
                                    </tr>
                                </table>
                            </td>
                            <td class="td-1 table-responsive-sm">
                                <table class="table table-light table-bordered table-hover">
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quant</th>
                                        <th>Preço</th>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="cocaLata" id="cocaLata"><label for="">Coca lata</label></td>
                                        <td><input type="text" name="quntidade15" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario15" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="agua" id="agua"><label for="agua">Agua</label></td>
                                        <td><input type="text" name="quntidade16" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario16" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="aguaGas" id="aguac/gas"><label for="aguac/gas">Agua c/gas</label></td>
                                        <td><input type="text" name="quntidade17" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario17" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="fantaL" id="fantaLaraja"> <label for="fantaLaraja">Fanta laranja</label></td>
                                        <td><input type="text" name="quntidade18" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario18" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="fantaU" id="fantaUva"><label for="fantaUva">Fanta uva</label></td>
                                        <td><input type="text" name="quntidade19" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario19" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="sprity" id="sprity"><label for="sprity">Sprity</label></td>
                                        <td><input type="text" name="quntidade20" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario20" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="citros" id="schweppes"><label for="schweppes">Schweppes</label></td>
                                        <td><input type="text" name="quntidade21" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario21" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="sucos" id="sucos"> <label for="sucos">Sucos</label></td>
                                        <td><input type="text" name="quntidade22" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario22" id="" placeholder="0.00R$"></td>
                                    </tr>
                                    <tr>
                                        <td id="desc"><input type="checkbox" name="pets" id="pet"><label for="oet">pet600</label></td>
                                        <td><input type="text" name="quntidade23" id="" placeholder="0.00Un"></td>
                                        <td><input type="text" name="valor_unitario23" id="" placeholder="0.00R$"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="submit" class="btn-primary" value="Enviar" name="addCompras">
            </form>

        </div>
    </div>
</div>
</article>