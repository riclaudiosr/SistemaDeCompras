<?php
if (!defined('RSR1937NA')) {
  //   header("Location: /");
  die("Erro: pagina nao encontrada");
}
if (isset($_SESSION['msg'])) {
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}
?>

    <div class="container text-center">
    <h2>Perfil do Usuário</h2>

      
        <div class="row col-12">
          <div class="row">
            <div class="col-6">
              <?php
              if (!empty($this->data['viewProfile'])) {
                extract($this->data['viewProfile'][0]);
                if ((!empty($image)) and (file_exists("app/adms/assets/img/users/" . $_SESSION['user_id'] . "/$image"))) {
                  echo "<img src='" . URLADM . "app/adms/assets/img/users/" . $_SESSION['user_id'] . "/$image' width='100' height='100'<br><br>";
                } else {
                  echo "<img src='" . URLADM . "app/adms/assets/img/users/avatar.jpg' width='100' height='100'<br><br>";
                }
              }
              ?>
            </div>
            <div class="col-6">
              <div>
                <?php
                echo "<strong>Nome:</strong> $name <br>";
                ?>
              </div>
              <div>
                <?php
                echo "<strong>Nome Social:</strong> $nickname <br>";
                ?>
              </div>
              <div>
                <?php
                echo "<strong>E-mail:</strong> $email <br>";
                ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div >
                <?php
                if (!empty($this->data['viewProfile'][0])) {
                  $id = (int) $this->data['viewProfile'][0]['id'];
                  echo "<a href='" . URLADM . "edit-profile/index'> Editar Perfil<a><br>";
                }
                ?>
              </div>
              <div>
                <?php
                echo "<a href='" . URLADM . "edit-Profile-img/index/$id'> Editar foto<a><br>";
                ?>
              </div>
              <div>
                <?php
                echo "<a href='" . URLADM . "edit-profile-password/index/$id'> Editar Senha<a><br>";
                ?>
              </div>
              <div>
                <?php
                echo "<a href='" . URLADM . "delete-user/index/$id' onclick='return confirm(\"Deseja exculir este Perfil\")'>Apagar Perfil<a><br>";
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>