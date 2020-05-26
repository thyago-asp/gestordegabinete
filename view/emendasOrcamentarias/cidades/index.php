<?php
session_start();
//require_once("../../estrutura/controleLogin.php");


if (isset($_REQUEST["id"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
  
        $idCidade = $_REQUEST["id"];


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
        <?php
        include '../../../estrutura/menulateral.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <?php
                include '../../../estrutura/barratopo.php';
                ?>

                <!-- CONTEUDO PRINCIPAL DA PAGINA -->
                <div class="container-fluid">
                    <?php
                            $emendas = new ControllerEmendasOrcamentarias();

                            $listaEmendas = $emendas->buscarCidades($idCidade);

                            print_r($listaEmendas);
                    ?>
                    <div class="row">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"> </h5>
                                    <p class="card-text">Content</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Title</h5>
                                    <p class="card-text">Content</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Title</h5>
                                    <p class="card-text">Content</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include '../../../estrutura/footer.php';
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
    include '../../../estrutura/painelLogout.php';
    ?>

    <!-- Bootstrap core JavaScript-->
    <?php
    include '../../../estrutura/importJS.php';
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