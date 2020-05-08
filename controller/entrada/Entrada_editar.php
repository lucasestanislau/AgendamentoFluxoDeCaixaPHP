<?php

session_start();
require_once('../../db/connection.php');

if(isset($_POST['btn_editar_entrada'])){
    $descricao = $_POST['descricao_entrada'];
    $valor = $_POST['valor_entrada'];
    $id = $_POST['id_entrada'];

    $sql = "UPDATE entrada SET descricao='$descricao', valor='$valor' WHERE id='$id'";

    $result = $mysqli->query($sql);

    if($mysqli->affected_rows > 0){
        $_SESSION['msg_editar_entrada'] = "<p style='color: green'> Entrada editada com sucesso </p>";
        header("Location: ../../view/registrar_entrada.php");
    }else{
        $_SESSION['msg_editar_entrada'] = "<p style='color: red'> Erro ao editar Entrada </p>";
        header("Location: ../../view/registrar_entrada.php");
    }

}