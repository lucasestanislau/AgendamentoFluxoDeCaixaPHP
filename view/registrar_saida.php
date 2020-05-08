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
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Registrar Saída</h1>
                    <p class="mb-4"></a></p>

                    <!-- End of Topbar -->
                    <!-- inicio do formulário de cadastro do funcionario-->
                    <form action="../controller/saida/SaidaController.php" method="POST" class="user">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="desc_saida">Descrição da Saída: </label>
                                <input required name="desc_saida" type="text" class="form-control form-control-user" id="desc_saida" placeholder="Descrição da saída">
                            </div>
                            <div class="col-sm-6">
                                <label for="valor_saida">Valor R$: </label>
                                <input name="valor_saida" type="number" step="0.01" min="0" class="form-control form-control-user" id="valor_saida" placeholder="Valor da saída">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success" name="registrar_saida">Registrar</button>
                    </form> 
                    <br>
                    <?php

                        if(isset($_SESSION['msg_salvar_saida'])){
                            echo $_SESSION['msg_salvar_saida'];
                            unset($_SESSION['msg_salvar_saida']);
                        }
                        if(isset($_SESSION['msg_editar_saida'])){
                            echo $_SESSION['msg_editar_saida'];
                            unset($_SESSION['msg_editar_saida']);
                        }

                    ?>
                    <br>

                    <?php
                    require_once('../db/connection.php');

                    $selectSaida = "SELECT * FROM saida";
                    $result = $mysqli->query($selectSaida);
                    $rows = $result->fetch_all();
                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de Saídas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Descrição</th>
                                            <th>Data de Saída</th>
                                            <th>Valor</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Descrição</th>
                                            <th>Data de Saída</th>
                                            <th>Valor</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($rows as $value) :  ?>
                                            <tr>

                                                <td><?= $value[1] ?></td>
                                                <td><?= $value[3] ?></td>
                                                <td><?= $value[2] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning
                                                     " data-toggle="modal" data-target="#exampleModal" data-whatever1="<?= $value[0] ?>" data-whatever2="<?= $value[1] ?>" data-whatever3="<?= $value[2] ?>">Editar</button></td>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- fim do datatables example -->


                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Registro de Saída</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="../controller/saida/Saida_editar.php">
                                        <input type="hidden" class="form-control" id="id_saida" name="id_saida">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Descrição Saída:</label>
                                            <input required type="text" class="form-control" name="descricao_saida" id="descricao_saida" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Valor Saída:</label>
                                            <input required type="number" class="form-control" name="valor_saida" id="valor_saida" value="">
                                        </div>
                                        

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="btn_editar_saida" class="btn btn-primary">Salvar Edição</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipientId = button.data('whatever1')
            var recipientDesc = button.data('whatever2')
            var recipientValor = button.data('whatever3')

            var modal = $(this)

            modal.find('.modal-title').text('Editar Saida')
            modal.find('.modal-body #descricao_saida').val(recipientDesc)
            modal.find('.modal-body #valor_saida').val(recipientValor)
            modal.find('.modal-body #id_saida').val(recipientId)
        })
    </script>
</body>

</html>