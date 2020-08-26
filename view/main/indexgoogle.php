<?php
session_start();
require_once("../../estrutura/controleLogin.php");
require_once("../../controller/ControllerRequerimentos.php");
require_once("../../controller/ControllerOficios.php");
require_once("../../controller/ControllerProjetosDeLei.php");
require_once("../../controller/ControllerEmendasOrcamentarias.php");
require_once("../../controller/ControllerGeral.php");
require_once("../../google.php");

$primeiro_acesso = "";
$retorno_alterarSenha = "";
// caso a senha do usuario seja resetada ou seja o seu primeiro acesso. 
// marcamos a variavel como verdadeira(1) para que o modalPrimeiroAcesso seja chamado
// e o usuario mude a sua senha. 

if (isset($_SESSION["primeiro_acesso"])) {
    if ($_SESSION["primeiro_acesso"] == 1) {
        $primeiro_acesso = "1";
    }
}

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
    // 1 = sucesso.
    if ($_REQUEST["r"] == "1") {
        $retorno_alterarSenha = "sucesso";
    }
}
?>
<!DOCTYPE html>

<html lang="pt">

<?php
$pagina = "sub";
include '../../estrutura/head.php';
?>
<?php
$control = new ControllerRequerimentos();
$req = $control->buscarUltimoRegistro();


$control = new ControllerOficios();
$ofi = $control->buscarUltimoRegistro();

$control = new ControllerProjetosDeLei();
$pro = $control->buscarUltimoRegistro();

$control = new ControllerEmendasOrcamentarias();
$eme = $control->buscarUltimoRegistro();
$valorTotal = $control->buscarValorDocumentos();
$totalDocumentos = $control->buscarQuantidadeDocumentos();
$geral = new ControllerGeral();


?>

<body id="page-top">


    <!-- Modal -->
    <div class="modal fade" id="modalPrimeiroAcesso" tabindex="-1" role="dialog" aria-labelledby="modalPrimeiroAcessoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPrimeiroAcessoLabel">Atualizar a senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerUsuario.php?acao=alterarSenha" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="senha">Nova senha</label>
                            <input type="password" class="form-control" name="senha1" id="senha1" onkeyup="validarSenha()">
                        </div>
                        <div class="form-group">
                            <label for="">Repita a nova senha</label>
                            <input type="password" class="form-control" name="senha2" id="senha2" onkeyup="validarSenha()">
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" id="btn_salvarSenha" name="btn_salvarSenha">Salvar senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include '../../estrutura/menulateral.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <?php
                include '../../estrutura/barratopo.php';
                ?>

                <!-- CONTEUDO PRINCIPAL DA PAGINA -->
                <div class="container-fluid">
                    <?php
                    if ($retorno_alterarSenha == "sucesso") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Nova senha cadastrada com sucesso
                        </div>
                    <?php
                    }
                    ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Painel</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body card_main">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Documentos registrados(Mês atual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalDocumentos['somatotal'] ?></div>

                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body card_main">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total de verba destinada ao estado do Paraná(2020)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?php echo number_format($valorTotal['valor'], 2, ",", ".") ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body card_main">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->

                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Últimas atualizações de documentos</h6>
                                    </div>
                                    <div class="card-body card_main">

                                        <h4 class="small font-weight-bold">Requerimentos - <a href="../requerimentos/listar"><?php echo $req["numDoc"] ?></a> - <?php echo $geral->limita_caracteres($req["titulo"], 40) ?><span id="status" class="float-right"><?php echo $req["status"] ?></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Ofícios - <a href="../oficios/listar"><?php echo $ofi["numDoc"] ?></a> - <?php echo $geral->limita_caracteres($ofi["titulo"], 40) ?><span id="status" class="float-right"><?php echo $ofi["status"] ?></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Projetos de lei - <a href="../projetosdelei/listar"><?php echo $pro["numDoc"] ?></a> - <?php echo $geral->limita_caracteres($pro["titulo"], 40) ?><span id="status" class="float-right"><?php echo $pro["status"] ?></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h4 class="small font-weight-bold">Emendas orçamentarias - <a href="../emendasOrcamentarias/listar"><?php echo $eme["numDoc"] ?></a> - <?php echo $geral->limita_caracteres($eme["titulo"], 40) ?><span id="status" class="float-right"><?php echo $eme["status"] ?></span></h4>
                                        <div class="progress mb-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Agenda de hoje</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered"  width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Resumo</th>
                                                    <th>Horario</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                


                                                <?php
                                                // Get the API client and construct the service object.

                                                $client = getClient();
                                                $service = new Google_Service_Calendar($client);

                                                // Print the next 10 events on the user's calendar.
                                                $calendarId = 'primary';
                                                $optParams = array(
                                                    'maxResults' => 10,
                                                    'orderBy' => 'startTime',
                                                    'singleEvents' => true,
                                                    'timeMin' => date('c'),
                                                );
                                                $results = $service->events->listEvents($calendarId, $optParams);
                                                $events = $results->getItems();

                                                if (empty($events)) {
                                                    print "No upcoming events found.\n";
                                                } else {
                                                    // print "Upcoming events:\n";
                                                    foreach ($events as $event) {
                                                        $start = $event->start->dateTime;
                                                        $final = $event->end->dateTime;

                                                       

                                                        if (empty($start)) {
                                                            $start = $event->start->date;
                                                            $dateStart = new DateTime($start);
                                                            $start = $dateStart->format('d-m-Y');
                                                        }else{
                                                            $dateStart = new DateTime($start);
                                                            $start = $dateStart->format('d-m-Y H:i:s');
                                                        }

                                                        if (empty($final)) {
                                                            $final = $event->end->date;
                                                            $dateFinal = new DateTime($final);
                                                            $final = $dateFinal->format('d-m-Y');
                                                        }else{
                                                            $dateFinal = new DateTime($final);
                                                            $final = $dateFinal->format('d-m-Y H:i:s');
                                                        }
                                                        

                                                ?>
                                                        <tr>
                                                            <td><?php echo $event->getSummary() ?></td>
                                                            <td><?php echo $start ?> <br> <?php echo $final?></td>
                                                        </tr>
                                                <?php
                                                       
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->

                        </div>


                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include '../../estrutura/footer.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
    include '../../estrutura/painelLogout.php';
    ?>

    <!-- Bootstrap core JavaScript-->
    <?php
    include '../../estrutura/importJS.php';
    ?>

    <?php
    if ($primeiro_acesso == "1") {
    ?>
        <script>
            $('#modalPrimeiroAcesso').modal('show');

            document.getElementById("btn_salvarSenha").disabled = true;

            function validarSenha() {
                var senha1 = document.getElementById("senha1").value;
                var senha2 = document.getElementById("senha2").value;

                if (senha1 == senha2) {
                    document.getElementById("btn_salvarSenha").disabled = false;
                } else {
                    document.getElementById("btn_salvarSenha").disabled = true;
                }
            }
        </script>
    <?php
    }
    ?>
</body>

</html>