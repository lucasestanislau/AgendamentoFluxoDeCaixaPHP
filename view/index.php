<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include_once('components/head.php') ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <?php include_once('components/menu-lateral.php') ?>
        </ul>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <?php include_once('components/topbar.php') ?>
                </nav>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Listagem de Dados</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">

                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Agendamentos de hoje</h6>
                                </div>
                                <div class="card-body">
                                    <?php

                                    //Conexão com banco de dados
                                    include_once("../db/conexao.php");
                                    ?>
                                    <div class="panel panel-danger text-center">
                                        <nav class="navbar navbar-default">
                                            <h3 class="text-center text-danger">Agendamentos para hoje</h3>
                                        </nav>
                                        <?php
                                        require_once('../util/conversoes/status.php');
                                        $result_horarios = "SELECT * FROM agenda WHERE DAY(data_hora) = DAY(CURDATE()) AND MONTH(data_hora) = MONTH(CURDATE()) AND YEAR(data_hora) = YEAR(CURDATE()) AND status_agendamento=1 ORDER BY data_hora";
                                        $resultado_horarios = mysqli_query($conn, $result_horarios);
                                        while ($row_horarios = mysqli_fetch_array($resultado_horarios)) {
                                            echo "<div class='text-center'>";
                                            echo "<strong>Nome Cliente:</strong> " . $row_horarios['nome_cliente'] . "<br>";
                                            echo "<strong>Telefone Cliente</strong> " . $row_horarios['telefone'] . "<br>";
                                            echo "<strong>Data e Horário:</strong> " . date('d/m/Y H:i:s', strtotime($row_horarios['data_hora'])) . "<br>";
                                            echo "<strong>Status: </strong> " . verificaStatusAgendamento($row_horarios['status_agendamento']) . "<br>";
                                        ?><a onclick="return confirm('Deseja realmente excluir?');" href="../controller/agenda/excluirAgendamento.php?arquivo=index.php&id_excluir_agendamento=<?= $row_horarios['id_agenda'] ?>" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="#" class="btn btn-success btn-circle" data-toggle="modal" data-target="#exampleModal" data-whatever="<?= $row_horarios['id_agenda'] ?>">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        <?php
                                            echo "</div>";
                                            echo "<br>";
                                        } //fim do while $row_horarios
                                        ?>
                                    </div>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php require_once('../db/connection.php');
                                                    $sqlFuncionarioAtende = "SELECT id_funcionario, nome, telefone FROM funcionario";
                                                    $resulFuncAtend = $mysqli->query($sqlFuncionarioAtende);
                                                    $resultFuncAtend = $resulFuncAtend->fetch_all();
                                                    ?>
                                                    <form method="POST" action="../controller/agenda/editarAgendamento.php">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Confirmar Atendimento</label>
                                                            <input type="hidden" class="form-control" id="recipient-name" name="id_agenda_functatend">
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="btn-define-func" class="btn btn-primary">Confirmar</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 overflow-auto">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Agendamento deste mês</h6>
                                </div>
                                <div class="card-body">
                                    <div class="panel panel-success text-center">
                                        <nav class="navbar navbar-default">
                                            <h3 class="text-center text-success">Agendamentos deste mês</h3>
                                        </nav>
                                        <?php
                                        $result_horarios = "SELECT * FROM agenda WHERE MONTH(data_hora) = MONTH(CURDATE()) AND YEAR(data_hora) = YEAR(CURDATE()) ORDER BY data_hora";
                                        $resultado_horarios = mysqli_query($conn, $result_horarios);
                                        while ($row_horarios = mysqli_fetch_array($resultado_horarios)) {
                                            echo "<strong>Nome:</strong> " . $row_horarios['nome_cliente'] . "<br>";
                                            echo "<strong>Telefone</strong> " . $row_horarios['telefone'] . "<br>";
                                            echo "<strong>Data e Horário:</strong> " . date('d/m/Y H:i:s', strtotime($row_horarios['data_hora'])) . "<br>";
                                            echo "<strong>Status:</strong> " . verificaStatusAgendamento($row_horarios['status_agendamento']) . "<br>";
                                        ?><a onclick="return confirm('Deseja realmente excluir?');" href="../controller/agenda/excluirAgendamento.php?arquivo=index.php&id_excluir_agendamento=<?= $row_horarios['id_agenda'] ?>" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </a><?php
                                                echo "<hr>";
                                            }
                                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
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
    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Funcionário que atendeu')
            modal.find('.modal-body input').val(recipient)
        })
    </script>
</body>

</html>