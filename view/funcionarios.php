<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include_once('components/head.php') ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul w3-include-html="menu-lateral.php" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <?php include_once('components/menu-lateral.php') ?>
        </ul>
        <!-- end SIDEBAR-->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav w3-include-html="topbar.php" class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <?php include_once('components/topbar.php') ?>
                </nav>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Renda funcionário</h1>
                        <?php if (isset($_SESSION['msg_pagamento_diario'])) {
                            echo $_SESSION['msg_pagamento_diario'];
                            unset($_SESSION['msg_pagamento_diario']);
                        }

                        if (isset($_SESSION['msg_pagamento_acumulado'])) {
                            echo $_SESSION['msg_pagamento_acumulado'];
                            unset($_SESSION['msg_pagamento_acumulado']);
                        }
                        ?>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <?php


                        require_once('../db/connection.php');
                        require_once('../util/faturamento/calculoRendaFuncionario.php');

                        $sqlFuncionarios = "SELECT * FROM funcionario";
                        $r = $mysqli->query($sqlFuncionarios);
                        $resultFuncionarios = $r->fetch_all();


                        foreach ($resultFuncionarios as $value) :
                        ?>

                            <div class="card" style="width:400px">
                                <img class="card-img-top" src="../img/img_avatar1.png" alt="Card image" style="width:100%">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $value[1] ?></h4>
                                    <p class="card-text">Documento: <?= $value[6] ?><br>
                                        Renda Diária atual: R$ <?php echo getRendaDiariaFuncionario(/*id*/$value[0],/*comissao*/ $value[8]) ?><br>
                                        Renda Acumulada atual: R$ <?php echo getRendaAcumuladaFuncionario($value[0], $value[8])  ?> <br>
                                        <hr>
                                        Número de atendimentos Hoje: <?php echo getAtendimentosDiarioFuncionario($value[0]) ?><br>
                                        Número de atendimentos Mensal: <?php echo getAtendimentosAcumuladoFuncionario($value[0]) ?><br>
                                        <hr>
                                        Porcentagem da Comissão: <?= ($value[8] * 100) ?> %

                                    </p>
                                    <div class="card-body">
                                        <a onclick="return confirm('deseja mesmo pagar a Diária do Funcionário <?= $value[1] ?> ?');
                                    " href="../controller/funcionario/pagamentoDiarioFuncionario.php?id_func_pagar_diaria=<?= $value[0] ?>&comissao_pag_diaria=<?= $value[8] ?>" class="card-link">Pagar Diária</a>
                                        <a onclick="return confirm('deseja mesmo pagar a Acumulada do funcionário <?= $value[1] ?> ?');" href="../controller/funcionario/pagamentoAcumuladoFuncionario.php?id_func_pagar_acumulado=<?= $value[0] ?>&valor_pag_acumulado=<?= getRendaAcumuladaFuncionario($value[0], $value[8]) ?>" class="card-link">Pagar Acumulada</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <!-- /.container-fluid -->


            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <?php include_once('components/footer.php') ?>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>


    <!-- Ver nos arquivos para poder modificar os valores
        
    Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>

</html>