<?php
session_start();
require_once("../../../estrutura/controleLogin.php");
?>
<!DOCTYPE html>
<html lang="pt">
<?php
$pagina = "sub3";
include '../../../estrutura/head.php';
?>
<style>
    .custom-file-input:lang(pt)~.custom-file-label::after {
        content: "Selecione um arquivo" !important;
    }
</style>

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


                <?php include '../../../estrutura/emendas.php' ?>

            </div>

            

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

</body>
<script>
    $('#arquivos').on('change', function() {
        var nomeArq = $(this)[0].files[0].name;

        var i = 0;
        var a = [];
        var nomes = "";
        while (i < $(this)[0].files.length) {

            a[i] = $(this)[0].files[i].name;
            nomes += (i + 1) + " - " + a[i];
            nomes += "<br/>";
            i++
        }
        $('#listaNomes').html(nomes);
     
        if ($(this)[0].files.length > 1) {
            $('#nomeArq').text($(this)[0].files.length + " arquivos adicionados");
        } else {
            $('#nomeArq').text($(this)[0].files.length + " arquivo adicionado");
        }
    });
</script>

</html>