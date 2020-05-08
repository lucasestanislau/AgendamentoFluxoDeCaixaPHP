<?php
// Get a connection for the database
require_once('../../db/connection.php');

session_start();

/* Salvar funcionario no banco de dados */
if (isset($_POST['salvar_funcionario'])) {
    $nome = $_POST['nome_funcionario'];
    $telefone = $_POST['telefone_funcionario'];
    $email = $_POST['email_funcionario'];
    $endereco = $_POST['endereco_funcionario'];
    $documento = $_POST['documento_funcionario'];

    $result = $mysqli->query("INSERT INTO funcionario (nome, telefone, email, atendimentos, endereco, documento, status) VALUES('$nome','$telefone','$email', 0, '$endereco', '$documento', 1)") or
        die($mysqli->error);

    if ($mysqli->insert_id) {
        $_SESSION['msg_funcionario_cadastrado'] = "<p style='color: green'> funcionario Cadastrado com sucesso </p>";
        header('Location: ../../view/cadastrar_funcionario.php');
    } else {
        $_SESSION['msg_funcionario_cadastrado'] = "<p style='color: red'> ERRO ao cadastrar funcionario </p>";
        header('Location: ../../view/cadastrar_funcionario.php');
    }
}
/*end salvar funcionario */

/*Excluir funcionario GET */

if (isset($_GET['id_excluir_funcionario'])) {
    $id_funcionario = $_GET['id_excluir_funcionario'];
    $mysqli->query("DELETE FROM funcionario WHERE id_funcionario=$id_funcionario");

    header("Location: ../../view/cadastrar_funcionario.php");
}
header("Location: ../../view/cadastrar_funcionario.php");


/* End Excluir funcionario */
