<?php

require_once('../../db/connection.php');

if (isset($_GET['id_excluir_cliente'])) {
    $id = $_GET['id_excluir_cliente'];
    $sql = "DELETE FROM cliente WHERE id_cliente=" . $id;

    $result = $mysqli->query($sql);

    print_r($result);
    if ($result) {
        header("Location: ../../view/cadastrar_cliente.php");
    }
}
//se não excluir é que ele tem um relacionamento pendente no banco de dados
//header("Location: ../../index.php");
