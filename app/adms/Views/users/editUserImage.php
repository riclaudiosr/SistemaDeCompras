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
?>






<div class="container">
    <div>
        <div>
            <span id="msg"></span>
            <h1>Editar Imagem - ADM</h1>
            <div>
                <?php
               // echo "<a href='" . URLADM . "list-users/index'>Listar</a><br>";
                if (isset($valorForm['id'])) {
                    echo "<a href='" . URLADM . "view-user/index/" . $valorForm['id'] . "'>Visualizar</a><br><br>";
                }
                if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </div>
        </div>
    </div>
    <form method="POST" action="" id="form-edit-img" enctype="multipart/form-data">
        <?php
        $id = "";
        if (isset($valorForm['id'])) {
            $id = $valorForm['id'];
        }
        ?>
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        <div>
            <label>Imagem:<span style="color: #f00;">*</span> </label>
            <input type="file" name="new_image" id="new_image" onchange="inputFileImg()" ><br>
            <?php
            if ((!empty($valorForm['image'])) and (file_exists("app/adms/assets/img/users/" . $_SESSION['user_id'] . "/" . $valorForm['image']))) {
                $old_image = URLADM . "app/adms/assets/img/users/" . $_SESSION['user_id'] . "/" . $valorForm['image'];
            } else {
                $old_image = URLADM . "app/adms/assets/img/users/avatar.jpg";
            }
            ?>
            <div id="imgHelp" class="form-text">Selecione uma imagem jpg ou phg. <span style="color:#f00;">* Campos obrigatórios</span></div>
        </div>
        <span id="preview-img">
            <img src="<?php echo " $old_image"; ?>" alt="Imagem" style="width:100px; height:100px;">
        </span>
        <div>
            <button type="submit" class="btn btn-primary" name="SendEditUserImage" value="Salvar">Salvar</button>
        </div>
    </form>
</div>