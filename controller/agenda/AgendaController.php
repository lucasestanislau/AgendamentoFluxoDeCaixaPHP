<?php require_once('../../db/connection.php');


/** salvar um agendamento mysql */
if (isset($_POST['salvar_agenda'])) {
    $data = $_POST['data_agenda'];

    //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
    $data = explode(" ", $data);
    list($date, $hora) = $data;
    $data_sem_barra = array_reverse(explode("/", $date));
    $data_sem_barra = implode("-", $data_sem_barra);
    $data_sem_barra = $data_sem_barra . " " . $hora;

    //se o cliente já está cadastrado
    if (!empty($_POST['cliente_cadastrado'])) {
        $status = "1";
        //1 - não atendido / 2 - atendido / 3 - cancelado
        //Salvar no BD
        $clienteCadastrado = $_POST['cliente_cadastrado'];
        $sqlClienteNomeTelefone = "SELECT nome_cliente, telefone FROM cliente WHERE id_cliente=".$clienteCadastrado;
        $result = $mysqli->query($sqlClienteNomeTelefone);
        $cliente = $result->fetch_assoc();
        //o resultado deve possuir apenas um cliente com esse id
        //print_r($cliente);

        $insertQuery = "INSERT INTO agenda (nome_cliente, telefone, cliente_id_cliente, data_hora, status_agendamento) VALUES ('$cliente[nome_cliente]','$cliente[telefone]','$clienteCadastrado','$data_sem_barra', '$status')";
        $resultado_data = $mysqli->query($insertQuery);

        header("Location: ../../view/agendar_horario.php");
    } else {
        $nomeCliente = $_POST['nome_cliente'];
        $telefoneCliente = $_POST['telefone_cliente'];


        //se eu cliquei em editar ele executa isso
        if (!empty($_POST['id_agenda'])) {
            $idEdit = $_POST['id_agenda'];
            $queryEdit = "UPDATE agenda SET nome_cliente='$nomeCliente', telefone='$telefoneCliente', data_hora='$data_sem_barra' WHERE id_agenda='$idEdit'";
            $result = $mysqli->query($queryEdit);

            header("Location: ../../view/agendar_horario.php");
        } else {

            $status = "1";
            //Salvar no BD
            $insertQuery = "INSERT INTO agenda (nome_cliente, telefone, data_hora, status_agendamento) VALUES ('$nomeCliente', '$telefoneCliente','$data_sem_barra', '$status')";
            $resultado_data = $mysqli->query($insertQuery);

            header("Location: ../../view/agendar_horario.php");
            /* end Save agendamento */
        }
    }
}

/*excluir agendamento*/
require_once('../../db/connection.php');


if (isset($_GET['id_excluir_agendamento'])) {
    $id_agenda = $_GET['id_excluir_agendamento'];

    $mysqli->query("DELETE FROM agenda WHERE id_agenda=$id_agenda");

    header("Location: ../../view/agendar_horario.php");
}
header("Location: ../../view/agendar_horario.php");
/*end excluir agendamento*/
