<?php
require_once('../../db/connection.php');
if(isset($_GET['id_excluir_agendamento'])){


    $id_agenda = $_GET['id_excluir_agendamento'];
    $sql = "DELETE FROM agenda WHERE id_agenda=".$id_agenda;

    $result = $mysqli->query($sql);

    if($result){
        if(isset($_GET['arquivo'])){
            header("Location: ../../view/".$_GET['arquivo']);
        }
    }else{
        echo 'Erro ao excluir agenda';
    }

}