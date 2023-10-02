<?php
if (!defined('RSR1937NA')) {
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
}

?>

<div class="container">
    <div class="wrapper">
        <div class="row">
            <form action="" name="form-edit-produto" method="post">
            
                <label for="quantidade">Quantidade</label>
                <input type="text" name="quantidade" id="quantidade" placeholder="Quantidade">
                <label for="valor_unitario">Valor Unitário</label>
                <input type="text" name="valor_unitario" id="valor_unitario" placeholder="Valor">
                <input type="submit" name="sendEditProduto" value="Editar">
            </form>
        </div>
    </div>
</div>