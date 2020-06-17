<?php
session_start();
require_once("../../../estrutura/controleLogin.php");
// require_once("");

$status = '';
if (isset($_GET['cad'])) {
    $status = $_GET['cad'];
}

?>
<!DOCTYPE html>
<html lang="pt">
<?php
$pagina = "sub3";
include '../../../estrutura/head.php';

?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../../../estrutura/menulateral.php'; ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include '../../../estrutura/barratopo.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid ">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 text-center">
                        <h1 class="h3 mb-0 text-gray-800 text-center">Cadastrar visita</h1>
                    </div>
                </div>
                <?php if ($status == "sucesso") : ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Sucesso ao cadastrar pessoa!</strong>
                    </div>
                <?php elseif ($status == "erro") : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Erro ao cadastrar verifique os campos!</strong>
                    </div>
                <?php endif; ?>

                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                    <form id="formPessoas" enctype="multipart/form-data" action="../../../controller/ControllerPessoasVisitas.php?acao=salvar" method="post">

                        <div class="accordion" id="accordionExample">
                            <div class="card">


                                <div class="card-body">
                                    <div class="panel-body">
                                        <div id="pessoasInput">
                                            <!-- input cidades / nomes -->
                                        </div>
                                        <label class="form-label">Nome completo</label>
                                        <label class="form-label">Data</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="dataVisita" required>

                                            </div>
                                        </div>
                                       
                                        <label class="form-label">Comentario</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="comentario" required>
                                            </div>
                                        </div>

                                    </div>
                                    <input type="submit" class="btn btn-success">

                                </div>


                            </div>
                        </div>

                    </form>

                </div>
            </div>


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php include '../../../estrutura/footer.php'; ?>
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
    include '../../../estrutura/painelLogout.php';
    ?>
    <!-- Bootstrap core JavaScript-->
    <?php
    include '../../../estrutura/importJS.php';
    ?>
    <script>
        $(document).ready(() => {
            
            $.ajax({
                url: "../../../estrutura/controleVisitas.php",
                type: "GET",
                success: (res) => {
                    $("#pessoasInput").html(res)
                }
            })

        });
    </script>
</body>

</html>