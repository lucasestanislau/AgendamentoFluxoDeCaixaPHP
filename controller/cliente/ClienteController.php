<?php
session_start();
// Get a connection for the database
require_once('../../db/connection.php');


//cadstrar cliente
if (isset($_POST['salvar_cliente'])) {

    $nome = $_POST['nome_cliente'];
    $telefone = $_POST['telefone_cliente'];

    $sql = "INSERT INTO cliente (nome_cliente, telefone) VALUES('$nome','$telefone')";

    $reult = $mysqli->query($sql);

    if ($mysqli->insert_id) {
        $_SESSION['msg_cliente_cadastrado'] = "<p style='color: green'> Cliente Cadastrado com sucesso </p>";
        header('Location: ../../view/cadastrar_cliente.php');
    } else {
        $_SESSION['msg_cliente_cadastrado'] = "<p style='color: red'> ERRO ao cadastrar Cliente </p>";
        header('Location: ../../view/cadastrar_cliente.php');
    }
    //
}//end cadastrar cliente
