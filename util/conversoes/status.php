<?php 

function verificaStatusAgendamento($status){
    if($status =="1"){
        return "Não Atendido";
    }else if($status =="2"){
        return "Atendido";
    }
}