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
                <form action="../../../controller/ControllerRequerimentos.php?acao=atualizar" enctype="multipart/form-data" id="formularioEnviar" method="post">
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
                    <h5 class="modal-title" id="modalExcluirLabel">Excluir Requerimento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerRequerimentos.php?acao=deletar" id="formularioExcluir" method="post">
                    <div class="modal-body">
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
                            <strong>Sucesso ao <?php echo $msg ?>!</strong>
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
                                <th>solicitante</th>
                                <th>instituicao</th>
                                <th>nome do contato</th>
                                <th>data</th>
                                <th>titulo</th>
                                <th>numero do documento</th>
                                <th>ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>solicitante</th>
                                <th>instituicao</th>
                                <th>nome do contato</th>
                                <th>data</th>
                                <th>titulo</th>
                                <th>numero do documento</th>
                                <th>ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!-- include estrutura da tabela -->
                            <?php include '../../../estrutura/tabelaRequerimentos.php'; ?>
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


            // data parametros
            var idtReq = button.data('idtreq')
            var numDoc = button.data('numdoc')
            var solicitante = button.data('solicitante')
            var instituicao = button.data('instituicao')
            var nomeContato = button.data('nomecontato')
            var dataDoc = button.data('datadoc')
            var tipo = button.data('tipo')
            var titulo = button.data('titulo')
            var descricao = button.data('descricao')
            console.log(idtReq);
            var status = button.data('status');

            var atividade = button.data('atividade');
            

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            // define o parametro da action para atualizar usuarios


            $("#formularioEnviar .modal-body").html(` 
            
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Numero documento solicitado:</label>
                    <input type="text" class="form-control" id="documento" name="documento">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Solicitante (Origem):</label>
                    <input type="text" class="form-control" id="solicitante" name="solicitante">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Instituição (Destino):</label>
                    <input type="text" class="form-control" id="instituicao" name="instituicao">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nome do contato:</label>
                    <input type="text" class="form-control" id="nomeContato" name="nomeContato">
                </div>
                <label class="form-label">Categoria</label>
                
                <label>Endereco</label>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Titulo:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Data do documento:</label>
                    <input type="text" class="form-control" id="dataDocumento" name="dataDocumento">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Descrição:</label>
                    <textarea type="text" class="form-control" id="descricao" name="descricao"></textarea>
                </div>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <select name="status" id="status" class="form-control show-tick ">
                            <option value="aberto">Aberto</option>
                            <option value="aguardando informações">Aguardando informações</option>
                            <option value="concluido">Concluido</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" id="tipo" name="tipo">
                <input type="hidden" id="idtReq" name="idtReq">
            `)

            // seta os valores do modal
            console.log(numDoc);
            modal.find('#documento').val(numDoc);
            modal.find('#solicitante').val(solicitante);
            modal.find('#instituicao').val(instituicao);
            modal.find(`#nomeContato`).val(nomeContato);
            modal.find('#titulo').val(titulo);
            modal.find('#dataDocumento').val(dataDoc);
            modal.find('#descricao').val(descricao);
            modal.find('#tipo').val(tipo);
            modal.find('#idtReq').val(idtReq);
            modal.find('#status').val(status);



        });

        $('#modalExcluir').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // Extract info from data-* attributes
            var idtReq = button.data('idtreq')
            var tipo = button.data('tipo');
            var numDoc = button.data('numdoc');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            console.log(idtReq);
            $('#formularioExcluir .modal-body').html(`
                    <label id="texto_excluir"></label>
                    <input type="hidden" id="idtReq" name="idtReq">
                    <input type="hidden" id="tipo" name="tipo">
                    
                `);


            var modal = $(this)
            modal.find('.modal-title').text('Confirmar exclusão')
            modal.find('#texto_excluir').text("Tem certeza que deseja excluir o documento: "+ numDoc +"  do sistema ?")

            // modal.find('#idtReq').val(numdoc);
            modal.find('#idtReq').val(idtReq);
            modal.find('#tipo').val(tipo);
            

        });
    </script>
</body>

</html>