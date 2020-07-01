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
<style>
    .custom-file-input:lang(pt)~.custom-file-label::after {
        content: "Selecione um arquivo" !important;
    }
</style>

<body id="page-top">
    <!-- modal inicio -->

    <div class="modal fade" id="modalEdicao" tabindex="-1" role="dialog" aria-labelledby="modalEdicaoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEdicaoLabel">Editar oficios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerOficios.php?acao=atualizar" enctype="multipart/form-data" id="formularioEnviar" method="post">
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
                <form action="../../../controller/ControllerOficios.php?acao=deletar" id="formularioExcluir" method="post">
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
    <div class="modal fade" id="modalArquivos" tabindex="-1" role="dialog" aria-labelledby="modalArquivosLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalArquivosLabel">Arquivos oficios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="link_arquivos"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>

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
                <?php if ($status == "sucesso") : ?>
                    <div class="alert alert-success text-center" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Sucesso ao <?php echo $msg ?>.
                    </div>
                <?php elseif ($status == "erro") : ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Erro ao <?php echo $msg ?>, verifique os campos.
                    </div>
                <?php endif; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    <!-- mensagem de sucesso e erro -->

                    <!-- Fim mensagem sucesso e erro -->

                    <div class="card-header text-center ">
                        <h5 class="cabecalho_paginas">Lista dos oficios</h5>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>Número do documento</th>
                                <th>Solicitante</th>
                                <th>Instituição</th>
                                <th>Nome do contato</th>
                                <th>Data de cadastro</th>
                                <th>Assunto</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Número do documento</th>
                                <th>Solicitante</th>
                                <th>Instituição</th>
                                <th>Nome do contato</th>
                                <th>Data de cadastro</th>
                                <th>Assunto</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!-- include estrutura da tabela -->
                            <?php include '../../../estrutura/tabelaOficios.php'; ?>
                            <!-- fim include estrutura da tabela -->
                        </tbody>
                    </table>
                </div>
                <!-- End of Main Content -->
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
    <!-- bootstrap core JS-->
    <?php
    include '../../../estrutura/importJS.php';
    ?>
    <script>
        $('#modalArquivos').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var idtofi = button.data('idtofi')
            $.post('/view/oficios/call_oficios.php', {
                idoficios: idtofi
            }, function(data) {
                img = "";
                var cont = 1;
                var link = "";

                $.each(JSON.parse(data), function(index, value) {
                    // alert(value.arquivo_caminho);
                    link += cont + " - <a href=\"../../" + value.arquivo_caminho + "\" target='_blank'>" + value.nome_arquivo + "</a><br/>";
                    cont++;
                });
                if (link != "") {
                    $("#modalArquivos #link_arquivos").html(link);
                } else {
                    $("#modalArquivos #link_arquivos").html("Nenhum documento cadastrado.");
                }
            });
        });
        $('#modalEdicao').on('show.bs.modal', function(event) {


            var button = $(event.relatedTarget) // Button that triggered the modal


            // data parametros
            var idtofi = button.data('idtofi')
            var numDoc = button.data('numdoc')
            var solicitante = button.data('solicitante')
            var instituicao = button.data('instituicao')
            var nomeContato = button.data('nomecontato')
            var dataDoc = button.data('datadoc')
            var tipo = button.data('tipo')
            var titulo = button.data('titulo')
            var descricao = button.data('descricao')
            console.log(idtofi);
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
               
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Assunto:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Data do documento:</label>
                    <input type="date" class="form-control" id="dataDocumento" name="dataDocumento">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Descrição:</label>
                    <textarea type="text" class="form-control" id="descricao" name="descricao"></textarea>
                </div>
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <select name="status" id="status" class="form-control show-tick ">
                            <option value="aberto">Aberto</option>
                            <option value="aguardando">Aguardando informações</option>
                            <option value="concluido">Concluido</option>
                        </select>
                    </div>
                </div>

                <label>Arquivos</label>
                <div class="input-group mb-3">
                    <div class="custom-file" lang="pt">
                        <input type="file"name="arquivos[]" multiple id="arquivosE" class="custom-file-input">
                        
                        <label class="custom-file-label" for="arquivosE"  id="nomeArqe" aria-describedby="inputGroupFileAddon02"></label>

                    </div>
                   
                </div>
                <label  id="listaNomes" aria-describedby="inputGroupFileAddon02"></label>
                <input type="hidden" id="tipo" name="tipo">
                <input type="hidden" id="idtofi" name="idtofi">
            `)

            // seta os valores do modal
            console.log(numDoc);
            modal.find('#documento').val(numDoc);
            modal.find('#solicitante').val(solicitante);
            modal.find('#instituicao').val(instituicao);
            modal.find(`#nomeContato`).val(nomeContato);
            modal.find('#titulo').val(titulo);
            var dataFormatada = dataDoc.split('/').reverse().join('-');
            modal.find('#dataDocumento').val(dataFormatada);
            modal.find('#descricao').val(descricao);
            modal.find('#tipo').val(tipo);
            modal.find('#idtofi').val(idtofi);

            modal.find('#status option[value=' + status + ']').attr('selected', 'selected');
            $('#arquivosE').on('change', function() {
              
                var nomeArqe = $(this)[0].files[0].name;
               
                var i = 0;
                var a = [];
                var nomes = "";
                while (i < $(this)[0].files.length) {

                    a[i] = $(this)[0].files[i].name;
                        nomes += (i+1) + " - " + a[i];
                        nomes += "<br/>";
                    i++
                }
                $('#listaNomes').html(nomes);
                $('#nomeArqe').text($(this)[0].files.length + " arquivos adicionados");
               
            });
        });

        $('#modalExcluir').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // Extract info from data-* attributes
            var idtofi = button.data('idtofi')
            var tipo = button.data('tipo');
            var numDoc = button.data('numdoc');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            $('#formularioExcluir .modal-body').html(`
                    <label id="texto_excluir"></label>
                    <input type="hidden" id="idtofi" name="idtofi">
                    <input type="hidden" id="tipo" name="tipo">
                    
                `);


            var modal = $(this)
            modal.find('.modal-title').text('Confirmar exclusão')
            modal.find('#texto_excluir').text("Tem certeza que deseja excluir o documento: " + numDoc + "  do sistema ?")

            // modal.find('#idtofi').val(numdoc);
            modal.find('#idtofi').val(idtofi);
            modal.find('#tipo').val(tipo);


        });
    </script>
</body>

</html>