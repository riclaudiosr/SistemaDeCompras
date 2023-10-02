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
?>





<div class="container">
  <div>
    <span id="msg"></span>
    <h2>Editar Senha - ADM</h2>
    <div>
      <?php
      //LINK PARA A PAGINA VISUALIZAR E LISTAR
     // echo "<br><br><a href='" . URLADM . "list-users/index'>Listar Usuários </a><br>";
      if (!empty($this->data['form'][0])) {
        $id = (int) $this->data['form'][0]['id'];
        echo "<a href='" . URLADM . "view-user/index/$id'> Visualizar Usuário<a>";
      }
      ?>
    </div>
  </div>
  <form action="" method="POST" id="form-editPass">
    <?php
    $id = "";
    if (isset($valorForm['id'])) {
      $id = $valorForm['id'];
    }
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
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
    <button type="submit" class="btn btn-primary" name="sendEditPass" value="Salva">Salvar</button><br>
  </form>
</div>