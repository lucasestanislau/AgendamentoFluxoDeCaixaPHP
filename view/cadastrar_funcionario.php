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
                    <form action="../controller/funcionario/funcionarioController.php" method="POST" class="user">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="nome_funcionario">Nome do funcionario: </label>
                                <input required name="nome_funcionario" type="text" class="form-control form-control-user" id="nome_funcionario" placeholder="Nome do funcionario">
                            </div>
                            <div class="col-sm-6">
                                <label for="telefone_funcionario">Telefone do funcionario: </label>
                                <input required name="telefone_funcionario" type="text" class="form-control form-control-user" id="telefone_funcionario" placeholder="Telefone do Baibeiro">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email_funcionario">Email do funcionario: </label>
                            <input name="email_funcionario" type="email" class="form-control form-control-user" id="email_funcionario" placeholder="Email do funcionario">
                        </div>
                        <div class="form-group">
                            <label for="endereco_funcionario">Endereço do funcionario: </label>
                            <input required name="endereco_funcionario" type="text" class="form-control form-control-user" id="endereco_funcionario" placeholder="Endereço do funcionario">
                        </div>
                        <div class="form-group">
                            <label for="documento_funcionario">Documento de identificação do funcionario: </label>
                            <input required name="documento_funcionario" type="text" class="form-control form-control-user" id="documento_funcionario" placeholder="Documento de identificação do funcionario">
                        </div>
                        <button type="submit" class="btn btn-success" name="salvar_funcionario">Cadastrar</button>
                    </form>
                    </br>
                    <?php
                    if (isset($_SESSION['msg_funcionario_cadastrado'])) {
                        echo $_SESSION['msg_funcionario_cadastrado'];
                        unset($_SESSION['msg_funcionario_cadastrado']);
                    }
                    if (isset($_SESSION['msg_editar_funcionario'])) {
                        echo $_SESSION['msg_editar_funcionario'];
                        unset($_SESSION['msg_editar_funcionario']);
                    }
                    ?>
                    </br>


                    <!-- inicio da listagem de funcionarios -->

                    <?php //select para os funcionarios
                    require_once('../db/connection.php');
                    require_once('../util/conversoes/status_funcionario.php');
                    $result = $mysqli->query("SELECT * FROM funcionario") or die($mysqli->error);

                    $funcionarios = $result->fetch_all();
                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de funcionarios</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>email</th>
                                            <th>telefone</th>
                                            <th>Endereço</th>
                                            <th>Status</th>
                                            <th>Comissão</th>
                                            <th>Atendimentos</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>email</th>
                                            <th>telefone</th>
                                            <th>Endereço</th>
                                            <th>Status</th>
                                            <th>Comissão</th>
                                            <th>atendimentos</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($funcionarios as $value) : ?>
                                            <tr>
                                                <td><?= $value[1] ?></td>
                                                <td><?= $value[2] ?></td>
                                                <td><?= $value[3] ?></td>
                                                <td><?= $value[5] ?></td>
                                                <td><?= statusFuncionario($value[7]) ?></td>
                                                <td><?=($value[8] * 100) ?> %</td>
                                                <td><?= $value[4] ?></td>
                                                <td><a onclick="return confirm('Deseja realmente excluir?');" href="../controller/funcionario/FuncionarioController.php?id_excluir_funcionario=<?= $value[0] ?>" class="btn btn-danger btn-circle">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-warning
                                                     " data-toggle="modal" data-target="#exampleModal" data-whatever1="<?= $value[0] ?>" data-whatever2="<?= $value[1] ?>" data-whatever3="<?= $value[2] ?>" data-whatever4="<?= $value[3] ?>" data-whatever5="<?= $value[5] ?>" data-whatever7="<?= $value[6] ?>" data-whatever8="<?= ($value[8] * 100) ?>">Editar</button></td>

                                                <!-- 1-id 2-nome 3-email 4-telefone 5-endereco 7-documento -->
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
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="../controller/funcionario/Funcionario_editar.php">
                                        <input type="hidden" class="form-control" id="id_funcionario" name="id_funcionario">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Nome Funcionário:</label>
                                            <input required type="text" class="form-control" name="nome_funcionario" id="nome_funcionario" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Telefone Funcionário:</label>
                                            <input required type="text" class="form-control" name="telefone_funcionario" id="telefone_funcionario" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Email Funcionário:</label>
                                            <input required type="text" class="form-control" name="email_funcionario" id="email_funcionario" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Endereco Funcionário:</label>
                                            <input required type="text" class="form-control" name="endereco_funcionario" id="endereco_funcionario" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Documento Funcionário:</label>
                                            <input required type="text" class="form-control" name="documento_funcionario" id="documento_funcionario" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="comissao_funcionario" class="col-form-label">Comissão:</label>
                                            <input required type="number" class="form-control" name="comissao_funcionario" id="comissao_funcionario" value="">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="btn_editar_funcionario" class="btn btn-primary">Salvar Edição</button>
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


    <!-- 1-id 2-nome 3-email 4-telefone 5-endereco 6-status -->
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipientId = button.data('whatever1')
            var recipientNome = button.data('whatever2')
            var recipientTelefone = button.data('whatever4')
            var recipientEndereco = button.data('whatever5')
            var recipientEmail = button.data('whatever3')
            var recipientDocumento = button.data('whatever7')
            var recipientComissao = button.data('whatever8')

            var modal = $(this)

            modal.find('.modal-title').text('Editar Funcionario')
            modal.find('.modal-body #nome_funcionario').val(recipientNome)
            modal.find('.modal-body #telefone_funcionario').val(recipientTelefone)
            modal.find('.modal-body #id_funcionario').val(recipientId)
            modal.find('.modal-body #email_funcionario').val(recipientEmail)
            modal.find('.modal-body #endereco_funcionario').val(recipientEndereco)
            modal.find('.modal-body #documento_funcionario').val(recipientDocumento)
            modal.find('.modal-body #comissao_funcionario').val(recipientComissao)
        })
    </script>
</body>

</html>