<?php
session_start();
require_once("../../../estrutura/controleLogin.php");

$status = "";

if (isset($_GET['atualizar'])) {
    $msg = "atualizar";
    $status = $_GET['atualizar'];
}
if (isset($_GET['excluir'])) {
    $msg = "excluir";
    $status = $_GET['excluir'];
}


?>
<!DOCTYPE html>
<html lang="pt">
<?php
$pagina = "sub3";
include '../../../estrutura/head.php';
?>

<body id="page-top">
    <!-- modal inicio -->

    <div class="modal fade" id="modalEdicao" tabindex="-1" role="dialog" aria-labelledby="modalEdicaoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEdicaoLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerPessoasVisitas.php?acao=atualizar" enctype="multipart/form-data" id="formularioEnviar" method="post">
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirLabel">Resetar senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerPessoasVisitas.php?acao=excluir" id="formularioExcluir" method="post">
                    <div class="modal-body">

                        <!-- <input type="hidden" id="idt_pessoa" name="idt_pessoa"> -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal fim -->
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../../../estrutura/menulateral.php'; ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include '../../../estrutura/barratopo.php';
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    <!-- mensagem de sucesso e erro -->
                    <?php if ($status == "sucesso") : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Sucesso ao <?php echo $msg ?> pessoa!</strong>
                        </div>
                    <?php elseif ($status == "erro") : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro ao <?php echo $msg ?>, verifique os campos!</strong>
                        </div>
                    <?php endif; ?>
                    <!-- Fim mensagem sucesso e erro -->

                    <div class="d-sm-flex align-items-center justify-content-between mb-4 text-center">
                        <h1 class="h3 mb-0 text-gray-800 text-center">Pessoas</h1>
                    </div>
                </div>

                b4.
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Data visita</th>
                                <th>Cidade</th>
                                <th>Comentário</th>
                                <th>ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Data visita</th>
                                <th>Cidade</th>
                                <th>Comentário</th>
                                <th>ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!-- include estrutura da tabela -->
                            <?php include '../../../estrutura/tabelaVisitas.php'; ?>
                            <!-- fim include estrutura da tabela -->
                        </tbody>
                    </table>
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
    <!-- bootstrap core JS-->
    
    <?php

    include '../../../estrutura/importJS.php';
    ?>
    <script>
        $('#modalEdicao').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal

            // pessoa
            var nome = button.data('nome');
            var dataVisita = button.data('datacad');
            var cidade = button.data('cidade');
            var comentario = button.data('comentario');
            var idVisitas = button.data('idvisita');

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            $("#formularioEnviar .modal-body").html(`
                   
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label" for="nome">Nome pessoa:</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label" for="data">Data da visita:</label>
                    <input type="date" class="form-control" id="data" name="data">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nome pessoa:</label>
                    <input type="text" class="form-control" id="cidade" name="cidade">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label" for="comentario">Nome pessoa:</label>
                    <input type="text" class="form-control" id="comentario" name="comentario">
                </div>
                <input type="hidden" id="idVisitas" name="idVisitas">
                <input type="hidden" id="fkEndereco" name="fkEndereco">
            `)

            var dataFormatada = dataVisita.split("/").reverse().join('-')

            modal.find('#nome').val(nome);
            modal.find('#data').val(dataFormatada);
            modal.find('#cidade').val(cidade);
            modal.find('#comentario').val(comentario);
            modal.find('#idVisitas').val(idVisitas);

        });

        $('#modalResetar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var idusuario = button.data('idusuario') // Extract info from data-* attributes
            var nome = button.data('nome')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)



        });

        $('#modalExcluir').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // Extract info from data-* attributes
            var nome = button.data('nome');
            var idVisitas = button.data('idvisitas');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.


            $('#formularioExcluir .modal-body').html(`
                <label id="texto_excluir"></label>
                <input type="hidden" id="idVisitas" name="idVisitas">
            `);


            var modal = $(this)
            modal.find('.modal-title').text('Confirmar exclusão')
            modal.find('#texto_excluir').text("Tem certeza que desaja excluir a pessoa: " + nome + " do sistema ?");
            modal.find('#idVisitas').val(idVisitas);

        });
    </script>
</body>

</html>