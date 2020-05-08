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
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- End of Topbar -->
                    <!-- inicio do formulário de cadastro do funcionario-->
                    <form action="../controller/cliente/ClienteController.php" method="POST" class="user">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="nome_cliente">Nome do Cliente: </label>
                                <input required name="nome_cliente" type="text" class="form-control form-control-user" id="nome_cliente" placeholder="Nome do Cliente">
                            </div>
                            <div class="col-sm-6">
                                <label for="telefone_cliente">Telefone do Cliente: </label>
                                <input required name="telefone_cliente" type="text" class="form-control form-control-user" id="telefone_cliente" placeholder="Telefone do Cliente">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" name="salvar_cliente">Cadastrar</button>
                    </form>
                    </br>
                    <?php
                    if (isset($_SESSION['msg_cliente_cadastrado'])) {
                        echo $_SESSION['msg_cliente_cadastrado'];
                        unset($_SESSION['msg_cliente_cadastrado']);
                    }
                    if(isset($_SESSION['msg_editar_cliente'])){
                        echo $_SESSION['msg_editar_cliente'];
                        unset($_SESSION['msg_editar_cliente']);
                    }
                    ?>

                    </br>
                    <?php //select para os barbeiros
                    require_once('../db/connection.php');
                    $result = $mysqli->query("SELECT * FROM cliente ORDER BY nome_cliente") or die($mysqli->error);

                    //print_r($result);
                    // echo '<pre>';
                    // print_r($result->fetch_all());
                    // echo '</pre>';

                    $agenda = $result->fetch_all();


                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de Horários</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome Cliente</th>
                                            <th>telefone</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome Cliente</th>
                                            <th>telefone</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($agenda as $value) : ?>
                                            <tr>
                                                <td><?= $value[1] ?></td>
                                                <td><?= $value[2] ?></td>
                                                <td><a onclick="return confirm('Deseja realmente excluir?');" href="../controller/cliente/excluir_cliente.php?id_excluir_cliente=<?= $value[0] ?>" class="btn btn-danger btn-circle">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal" data-whatever="<?= $value[1] ?>" data-whatever2="<?= $value[2] ?>" data-whatever3="<?= $value[0] ?>">Editar</button>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="../controller/cliente/Cliente_editar.php">
                                        <input type="hidden" class="form-control" id="id_cliente" name="id_cliente">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Nome Clitente:</label>
                                            <input required type="text" class="form-control" name="nome_cliente" id="nome_cliente" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Telefone Clitente:</label>
                                            <input required type="text" class="form-control" name="telefone_cliente" id="telefone_cliente" value="">
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="btn_editar_cliente" class="btn btn-primary">Salvar Edição</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fim do datatables example -->
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
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var recipient2 = button.data('whatever2')
            var recipient3 = button.data('whatever3')
            var modal = $(this)
            modal.find('.modal-title').text('Editar Cliente')
            modal.find('.modal-body #nome_cliente').val(recipient)
            modal.find('.modal-body #telefone_cliente').val(recipient2)
            modal.find('.modal-body #id_cliente').val(recipient3)
        })
    </script>
</body>

</html>