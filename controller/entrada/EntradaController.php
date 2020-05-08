<?php
session_start();
require_once('../../db/connection.php');

//cadastrar uma entrada
if (isset($_POST['registrar_entrada'])) {
    $descricao = $_POST['desc_entrada'];
    $valor = $_POST['valor_entrada'];
    $funcionarioAtendeu = 0;

    if (!empty($_POST['funcionario_cadastrado'])) {
        $funcionarioVilculado = $_POST['funcionario_cadastrado'];
        $funcionarioAtendeu = $funcionarioVilculado;
        //1 - não pago
        //2 - pago
        $status = 1;

        $sql = "INSERT INTO entrada (descricao, valor, data, funcionario_id_funcionario, status) VALUES('$descricao', '$valor', NOW(), '$funcionarioVilculado', '$status')";
    } else {
        $sql = "INSERT INTO entrada (descricao, valor, data) VALUES('$descricao', '$valor', NOW())";
    }

    $result = $mysqli->query($sql);

    if ($funcionarioAtendeu != 0) {
        //esse cógioo era executado quando eu elecionava o funcionario que atendeu determinada agenda
         $sqlContAtendimento = "UPDATE funcionario SET atendimentos = atendimentos +1 WHERE id_funcionario=".$funcionarioAtendeu;
         $mysqli->query($sqlContAtendimento);
    }

    if ($mysqli->affected_rows) {
        $_SESSION['msg_registrar_entrada'] = "<p style='color: green'> Entrada registrada com sucesso </p>";
        header("Location: ../../view/registrar_entrada.php");
    } else {
        $_SESSION['msg_registrar_entrada'] = "<p style='color: red'> ERRO ao Registrar </p>";
        header("Location: ../../view/registrar_entrada.php");
    }

    if ($result) {
        header("Location: ../../view/registrar_entrada.php");
    }
}//end cadastro entrada
