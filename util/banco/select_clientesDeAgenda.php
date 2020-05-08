<?php 

require_once('../../db/connection.php');

function selectClienteNome($id){
    $sql = "SELECT nome FROM cliente WHERE id =".$id;
    
    
}