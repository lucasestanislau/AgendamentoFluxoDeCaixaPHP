<?php function converterDataDeBancoParaNormal($data){
    $data = explode(" ", $data);

    list($date, $hora) = $data;

    $data_sem_barra = array_reverse(explode("-", $date));
    $data_sem_barra = implode("/", $data_sem_barra);
    $data_sem_barra = $data_sem_barra . " " . $hora;
    return $data_sem_barra;
}


function getMesNumber($mes){
    switch($mes){
        case "01":
            return "janeiro";
        break;
        case "02":
            return "fevereiro";
        break;
        case "03":
            return "marco";
        break;
        case "04":
            return "abril";
        break;
    }
}