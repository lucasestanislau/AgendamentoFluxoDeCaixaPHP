<?php 
session_start();

require_once('../../db/connection.php');

if(isset($_POST['btn_editar_cliente'])){
    $id_cliente = $_POST['id_cliente'];
    $telefone_cliente = $_POST['telefone_cliente'];
    $nome_cliente = $_POST['nome_cliente'];

    $sql = "UPDATE cliente SET nome_cliente='$nome_cliente', telefone='$telefone_cliente' WHERE id_cliente='$id_cliente'";
    $result = $mysqli->query($sql);

    if($mysqli->affected_rows > 0){
        $_SESSION['msg_editar_cliente'] = "<p style='color: green'> Cliente editado com sucesso </p>";
        header("Location: ../../view/cadastrar_cliente.php");
    }else{
        $_SESSION['msg_editar_cliente'] = "<p style='color: red'> ERRO ao cadastrar cliente OU Edição não realizada </p>";
        header("Location: ../../view/cadastrar_cliente.php");
    }
}
