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
 
 <div class="contener-login">
  <div class="wrapper-login">
    <div class="title">
      <span>Cadastrar Usuário</span>
    </div>
    <form class="form-login" method="POST" id="form-new-nser">
      <div class="row-input">
        <div class="row">
          <?php
          $name = "";
          if (isset($valorForm['name'])) {
            $name = $valorForm['name'];
          }
          ?>
          <input type="text" name="name" id="name" placeholder="Digite o nome completo" value="<?php echo $name ?>" required>
        </div>
      </div>

     
      <div class="row-input">
        <div class="row">
          <?php
          $nickName = "";
          if (isset($valorForm['nickname'])) {
            $nickName = $valorForm['nickname'];
          }
          ?>
          <input type="text" name="nickname" id="nickname" placeholder="Digite nome social" value="<?php echo $nickName ?>">
        </div>
        <div class="row">
          <?php
          $email = "";
          if (isset($valorForm['email'])) {
            $email = $valorForm['email'];
          }
          ?>
          <input type="email" name="email" id="email" placeholder="Digite o seu email" value="<?php echo $email ?>" required>
        </div>
      </div>
      <div class="row-input">
        <div class="row">
          <?php
          $password = "";
          if (isset($valorForm['password'])) {
            $password = $valorForm['password'];
          }
          ?>

          <input type="password" name="password" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()" autocomplete="on" value="<?php echo $password; ?>" required>
        </div>
        <span id="msgViewStrength"><br><br></span>
      </div>
      <div class="slink">
        <button type="submit" name="sendNewUser" value="Cadastrar">Cadrastar</button>
        <a href="<?php echo URLADM ?>Login/index">Voltar</a>
      </div>

    </form>
  </div>
</div>
