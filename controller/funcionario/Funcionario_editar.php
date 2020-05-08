<?php
session_start();
require_once('../../db/connection.php');

if (isset($_POST['btn_editar_funcionario'])) {
    $id = $_POST['id_funcionario'];
    $telefone = $_POST['telefone_funcionario'];
    $email = $_POST['email_funcionario'];
    $endereco = $_POST['endereco_funcionario'];
    $nome = $_POST['nome_funcionario'];
    $documento = $_POST['documento_funcionario'];
    $comissao = $_POST['comissao_funcionario'] / 100;



    $sql = "UPDATE funcionario SET nome='$nome', email='$email', telefone='$telefone', endereco='$endereco', documento='$documento', porcentagem_comissao='$comissao' WHERE id_funcionario='$id'";

    $result = $mysqli->query($sql);

    if ($mysqli->affected_rows > 0) {
        $_SESSION['msg_editar_funcionario'] = "<p style='color: green'> funcionario editado com sucesso </p>";
        header("Location: ../../view/cadastrar_funcionario.php");
    } else {
        $_SESSION['msg_editar_funcionario'] = "<p style='color: red'> ERRO ao cadastrar funcionario OU Edição não realizada </p>";
        header("Location: ../../view/cadastrar_funcionario.php");
    }
}
