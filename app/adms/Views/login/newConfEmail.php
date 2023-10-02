<?php
if(!defined('RSR1937NA')){
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
 }

if(isset($this->data['form'])){
  //  var_dump($this->data['form']);
    $valorForm=$this->data['form'];
}
 //password_hash("123456a", PASSWORD_DEFAULT);
if(isset($_SESSION['msg'])){
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}
?>
<span id="msg"></span>

<h2>Ative seu E-mail - ACESSO</h2>
<form action="" method="POST" id="form-new-conf-email">
   <label for="user">Email <span style="color:#f00;">*</span></label> 
   <input type="email" name="email" id="email" placeholder="Digite o seu email" value="<?php if(isset($valorForm['email'])){echo $valorForm['email']; } ?>"requerid><br><br>
   <span style="color:#f00;">* Campos obrigatórios</span><br><br>
    <button type="submit" name="sendNewConEmail" value="Enviar">Enviar</button><br>
   
</form>

<p><a href="<?php echo URLADM?>Login/index">Clik Aqui</a> para acessar</p>
