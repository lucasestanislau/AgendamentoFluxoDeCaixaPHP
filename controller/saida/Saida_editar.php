<?php
session_start();
require_once('../../db/connection.php');

if(isset($_POST['btn_editar_saida'])){
    $descricao = $_POST['descricao_saida'];
    $valor = $_POST['valor_saida'];
    $id = $_POST['id_saida'];

    $sql = "UPDATE saida SET descricao='$descricao', valor='$valor' WHERE id='$id'";

    $result = $mysqli->query($sql);

    if($mysqli->affected_rows > 0){
        $_SESSION['msg_editar_saida'] = "<p style='color: green'> Saída editada com sucesso </p>";
        header("Location: ../../view/registrar_saida.php");
    }else{
        $_SESSION['msg_editar_saida'] = "<p style='color: red'> Erro ao editar Saída </p>";
        header("Location: ../../view/registrar_saida.php");
    }

}