<?php 

    //esse arquivo define o funcionário que atendeu determinado agendamento
    require_once('../../db/connection.php');

    if(isset($_POST['btn-define-func'])){
        $id_agenda = $_POST['id_agenda_functatend'];
        //$id_funcionario = $_POST['id_funcionario_cadastrado'];

        $status = "2";//status atendido

        $sql = "UPDATE agenda SET status_agendamento='$status' WHERE id_agenda='$id_agenda'";
        $result = $mysqli->query($sql);

        //esse cógioo era executado quando eu elecionava o funcionario que atendeu determinada agenda
       // $sqlContAtendimento = "UPDATE funcionario SET atendimentos = atendimentos +1 WHERE id_funcionario=".$id_funcionario;
       // $mysqli->query($sqlContAtendimento);

        header("Location: ../../view/index.php");

    }

?>