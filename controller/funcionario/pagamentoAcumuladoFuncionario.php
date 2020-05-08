<?php

session_start();
require_once('../../db/connection.php');

//pagamento diário
if (isset($_GET['id_func_pagar_acumulado']) && is_numeric($_GET['valor_pag_acumulado'])) {

    $id = $_GET['id_func_pagar_acumulado'];
    $valorApagarFunc = $_GET['valor_pag_acumulado'];

    $sqlEntradasFunc = "SELECT * FROM entrada WHERE status=1 AND funcionario_id_funcionario=" . $id;

    $r = $mysqli->query($sqlEntradasFunc);


    if ($r->num_rows > 0) {
        $result = $r->fetch_all();

        foreach ($result as $valor) {
            $sql = "UPDATE entrada SET status=2 WHERE id=" . $valor[0];
            $rr = $mysqli->query($sql);
        }
        $_SESSION['msg_pagamento_acumulado'] = "<p style='color: green'> Pagamento realizado com sucesso! </p>";

        //gerar saída apos o pagamento
        $descSaida = "Pagamento ACUMULADO realizado a funcionário";
        $statusSaida = 1;

        $sqlSaidaGerada = "INSERT INTO saida (descricao, valor, data, funcionario_id_funcionario, status) VALUES('$descSaida', '$valorApagarFunc', NOW(), '$id', '$statusSaida')";

        $r2 = $mysqli->query($sqlSaidaGerada);

        if ($mysqli->insert_id) {

            header("Location: ../../view/funcionarios.php");
        }else{
            $mysqli->rollback();
        }
    } else {
        $_SESSION['msg_pagamento_acumulado'] = "<p style='color: black'> Não há pagamento Acumulado pendente! </p>";
        header("Location: ../../view/funcionarios.php");
    }
}else{
    $_SESSION['msg_pagamento_acumulado'] = "<p style='color: red'> ERRo ao tentar realizar o pagamento </p>";
        header("Location: ../../view/funcionarios.php");
}

// fim pagamento diário
