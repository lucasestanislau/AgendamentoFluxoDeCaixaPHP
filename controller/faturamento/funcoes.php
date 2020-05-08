<?php


function getAllentrada(){
    require_once('../../db/connection.php');
    $sql = "SELECT * FROM entrada";
    $result = $mysqli->query($sql);
    $rows = $result->fetch_assoc();

    $totalEntrada;

    foreach($rows as $value){
        $totalEntrada = $totalEntrada + $value['valor'];
    }
    return $totalEntrada;
}