<?php
session_start();
require_once("../../../estrutura/controleLogin.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerEmendasOrcamentarias.php');

$status = "";

if (isset($_GET['atualizar'])) {
    $msg = "atualizar";
    $status = $_GET['atualizar'];
}
if (isset($_GET['excluir'])) {
    $msg = "excluir";
    $status = $_GET['excluir'];
}

$listaCidades = (new ControllerEmendasOrcamentarias)->listarCidades();

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
                    <h5 class="modal-title" id="modalEdicaoLabel">Editar requerimentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerRequerimentos.php?acao=atualizar" enctype="multipart/form-data" id="formularioEnviar" method="post">
                    <div class="modal-body">
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
                            <label for="recipient-name" class="col-form-label">Cidade</label>
                            <div class="form-group">
                                <div class="form-line">

                                    <select class="form-control" id="cidade" name="cidade">
                                        <option value=""> Selecione uma cidade </option>
                                        <?php

                                        foreach ($listaCidades as $cidade) {
                                        ?>
                                            <option value="<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
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
                        <label>Status</label>
                        <div class="form-group">

                            <select name="status" id="status" class="form-control show-tick ">
                                <option value="aberto">Aberto</option>
                                <option value="aguardando">Aguardando informações</option>
                                <option value="concluido">Concluido</option>
                            </select>
                        </div>
                        <label>Arquivos</label>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="custom-file" lang="pt">
                                    <input type="file" name="arquivos[]" multiple id="arquivosE" class="custom-file-input">

                                    <label class="custom-file-label" for="arquivosE" id="nomeArqe" aria-describedby="inputGroupFileAddon02"></label>

                                </div>
                            </div>
                        </div>
                        <label id="listaNomes" aria-describedby="inputGroupFileAddon02"></label>
                        <label class="form-label">Adicionar comentario</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
                            </div>
                        </div>

                        <table class="table" id="tabela_comentarios">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Comentario</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                        </table>

                        <input type="hidden" id="tipo" name="tipo">
                        <input type="hidden" id="idtReq" name="idtReq">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExcluirComentario" tabindex="-1" role="dialog" aria-labelledby="modalExcluirComentarioLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirComentarioLabel">Excluir comentario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerRequerimentos.php?acao=deletarComentario" id="formularioExcluir" method="post">
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
                    <h5 class="modal-title" id="modalArquivosLabel">Arquivos de requerimentos</h5>
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
                <?php include '../../../estrutura/barratopo.php'; ?>
                <?php if ($status == "sucesso") : ?>
                    <div class="alert alert-success text-center" role="alert">

                        Sucesso ao <?php echo $msg ?>
                    </div>
                <?php elseif ($status == "erro") : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Erro ao <?php echo $msg ?>, verifique os campos!</strong>
                    </div>
                <?php endif; ?>
                <!-- Begin Page Content -->

                <div class="container-fluid ">
                    <div class="card-header text-center ">
                        <h5 class="cabecalho_paginas">Lista dos requerimentos</h5>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Numero do documento</th>
                                    <th>Solicitante</th>
                                    <th>Instituicao</th>
                                    <th>Tipo</th>
                                    <th>Data</th>
                                    <th>Assunto</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Numero do documento</th>
                                    <th>Solicitante</th>
                                    <th>Instituicao</th>
                                    <th>Tipo</th>
                                    <th>Data</th>
                                    <th>Assunto</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <!-- include estrutura da tabela -->
                                <?php include '../../../estrutura/tabelaRequerimentos.php'; ?>
                                <!-- fim include estrutura da tabela -->
                            </tbody>
                        </table>
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
    <!-- bootstrap core JS-->
    <?php
    include '../../../estrutura/importJS.php';
    ?>
    <script>
        $('#modalArquivos').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            var idtreq = button.data('idtreq')

            $.post('/view/requerimentos/call_requerimentos.php', {
                idrequerimento: idtreq
            }, function(data) {
                img = "";
                var cont = 1;
                var link = "";

                $.each(JSON.parse(data), function(index, value) {
                    // alert(value.arquivo_caminho);
                    link += cont + " - <a href='./../../" + value.arquivo_caminho + "' target='_blank'>" + value.nome_arquivo + "</a><br/>";
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
            var idtReq = button.data('idtreq')
            var numDoc = button.data('numdoc')
            var solicitante = button.data('solicitante')
            var instituicao = button.data('instituicao')
            var cidade = button.data('cidade')
            var nomeContato = button.data('nomecontato')
            var dataDoc = button.data('datadoc')
            var tipo = button.data('tipo')
            var titulo = button.data('titulo')
            var descricao = button.data('descricao')

            var status = button.data('status')
            //console.log(status);
            var atividade = button.data('atividade');


            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            // seta os valores do modal

            modal.find('#documento').val(numDoc);
            modal.find('#solicitante').val(solicitante);
            modal.find('#instituicao').val(instituicao);
            modal.find('#cidade').val(cidade);
            modal.find(`#nomeContato`).val(nomeContato);

            modal.find('#titulo').val(titulo);
            var dataFormatada = dataDoc.split('/').reverse().join('-');
            modal.find('#dataDocumento').val(dataFormatada);
            modal.find('#descricao').val(descricao);
            modal.find('#tipo').val(tipo);
            modal.find('#idtReq').val(idtReq);

            modal.find('#status option[value=' + status + ']').attr('selected', 'selected');

            $.post('/view/requerimentos/call_comentarios_requerimentos.php', {
                idrequerimento: idtReq
            }, function(data) {
                var linha = "";

                $.each(JSON.parse(data), function(index, value) {
                    linha += "<tr>";
                    linha += "<td><label>" + value["data"] + "</label></td>";
                    linha += "<td><label>" + value["comentario"] + "</label></td>";
                    linha += "<td><button class=\"btn btn-danger\" type=\"button\" data-toggle=\"modal\" data-target=\"#modalExcluirComentario\" data-idtreq=" + value["idt_comentarios_requerimentos"] + "> <i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button></td>";
                    linha += "</tr>";
                });

                $('#tabela_comentarios tbody').html(linha);
            });
            $('#modalExcluirComentario').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)

                var idtreq = button.data('idtreq')

                $('#formularioExcluir .modal-body').html(`
                    <label id="texto_excluir"></label>
                    <input type="hidden" id="idtreq" name="idtreq">
                  
                `);


                var modal = $(this)
                modal.find('.modal-title').text('Confirmar exclusão')
                modal.find('#texto_excluir').text("Tem certeza que deseja excluir o comentario do sistema ?")

                modal.find('#idtreq').val(idtreq);

            });
            $('#arquivosE').on('change', function() {

                var nomeArqe = $(this)[0].files[0].name;

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
                $('#nomeArqe').text($(this)[0].files.length + " arquivos adicionados");

            });

        });

        $('#modalExcluir').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // Extract info from data-* attributes
            var idtReq = button.data('idtreq')
            var tipo = button.data('tipo');
            var numDoc = button.data('numdoc');
            var idtArq = button.data('fkrequerimentos0')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            // console.log(idtReq);
            $('#formularioExcluir .modal-body').html(`
                    <label id="texto_excluir"></label>
                    <input type="hidden" id="idtReq" name="idtReq">
                    <input type="hidden" id="tipo" name="tipo">
                    <input type="hidden" id="idtArq" name="idtArq">
                    
                `);

            //  console.log(idtArq)
            var modal = $(this)
            modal.find('.modal-title').text('Confirmar exclusão')
            modal.find('#texto_excluir').text("Tem certeza que deseja excluir o documento: " + numDoc + "  do sistema ?")

            // modal.find('#idtReq').val(numdoc);
            modal.find('#idtReq').val(idtReq);
            modal.find('#tipo').val(tipo);
            modal.find('#idtArq').val(idtArq)


        });
    </script>
</body>

</html>