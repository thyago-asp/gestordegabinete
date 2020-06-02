<?php
session_start();
require_once("../../../estrutura/controleLogin.php");
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
                    <div id="pagina" class="card-header text-center h5 col-sm-12">
                        <h5 class="cabecalho_paginas">Registrar visitas</h5>
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
                    <form id="formF" enctype="multipart/form-data" action="../../../controller/ControllerPessoaVisita.php?acao=cad" method="post">

                        <div class="accordion" id="accordionExample">
                            <div class="card">

                                
                                    <div class="card-body">
                                        <div class="panel-body">
                                            <label class="form-label">Nome completo</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nome" required>

                                                </div>
                                            </div>
                                            <label class="form-label">Data</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="date" class="form-control" name="dataVisita" required>

                                                </div>
                                            </div>
                                            <label class="form-label">Cidade</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="cidade" id="cidade" required>

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

            $("#cepF").blur(function() {
                var cep = $(this).val().replace(/\D/g, "");

                if (cep != "") {
                    console.log(cep);
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                        // console.log(dados);
                        if (!("erro" in dados)) {


                            $('#logradouroF').val(dados.logradouro);
                            // $('#logradouroF').val(dados.bairro);
                            $('#bairroF').val(dados.bairro);
                            $('#cidadeF').val(dados.localidade);
                            $('#ufF').val(dados.uf);

                        }

                    }).fail((e) => {
                        alert("CEP NÃO ENCONTRADO");
                    });

                }

            });

            $("#cepJ").blur(function() {
                var cep = $(this).val().replace(/\D/g, "");

                if (cep != "") {
                    console.log(cep);
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {

                            $('#logradouroJ').val(dados.logradouro);
                            $('#bairroJ').val(dados.bairro);
                            $('#cidadeJ').val(dados.localidade);
                            $('#estadoJ').val(dados.uf);

                        }



                    }).fail((e) => {
                        alert("CEP NÃO ENCONTRADO");
                    });

                }

            });
        });
    </script>
</body>

</html>