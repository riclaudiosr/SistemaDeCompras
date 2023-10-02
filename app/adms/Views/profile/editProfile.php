<?php
if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}


if (isset($this->data['form'])) {
  $valorForm = $this->data['form'];
}
if (isset($this->data['form'][0])) {
  $valorForm = $this->data['form'][0];
}

if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}
//var_dump($valorForm=$this->data['form'][0]);
?>
<span id="msg"></span>




<div class="container">
  <h2>Editar Perfil</h2>
  <div class="row col-12">
    <?php
    //LINK PARA A PAGINA VISUALIZAR E LISTAR

    if (!empty($this->data['form'][0])) {
      $id = (int) $this->data['form'][0]['id'];
      echo "<a href='" . URLADM . "view-profile/index/$id'> Visualizar Perfil<a><br><br>";
    }
    ?>
  </div>
  <form method="POST" id="form-editProfile">

    <div class="mb-3">
      <label for="name" class="form-label">Nome<span style="color:#f00;">*</span></label>
      <?php
      $name = "";
      if (isset($valorForm['name'])) {
        $name = $valorForm['name'];
      }
      ?>
      <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Digite o nome completo" value="<?php echo $name; ?>" required>
      <div id="nameHelp" class="form-text">Digite seu nome completo para o cadastro. <span style="color:#f00;">* Campos obrigatórios</span></div>
    </div>

    <div class="mb-3">
      <label for="nicknam" class="form-label">Nome social</label>
      <?php
      $nickname = "";
      if (isset($valorForm['nickname'])) {
        $nickname = $valorForm['nickname'];
      }
      ?>
      <input type="text" name="nickname" id="nickname" class="form-control" placeholder="Digite nome social" value="<?php echo $nickname; ?>">
      <div id="nameHelp" class="form-text">Este campo não e obrigatório o prenchiment.</div>
    </div>

    <div class="mb-3">
      <label for="user" class="form-label">Usuário <span style="color:#f00;">*</span></label>
      <?php
      $user = "";
      if (isset($valorForm['user'])) {
        $user = $valorForm['user'];
      }
      ?>
      <input type="text" name="user" class="form-control" id="user" placeholder="Digite seu Usuário" value="<?php echo $user; ?>" required>
      <div id="nameHelp" class="form-text">Digite seu usuário de cadastro.<span style="color:#f00;">* Campos obrigatórios</span></div>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">E-mail <span style="color:#f00;">*</span></label>
      <?php
      $email = "";
      if (isset($valorForm['email'])) {
        $email = $valorForm['email'];
      }
      ?>
      <input type="text" class="form-control" name="email" id="email" placeholder="Digite o seu email" value="<?php echo $email; ?>" required>
      <div id="nameHelp" class="form-text">Digite seu e-mail atualizado.<span style="color:#f00;">* Campos obrigatórios</span></div>
    </div>
    <button type="submit" class="btn btn-primary" name="sendEditProfile" value="Salva">Salvar</button><br>
  </form>
</div>