<?php
if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}

if (isset($this->data['form'])) {
  $valorForm = $this->data['form'];
}
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}

?>
<div class="container">
  <span id="msg"></span>
  <h2>Cadastrar novo Usuário - ADM</h2>
  <div>
    <?php
    echo "<a href='" . URLADM . "list-users/index'>Listar Usuários </a><br>";
    ?>
  </div>
  <div>
    <form action="" method="POST" id="form-addUser">

      <div class="mb-3">
        <label for="name" class="form-label">Nome<span style="color:#f00;">*</span></label>
        <?php
        $name = "";
        if (isset($valorForm['name'])) {
          $name = $valorForm['name'];
        }
        ?>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Digite o nome completo" value="<?php echo $name; ?>">
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
        <input type="text" name="user" class="form-control" id="user" placeholder="Digite seu Usuário" value="<?php echo $user; ?>">
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
        <input type="text" class="form-control" name="email" id="email" placeholder="Digite o seu email" value="<?php echo $email; ?>">
        <div id="emailHelp" class="form-text">Digite seu e-mail atualizado.<span style="color:#f00;">* Campos obrigatórios</span></div>
      </div>

      <label for="adms_sits_user_id" class="form-label"> Situação <span style="color:#f00;">*</span></label>
      <select name="adms_sits_user_id" id="adms_sits_user_id" class="form-select">
        <option value="">Selecione</option>
        <?php
        foreach ($this->data['select']['sit'] as $sit) {
          extract($sit);
          if ((isset($valorForm['adms_sits_user_id'])) and ($valorForm['adms_sits_user_id'] == $id_sit)) {
            echo "<option value=' $id_sit'selected> $name_sit</option>";
          } else {
            echo "<option value=' $id_sit'> $name_sit</option>";
          }
        }

        ?>
      </select><br><br>

      <label for="password" class="form-label">Senha: <span style="color:#f00;">*</span></label>
      <?php
      if (!empty($valorForm['password'])) {
        $password = $valorForm['password'];
      } else {
        $password = "";
      }
      ?>
      <input type="password" class="form-control" name="password" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()" autocomplete="on" value="<?php echo $password; ?>">
      <span id="msgViewStrength"></span>
      <div id="emailHelp" class="form-text">Digite seu e-mail atualizado.<span style="color:#f00;">* Campos obrigatórios</span></div>

      <button type="submit" class="btn btn-primary" name="sendAddUser" value="Cadastrar">Cadrastar</button><br>

    </form>
  </div>
</div>