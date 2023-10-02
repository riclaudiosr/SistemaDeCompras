<?php
if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

if (isset($this->data['form'])) {
  //  var_dump($this->data['form']);
  $valorForm = $this->data['form'];
}

if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}

?>
<span id="msg"></span>
<div class="contener-login">
  <div class="wrapper-login">
    <div class="title">
      <span>Área Restrita</span>
    </div>
    <form action="" class="form-login" method="POST" id="form-login">
      <div class="row">
    
        <i class="fa-solid fa-user"></i>
        <input type="text" name="user" id="user" placeholder="Digite o Usuário" value="<?php if (isset($valorForm['user'])) {
                                                                                          echo "{$valorForm['user']}";
                                                                                        } ?>" required>
      </div>

      <div class="row">
        <i class="fa-solid fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Digite o Senha" value="" required>
      </div>
      <div >
        <button type="submit"class="button" name="sendLogin" value="Acessar">Acessar</button>
      </div>

    </form>

    <div class="slink">
      
        <a href="<?php echo URLADM ?>new-user/index">Cadrastrar </a>
      
      
        <a href="<?php echo URLADM ?>recover-password/index"> Esqueceu a senha</a>
  

    </div>

    <h5>Usuario: claudio@dev</h5>
    <h5>Senha: 123456a</h5>
  </div>
</div>