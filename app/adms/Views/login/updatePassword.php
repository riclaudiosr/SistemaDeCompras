<?php
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

if(isset($this->data['form'])){
  //  var_dump($this->data['form']);
    $valorForm=$this->data['form'];
}
if(isset($_SESSION['msg'])){
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}

?>

<span id="msg"></span>

<h2>Nova Senha - ACESSSO</h2>
<form action="" method="POST" id="form-update-pass">
 
   <label for="user"><span style="color:#f00;">* Nova Senha<span>, deve ter no minimo 6 caracteres, letras e numeros </label><br> 
   <?php
   
    $password = "";
    if (isset($valorForm['password'])) {
        $password = $valorForm['password'];
    }
    ?>
   <input type="password" name="password" id="password" placeholder="Digite sua nova senha " 
   onkeyup="passwordStrength()" autocomplete="on" value="<?php echo $password; ?>" required>
   <span id="msgViewStrength"><br><br></span>

    <button type="submit" name="sendUpdatePass" value="Salvar">Salvar</button><br>
   
</form>

<p><a href="<?php echo URLADM?>Login/index">Clik Aqui</a> para acessar</p>
