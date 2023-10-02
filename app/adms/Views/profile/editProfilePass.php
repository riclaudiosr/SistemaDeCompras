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
<div class="container">
  <h2>Editar Senha</h2>
  <div class="">
    <span id="msg"></span>
    <?php

    if (!empty($this->data['form'][0])) {
      $id = (int) $this->data['form'][0]['id'];
      echo "<a href='" . URLADM . "view-profile/index/$id'> Visualizar Perfil<a><br><br>";
    }
    ?>
  </div>
  <div>
    <form method="POST" id="formeditProfilePass">
      <label for="password" class="form-label">Senha<span style="color:#f00;">*</span></label>
      <?php
      $password = "";
      if (isset($valorForm['password'])) {
        $password = $valorForm['password'];
      }
      ?>
      <input type="password" class="form-control" name="password" id="password" placeholder="Digite a nova senha" onkeyup="passwordStrength()" autocomplete="on" value="<?php echo $password; ?>" required>
      <div id="password" class="form-text">Digite seu senha atualizado.<span style="color:#f00;">* Campos obrigatórios</span>
        <span id="msgViewStrength"></span>
      </div>

      <button type="submit" class="btn btn-primary" name="sendEditProfilePass" value="Salva">Salvar</button><br>
    </form>
  </div>
</div>