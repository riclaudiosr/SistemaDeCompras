<?php

if(!defined('RSR1937NA')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
echo "<a href='" . URLADM . "add-conf-emails/index'>Cadastrar E-mails ADM</a><br>";
echo "<h2>Listar E-mail</h2>";



if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

foreach ($this->data['listConfEmails'] as $confEmail) {
    //var_dump($user);
    extract($confEmail);
    //echo "ID: " . $user['id'] . "<br>";
    echo "ID: $id <br>";
    echo "Titulo: $title <br>";
    echo "Nome: $name <br>";
    echo "E-mail: $email <br>";
    echo "<a href='" . URLADM . "view-conf-emails/index/$id'>Visualizar</a><br>";
    echo "<a href='" . URLADM . "edit-conf-emails/index/$id'>Editar</a><br>";
    echo "<a href='" . URLADM . "delete-conf-emails/index/$id'onclick='return confirm(\"Deseja Exculir Este Registro\")'>Apagar</a><br>";
    echo "<hr>";
}

echo $this->data['pagination'];