<?php

if(!defined('RSR1937NA')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
}
?>

<h1>Editar Senha da Configuração de Email</h1>

<?php

echo "<a href='" . URLADM . "list-conf-emails/index'>Listar</a><br>";
if (isset($valorForm['id'])) {
    echo "<a href='" . URLADM . "view-conf-emails/index/" . $valorForm['id'] . "'>Visualizar</a><br>";
    echo "<a href='" . URLADM . "edit-conf-emails/index/" . $valorForm['id'] . "'>Editar</a><br>";
    echo "<a href='" . URLADM . "delete-conf-emails/index/" . $valorForm['id'] . "'>Apagar</a><br><br>";
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span id="msg"></span>

<form method="POST" action="" id="form-edit-conf-emails-pass">
    <?php
    $id = "";
    if (isset($valorForm['id'])) {
        $id = $valorForm['id'];
    }
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

    <?php
    $password = "";
    if (isset($valorForm['password'])) {
        $password = $valorForm['password'];
    }
    ?>
    <label>Senha:<span style="color: #f00;">*</span> </label>
    <input type="password" name="password" id="password" placeholder="Senha do e-mail" value="<?php echo $password; ?>"><br><br>

    <span style="color: #f00;">* Campo Obrigatório</span><br><br>

    <button type="submit" name="SendEditConfEmailsPass" value="Salvar">Salvar</button>
</form>