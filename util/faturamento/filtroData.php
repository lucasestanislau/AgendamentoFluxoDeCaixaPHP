<?php

session_start();

if (isset($_GET['filtrar_data_faturamento'])) {
    $dia = $_GET['filtro_faturamento_dia'];
    $mes = $_GET['filtro_faturamento_mes'];
    $ano = $_GET['filtro_faturamento_ano'];

    $_SESSION['filtro_faturamento_ativo_dia'] = $dia;
    $_SESSION['filtro_faturamento_ativo_mes'] = $mes;
    $_SESSION['filtro_faturamento_ativo_ano'] = $ano;

    $_SESSION['filtro_faturamento_ativo'] = true;

    header("Location: ../../view/faturamento.php");
}
