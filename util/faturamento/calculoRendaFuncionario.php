<?php
function getRendaDiariaFuncionario($id, $comissao)
{
    $mysqli = new mysqli('localhost', 'root', '', 'barbearia');

    $sqlEntradasFuncionario = "SELECT * FROM entrada WHERE
     DAY(data) = DAY(CURDATE()) AND MONTH(data) = MONTH(CURDATE()) AND YEAR(data) = YEAR(CURDATE()) AND status=1 AND funcionario_id_funcionario=" . $id;

    $r = $mysqli->query($sqlEntradasFuncionario);

    $resultEntradasFunc = $r->fetch_all();

    $valorTotal = 0;

    foreach ($resultEntradasFunc as $entradas) {
        $valorTotal += $entradas[2] * $comissao;
    }

    return $valorTotal;
}

function getRendaAcumuladaFuncionario($id, $comissao)
{
    $mysqli = new mysqli('localhost', 'root', '', 'barbearia');

    $sqlEntradasFuncionario = "SELECT * FROM entrada WHERE status=1 AND funcionario_id_funcionario=" . $id;

    $r = $mysqli->query($sqlEntradasFuncionario);

    $resultEntradasFunc = $r->fetch_all();

    $valorTotal = 0;

    foreach ($resultEntradasFunc as $entradas) {
        $valorTotal += $entradas[2] * $comissao;
    }

    return $valorTotal;
}

function getAtendimentosDiarioFuncionario($id)
{
    $mysqli = new mysqli('localhost', 'root', '', 'barbearia');

    $sqlEntradasFuncionario = "SELECT * FROM entrada WHERE DAY(data) = DAY(CURDATE()) AND MONTH(data) = MONTH(CURDATE()) AND YEAR(data) = YEAR(CURDATE()) AND funcionario_id_funcionario=" . $id;

    $r = $mysqli->query($sqlEntradasFuncionario);

    $numeroDeRegistros = $r->num_rows;

    return $numeroDeRegistros;
}

function getAtendimentosAcumuladoFuncionario($id)
{
    $mysqli = new mysqli('localhost', 'root', '', 'barbearia');

    $sqlEntradasFuncionario = "SELECT * FROM entrada WHERE funcionario_id_funcionario=" . $id;

    $r = $mysqli->query($sqlEntradasFuncionario);

    $numeroDeRegistros = $r->num_rows;

    return $numeroDeRegistros;
}