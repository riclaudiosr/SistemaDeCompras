<?php
if(!defined('RSR1937NA')){
    //   header("Location: /");
    die("Erro: pagina nao encontrada");
   }

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
?>

<h1>Recuperar Senha - ACESSO</h1>

<?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>
<span id="msg"></span>

<form method="POST" action="" id="form-recover-pass">

    <?php
    $email = "";
    if (isset($valorForm['email'])) {
        $email = $valorForm['email'];
    }
    ?>
    <label>E-mail: <span style="color:#f00;">*</span></label>
    <input type="email" name="email" id="email" placeholder="Digite o seu e-mail de cadastro" value="<?php echo $email; ?>" required><br><br>
    <span style="color:#f00;">* Campos obrigatórios</span><br><br>
    <button type="submit" name="SendRecoverPass" value="Recuperar">Recuperar</button>
</form>

<p><a href="<?php echo URLADM; ?>">Clique aqui</a> para acessar</p>