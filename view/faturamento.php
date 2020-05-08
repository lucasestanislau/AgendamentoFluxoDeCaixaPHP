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
                        <h1 class="h3 mb-0 text-gray-800">Faturamento Diário</h1>

                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <?php require_once('../db/connection.php');
                        //recupera valor total de entradas
                        $sqlEntrada = "SELECT * FROM entrada WHERE DAY(data) = DAY(CURDATE()) AND MONTH(data) = MONTH(CURDATE()) AND YEAR(data) = YEAR(CURDATE())";
                        $resultEntrada = $mysqli->query($sqlEntrada);
                        $rowsEntrada = $resultEntrada->fetch_all();

                        $totalEntrada = 0;

                        foreach ($rowsEntrada as $value) {
                            $totalEntrada += +$value[2];
                        } //fim total entradas
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Entradas </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?= $totalEntrada ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        //recupera valor total de entradas
                        $sqlSaida = "SELECT * FROM saida WHERE DAY(data) = DAY(CURDATE()) AND MONTH(data) = MONTH(CURDATE()) AND YEAR(data) = YEAR(CURDATE())";
                        $resultSaida = $mysqli->query($sqlSaida);
                        $rowsSaida = $resultSaida->fetch_all();

                        $totalSaida = 0;

                        foreach ($rowsSaida as $value) {
                            $totalSaida += +$value[2];
                        } //fim total entradas
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Saídas </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ - <?= $totalSaida ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Saldo </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?= ($totalEntrada - $totalSaida) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Faturamento Acumulado</h1>

                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <?php require_once('../db/connection.php');
                        //recupera valor total de entradas
                        $sqlEntrada = "SELECT * FROM entrada";
                        $resultEntrada = $mysqli->query($sqlEntrada);
                        $rowsEntrada = $resultEntrada->fetch_all();

                        $totalEntrada = 0;

                        foreach ($rowsEntrada as $value) {
                            $totalEntrada += +$value[2];
                        } //fim total entradas
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Entradas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?= $totalEntrada ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        //recupera valor total de entradas
                        $sqlSaida = "SELECT * FROM saida";
                        $resultSaida = $mysqli->query($sqlSaida);
                        $rowsSaida = $resultSaida->fetch_all();

                        $totalSaida = 0;

                        foreach ($rowsSaida as $value) {
                            $totalSaida += +$value[2];
                        } //fim total entradas
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Saídas </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ - <?= $totalSaida ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Saldo </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?= ($totalEntrada - $totalSaida) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container my-5 z-depth-1">


                        <!--Section: Content-->
                        <section class="dark-grey-text">
                            <form method="GET" action="../util/faturamento/filtroData.php">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="inputCity">Dia</label>
                                        <input type="number" class="form-control" name="filtro_faturamento_dia" required min="0">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputState">Mês</label>
                                        <input type="number" class="form-control" name="filtro_faturamento_mes" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputZip">Ano</label>
                                        <input type="number" class="form-control" name="filtro_faturamento_ano" required>
                                    </div>
                                    <button type="submit" name="filtrar_data_faturamento" class="btn btn-info">Pesquisar</button>
                                </div>

                            </form>
                            <br>

                            <div class="row">
                                <?php
                                if (isset($_SESSION['filtro_faturamento_ativo'])) {
                                    if (isset($_SESSION['filtro_faturamento_ativo_dia']) && isset($_SESSION['filtro_faturamento_ativo_mes']) && isset($_SESSION['filtro_faturamento_ativo_ano'])) {
                                        $dia = $_SESSION['filtro_faturamento_ativo_dia'];
                                        $mes = $_SESSION['filtro_faturamento_ativo_mes'];
                                        $ano = $_SESSION['filtro_faturamento_ativo_ano'];
                                    } else {
                                        $dia = 0;
                                        $mes = 0;
                                        $ano = 0;
                                    }
                                ?>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <?php
                                                echo $dia . '/';
                                                echo $mes . '/';
                                                echo $ano
                                                ?></li>
                                        </ol>
                                    </nav>


                                    <?php
                                    require_once('../db/connection.php');
                                    //recupera valor total de entradas
                                    $sqlEntradaFiltro = "SELECT * FROM entrada WHERE DAY(data) = '$dia' AND MONTH(data) = '$mes' AND YEAR(data) = '$ano'";
                                    $resultEntradaFiltro = $mysqli->query($sqlEntradaFiltro);
                                    $rowsEntradaFiltro = $resultEntradaFiltro->fetch_all();

                                    $totalEntradaFiltro = 0;

                                    foreach ($rowsEntradaFiltro as $value) {
                                        $totalEntradaFiltro += +$value[2];
                                    } //fim total entradas
                                    ?>
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Entradas </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?= $totalEntradaFiltro ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    //recupera valor total de entradas
                                    $sqlSaidaFiltro = "SELECT * FROM saida WHERE DAY(data) = '$dia' AND MONTH(data) = '$mes' AND YEAR(data) = '$ano'";
                                    $resultSaidaFiltro = $mysqli->query($sqlSaidaFiltro);
                                    $rowsSaidaFiltro = $resultSaidaFiltro->fetch_all();

                                    $totalSaidaFiltro = 0;

                                    foreach ($rowsSaidaFiltro as $value) {
                                        $totalSaidaFiltro += +$value[2];
                                    } //fim total entradas
                                    ?>
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-danger shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Saídas </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">R$ - <?= $totalSaidaFiltro ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Saldo </div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?= ($totalEntradaFiltro - $totalSaidaFiltro) ?></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        <?php
                                    unset($_SESSION['filtro_faturamento_ativo_dia']);
                                    unset($_SESSION['filtro_faturamento_ativo_mes']);
                                    unset($_SESSION['filtro_faturamento_ativo_ano']);
                                }
                        ?>
                        </section>
                        <!--Section: Content-->


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