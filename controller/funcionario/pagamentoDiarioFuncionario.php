<?php
session_start();
require_once('../../db/connection.php');

//pagamento diário
if (isset($_GET['id_func_pagar_diaria']) && isset($_GET['comissao_pag_diaria'])) {

    $id = $_GET['id_func_pagar_diaria'];
    $comissaoFunc = $_GET['comissao_pag_diaria'];

    $sqlEntradasFunc = "SELECT * FROM entrada WHERE DAY(data) = DAY(CURDATE()) AND MONTH(data) = MONTH(CURDATE()) AND YEAR(data) = YEAR(CURDATE()) AND status=1 AND funcionario_id_funcionario=" . $id;

    $r = $mysqli->query($sqlEntradasFunc);


    if ($r->num_rows > 0) {
        $result = $r->fetch_all();

        $valorTotalSaida = 0;


        foreach ($result as $valor) {
            $valorTotalSaida += ($valor[2] * $comissaoFunc);
            $sql = "UPDATE entrada SET status=2 WHERE id=" . $valor[0];
            $rr = $mysqli->query($sql);
        }
        $_SESSION['msg_pagamento_diario'] = "<p style='color: green'> Pagamento realizado com sucesso! </p>";

        //gerar saída apos o pagamento
        $descSaida = "Pagamento DIÁRIO realizado a funcionário";
        $statusSaida = 1;

        $sqlSaidaGerada = "INSERT INTO saida (descricao, valor, data, funcionario_id_funcionario, status) VALUES('$descSaida', '$valorTotalSaida', NOW(), '$id', '$statusSaida')";

        $r2 = $mysqli->query($sqlSaidaGerada);

        if ($mysqli->insert_id) {

            header("Location: ../../view/funcionarios.php");
        }else{
            $mysqli->rollback();
        }
    } else {
        $_SESSION['msg_pagamento_diario'] = "<p style='color: black'> Não há pagamento diário pendente! </p>";
        header("Location: ../../view/funcionarios.php");
    }
}else{
    $_SESSION['msg_pagamento_diario'] = "<p style='color: red'> ERRo ao tentar realizar o pagamento </p>";
        header("Location: ../../view/funcionarios.php");
}

// fim pagamento diário
