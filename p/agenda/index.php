<!DOCTYPE html>
<html lang="pt">

    <?php
    $pagina = "sub";
    include '../../estrutura/head.php';
    ?>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <?php include '../../estrutura/menulateral.php'; ?>
            <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">                    
                    <?php include '../../estrutura/barratopo.php'; ?>                   
                    <!-- Begin Page Content -->
                    <div class="container-fluid ">
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4 text-center">
                            <h1 class="h3 mb-0 text-gray-800 text-center">Agenda</h1>
                        </div>
                    </div>


                    <iframe src="https://calendar.google.com/calendar/b/2/embed?height=600&amp;wkst=1&amp;bgcolor=%23EF6C00&amp;ctz=America%2FSao_Paulo&amp;src=cHJvZnRoeWFnb3BlcmVpcmFAZ21haWwuY29t&amp;src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;src=cHQuYnJhemlsaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&amp;color=%23039BE5&amp;color=%2333B679&amp;color=%230B8043&amp;title=Fesper" style="border:solid 1px #777" width="800" height="600" frameborder="0" scrolling="no"></iframe>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include '../../estrutura/footer.php'; ?>
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
    </body>

</html>
