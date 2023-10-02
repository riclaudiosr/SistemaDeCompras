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

<div class="container">
  <h2>Detalis do Usuário</h2>
  <div class="col-4">
    <?php
    if (!empty($this->data['viewUser'])) {
      //   var_dump($this->data['viewUser'][0]);
      extract($this->data['viewUser'][0]);
      //imprime a imagem de perfil do usuário se ela existir caso contrário imprime um afvatar
    ?>
      <div class="col-6">
        <?php
        if ((!empty($image)) and (file_exists("app/adms/assets/img/users/$id/$image"))) {
          echo "<img src='" . URLADM . "app/adms/assets/img/users/$id/$image' width='100' height='100'<br><br>";
        } else {
          echo "<img src='" . URLADM . "app/adms/assets/img/users/avatar.jpg' width='100' height='100'<br><br>";
        }
        ?>
      </div>

  </div>


  <div class="row col-12">
    <div class="col-6">
    <?php
      echo "<strong>ID:</strong> $id <br>";
      echo "<strong>Nome:</strong> $name_usr <br>";
      echo "<strong>Nome Social:</strong> $nickname <br>";
      echo "<strong>Usuário:</strong> $user <br>";
      echo "<strong>E-mail:</strong> $email <br>";
      // echo "<strong>Imagem:</strong> $image <br>";
      echo "<strong> Situação do usuario:</strong><span style='color:green;'> $name_sit</span>  <br>";
      //echo "<strong>Cor da Situação do usuario:</strong> $color_sit  <br>";
      echo "<strong>Data do registro:</strong> " . date('d/m/Y H:i:s', strtotime($created)) . "<br>";
      echo "<strong>Data de alteração do registro:</strong> ";
      if (!empty($modified)) {
        echo date('d/m/Y H:i:s', strtotime($modified));
      } else {
        $modified = " NULL";
        echo "$modified <br>";
      }
      echo "</p>";
    }
    ?>
    </div>
    <div class="col-6">

      <?php
      echo "<a href='" . URLADM . "list-users/index'>Listar Usuários </a><br>";
      if (!empty($this->data['viewUser'][0])) {
        $id = (int) $this->data['viewUser'][0]['id'];
        echo "<a href='" . URLADM . "edite-user/index/$id'> Editar Usuário<a><br>";
        echo "<a href='" . URLADM . "delete-user/index/$id' onclick='return confirm(\"Deseja exculir o registro\")'>Apagar<a><br>";
        echo "<a href='" . URLADM . "edit-users-image/index/$id'> Editar Imagem<a><br>";
        echo "<a href='" . URLADM . "edit-password/index/$id'> Editar Senha<a><br><br>";
      }
      ?>

    </div>

  </div>

</div>
