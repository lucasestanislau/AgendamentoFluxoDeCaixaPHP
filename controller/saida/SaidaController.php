<?php 
session_start();
require_once('../../db/connection.php');

//salvar saida
if(isset($_POST['registrar_saida'])){
    $descricao = $_POST['desc_saida'];
    $valor = $_POST['valor_saida'];

    $sql = "INSERT INTO saida (descricao, valor, data) VALUES('$descricao', '$valor', NOW())";


    $result = $mysqli->query($sql);


    if($mysqli->insert_id){
        $_SESSION['msg_salvar_saida'] = "<p style='color:green'> Saída registrada com sucesso! </p>";
        header("Location: ../../view/registrar_Saida.php");
    }else{
        $_SESSION['msg_salvar_saida'] = "<p style='color:red'> Erro ao registrar saída </p>";
        header("Location: ../../view/registrar_Saida.php");
    }
}//end salvar saida