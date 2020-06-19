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
                    <?php if ($status == "sucesso") : ?>
                        <div class="alert alert-success text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Sucesso ao cadastrar pessoa!</strong>
                        </div>
                    <?php elseif ($status == "erro") : ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro ao cadastrar verifique os campos!</strong>
                        </div>
                    <?php endif; ?>
                    <!-- Page Heading -->
                    <div class="card-header text-center">
                        <h1 class="cabecalho_paginas">Cadastrar visita</h1>
                    </div>
                </div>


                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                    <form id="formPessoas" enctype="multipart/form-data" action="../../../controller/ControllerPessoasVisitas.php?acao=salvar" method="post">

                        <div class="accordion" id="accordionExample">
                            <div class="card">


                                <div class="card-body">
                                    <div class="panel-body">
                                        <div id="pessoasInput">
                                            <!-- input cidades / nomes -->
                                        </div>
                                        <!-- <label class="form-label">Nome completo</label> -->
                                        <label class="form-label">Data</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="date" class="form-control" id="data" name="dataVisita" required>

                                            </div>
                                        </div>

                                        <label class="form-label">Comentario</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary btn-cadastrar">
                                    </div>


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

            $("#data").on('click', () => {
                dia = new Date().getDate().toString();
                mes = ((new Date().getMonth()) + 1).toString();
                ano = new Date().getFullYear();

                if (mes.length == 1) {
                    mes = '0' + mes
                }
                if (dia.length == 1) {
                    dia = '0' + dia;
                }
                data = `${ano}-${mes}-${dia}`
                $("#data").val(data);
            });

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