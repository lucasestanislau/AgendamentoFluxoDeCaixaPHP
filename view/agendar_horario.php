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
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <?php
          require_once('../db/connection.php');
          require_once('../util/datas/converterData.php');

          //selecionar os barbeiros para o atendimento
          //$resultadoAgenda = $mysqli->query("SELECT * FROM funcionario") or die($mysqli->error);
          //$funcionariosAgenda = $resultadoAgenda->fetch_all();

          //selecionar clientes que já estão cadastrados no sistema
          $clientesR = $mysqli->query("SELECT * FROM cliente") or die($mysqli->error);
          $clientesCadastrados = $clientesR->fetch_all();


          //Verificar se o botão editar foi clicado
          if (isset($_GET['editar_agendamento'])) {
            $select = "SELECT * FROM agenda WHERE id_agenda=" . $_GET['editar_agendamento'];

            $agendamento = $mysqli->query($select);

            $rows_agendamento = $agendamento->fetch_assoc();
          } else {
            unset($rows_agendamento);
          }

          ?>
          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">Agendar Horário</h1>
          <!-- inicio do formulário de cadastro do barbeiro-->
          <form action="../controller/agenda/AgendaController.php" method="POST" class="user">

            <input type="hidden" name="id_agenda" value="<?php
                                                          if (isset($rows_agendamento)) {
                                                            echo $rows_agendamento['id_agenda'];
                                                          }
                                                          ?>">
            <div class="form-group">
              <label for="cliente_cadastrado">Cliente Já Cadastrado:</label>
              <select style="border-radius: 27px; height: 48px;" class="form-control" id="cliente_cadastrado" name="cliente_cadastrado">
                <option value="">(SELECIONE O ClIENTE SE ELE JÁ ESTÁ CADASTRADO)</option>
                <?php foreach ($clientesCadastrados as $value) : ?>
                  <option value="<?= $value[0] ?>"><?php echo $value[1] . ' - ' . $value[2] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="nome_cliente">Nome do Cliente: </label>
                <input value="<?php if (isset($rows_agendamento)) {
                                echo $rows_agendamento['nome_cliente'];
                              } ?>" name="nome_cliente" type="text" class="form-control form-control-user" id="nome_cliente" placeholder="Nome do Cliente">
              </div>
              <div class="col-sm-6">
                <label for="telefone_cliente">Telefone do Cliente: </label>
                <input value="<?php
                              if (isset($rows_agendamento)) {
                                echo $rows_agendamento['telefone'];
                              }
                              ?>" name="telefone_cliente" type="text" class="form-control form-control-user" id="telefone_cliente" placeholder="Telefone do Cliente">
              </div>
            </div>
            <!--
            <div class="form-group">
              <label for="funcionario_desejado">Selecione o Funcionário desejado:</label>
              <select class="form-control" id="funcionario_desejado">
                <option value="">(SELECIONE O FUNCIONÁRIO)</option>
                <?php foreach ($funcionariosAgenda as $value) : ?>
                  <option value="<?= $value[0] ?>"><?php echo $value[1] . ' - ' . $value[3] ?></option>
                <?php endforeach; ?>
              </select>
            </div> -->
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Data e Hora</label>
              <div class="col-sm-10">
                <div class="input-group date data_formato" data-date-format="dd/mm/yyyy HH:ii:ss">
                  <input value="<?php
                                if (isset($rows_agendamento)) {
                                  echo converterDataDeBancoParaNormal($rows_agendamento['data_hora']);
                                }
                                ?>" type="text" class="form-control form-control-user" name="data_agenda" placeholder="Data do agendamento" required>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-th"><i class="fas fa-fw fa-table"></i></span>
                  </span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="salvar_agenda" class="btn btn-success">Cadastrar</button>
              </div>
            </div>
          </form>
          <?php unset($_GET['editar_agendamento']) ?>
          <!-- inicio da listagem de barbeiros -->

          <?php //select para os barbeiros
          require_once('../db/connection.php');
          require_once('../util/datas/converterData.php');
          require_once('../util/conversoes/status.php');
          $result = $mysqli->query("SELECT * FROM agenda ORDER BY data_hora") or die($mysqli->error);

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
                      <th>Cliente</th>
                      <th>telefone</th>
                      <th>Data e Horário</th>
                      <th>STATUS</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Cliente</th>
                      <th>telefone</th>
                      <th>Data e Horário</th>
                      <th>STATUS</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($agenda as $value) : ?>
                      <tr>
                        <td><?= $value[1] ?></td>
                        <td><?= $value[2] ?></td>
                        <td><?php echo converterDataDeBancoParaNormal($value[3]) ?></td>
                        <td><?= verificaStatusAgendamento($value[4]) ?></td>
                        <td><a onclick="return confirm('Deseja realmente excluir?');" href="../controller/agenda/AgendaController.php?id_excluir_agendamento=<?= $value[0] ?>" class="btn btn-danger btn-circle">
                            <i class="fas fa-trash"></i>
                          </a>
                          <a href="agendar_horario.php?editar_agendamento=<?= $value[0] ?>" class="btn btn-warning btn-circle">
                            <i class="fas fa-align-center"></i>
                          </a></td>
                      </tr>
                    <?php endforeach;
                    // site dos icones - https://www.w3schools.com/icons/fontawesome5_icons_editors.asp
                    ?>

                  </tbody>
                </table>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/bootstrap-datetimepicker.min.js"></script>
  <script src="../js/locales/bootstrap-datetimepicker.pt-BR.js"></script>
  <script src="../js/calendario-agenda.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <!-- javascript para o campo da data e hora -->
  <script type="text/javascript">
    $('.data_formato').datetimepicker({
      weekStart: 1,
      todayBtn: 1,
      autoclose: 1,
      todayHighlight: 1,
      startView: 2,
      forceParse: 0,
      showMeridian: 1,
      language: "pt-BR",
      //startDate: '+0d'
    });
  </script>

</body>

</html>