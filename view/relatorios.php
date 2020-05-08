<?php
session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include_once('components/head.php') ?>
</head>
<?php
require_once('../db/connection.php');
require_once('../util/datas/converterData.php');

$sqlChartEntrada = "SELECT * FROM entrada WHERE YEAR(data) = YEAR(CURDATE())";

$r = $mysqli->query($sqlChartEntrada);
$result1 = $r->fetch_all();

$mesesEntrada = [];

$mesesEntrada['01'] = 0;
$mesesEntrada['02'] = 0;
$mesesEntrada['03'] = 0;
$mesesEntrada['04'] = 0;
$mesesEntrada['05'] = 0;
$mesesEntrada['06'] = 0;
$mesesEntrada['07'] = 0;
$mesesEntrada['08'] = 0;
$mesesEntrada['09'] = 0;
$mesesEntrada['10'] = 0;
$mesesEntrada['11'] = 0;
$mesesEntrada['12'] = 0;



foreach ($result1 as $value1) {
    $m = date("m", strtotime($value1[3]));
    //$mes = getMesNumber($m);
    $mesesEntrada[$m] += $value1[2];
}

$sqlChartSaida = "SELECT * FROM saida WHERE YEAR(data) = YEAR(CURDATE())";

$r2 = $mysqli->query($sqlChartSaida);
$result2 = $r2->fetch_all();
$mesesSaida = [];

$mesesSaida['01'] = 0;
$mesesSaida['02'] = 0;
$mesesSaida['03'] = 0;
$mesesSaida['04'] = 0;
$mesesSaida['05'] = 0;
$mesesSaida['06'] = 0;
$mesesSaida['07'] = 0;
$mesesSaida['08'] = 0;
$mesesSaida['09'] = 0;
$mesesSaida['10'] = 0;
$mesesSaida['11'] = 0;
$mesesSaida['12'] = 0;

foreach ($result2 as $value1) {
    $m = date("m", strtotime($value1[3]));
    //$mes = getMesNumber($m);
    $mesesSaida[$m] += $value1[2];
}

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Mes', 'Entrada', 'Saída', 'Saldo'],
            ['Janeiro', <?php echo $mesesEntrada['01'] ?>, <?php echo $mesesSaida['01'] ?>, <?php echo $mesesEntrada['01'] - $mesesSaida['01'] ?>],
            ['Fevereiro', <?php echo $mesesEntrada['02'] ?>, <?php echo $mesesSaida['02'] ?>, <?php echo $mesesEntrada['02'] - $mesesSaida['02'] ?>],
            ['Março', <?php echo $mesesEntrada['03'] ?>, <?php echo $mesesSaida['03'] ?>, <?php echo $mesesEntrada['03'] - $mesesSaida['03'] ?>],
            ['Abril', <?php echo $mesesEntrada['04'] ?>, <?php echo $mesesSaida['04'] ?>, <?php echo $mesesEntrada['04'] - $mesesSaida['04'] ?>],
            ['Maio', <?php echo $mesesEntrada['05'] ?>, <?php echo $mesesSaida['05'] ?>, <?php echo $mesesEntrada['05'] - $mesesSaida['05'] ?>],
            ['Junho', <?php echo $mesesEntrada['06'] ?>, <?php echo $mesesSaida['06'] ?>, <?php echo $mesesEntrada['06'] - $mesesSaida['06'] ?>],
            ['Julho', <?php echo $mesesEntrada['07'] ?>, <?php echo $mesesSaida['07'] ?>, <?php echo $mesesEntrada['07'] - $mesesSaida['07'] ?>],
            ['Agosto', <?php echo $mesesEntrada['08'] ?>, <?php echo $mesesSaida['08'] ?>, <?php echo $mesesEntrada['08'] - $mesesSaida['08'] ?>],
            ['Setembro', <?php echo $mesesEntrada['09'] ?>, <?php echo $mesesSaida['09'] ?>, <?php echo $mesesEntrada['09'] - $mesesSaida['09'] ?>],
            ['Outubro', <?php echo $mesesEntrada['10'] ?>, <?php echo $mesesSaida['10'] ?>, <?php echo $mesesEntrada['10'] - $mesesSaida['10'] ?>],
            ['Novembro', <?php echo $mesesEntrada['11'] ?>, <?php echo $mesesSaida['11'] ?>, <?php echo $mesesEntrada['11'] - $mesesSaida['11'] ?>],
            ['Dezembro', <?php echo $mesesEntrada['12'] ?>, <?php echo $mesesSaida['12'] ?>, <?php echo $mesesEntrada['12'] - $mesesSaida['12'] ?>],

        ]);

        var options = {
            title: 'Relatório de faturamento do ano: <?php echo date('yy'); ?>',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
</script>

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
                    <?php
                    //echo date("m", strtotime($dataTeste[3]));//pega o mes da data, tive que converter a string para um time
                    ?>
                    <div class="row">
                        <div id="curve_chart" style="width: 1700px; height: 500px"></div>
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

    <script src="../js/demo/chart-area-demo.js">
    </script>

    <script src="../js/demo/chart-pie-demo.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</body>

</html>