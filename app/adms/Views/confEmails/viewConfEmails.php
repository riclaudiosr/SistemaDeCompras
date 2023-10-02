<?php

if(!defined('RSR1937NA')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

echo "<h2>Detalhes do E-mail</h2>";

echo "<a href='" . URLADM . "list-conf-emails/index'>Listar</a><br>";
if (!empty($this->data['viewConfEmails'])) {
    echo "<a href='" . URLADM . "edit-conf-emails/index/" . $this->data['viewConfEmails'][0]['id'] . "'>Editar</a><br>";
    echo "<a href='" . URLADM . "edit-conf-emails-password/index/" . $this->data['viewConfEmails'][0]['id'] . "'>Editar Senha</a><br>";
    echo "<a href='" . URLADM . "delete-conf-emails/index/" . $this->data['viewConfEmails'][0]['id'] . "'
    onclick='return confirm(\"Deseja Exculir Este Registro\")'>Apagar</a><br><br>";
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

if (!empty($this->data['viewConfEmails'])) {
    //var_dump($this->data['viewUser'][0]);
    extract($this->data['viewConfEmails'][0]);

    echo "ID: $id <br>";
    echo "Titulo: $title <br>";
    echo "Nome: $name <br>";
    echo "E-mail: $email <br>";
    echo "Host: $host <br>";
    echo "Usuário: $username<br>";
    echo "SMTP: $smtpsecure<br>";
    echo "Porta: $port<br>";
    echo "Cadastrado: " . date('d/m/Y H:i:s', strtotime($created)) . " <br>";
    echo "Editado: ";
    if (!empty($modified)) {
        echo date('d/m/Y H:i:s', strtotime($modified));
    }
    echo "<br>";
}
