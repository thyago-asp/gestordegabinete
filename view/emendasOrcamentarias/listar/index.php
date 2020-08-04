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
if (isset($_GET['excluirAnexo'])) {
    $msg = "excluir anexo da emenda orcamentaria";
    $status = $_GET['excluirAnexo'];
}
if (isset($_GET['excluirComentario'])) {
    $msg = "excluir comentario da emenda orcamentaria";
    $status = $_GET['excluirComentario'];
}
if (isset($_GET['excluirVisita'])) {
    $msg = "excluir visita da emenda orcamentaria";
    $status = $_GET['excluirVisita'];
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
                    <h5 class="modal-title" id="modalEdicaoLabel">Editar emendas orçamentarias</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerEmendasOrcamentarias.php?acao=atualizarEmenda" enctype="multipart/form-data" id="formularioEnviar" method="post">
                    <div class="modal-body">
                        <label>Tipo de emenda</label>
                        <div class="form-group">

                            <select name="tipo_emenda" id="tipo_emenda" class="form-control show-tick ">
                                <option value="emenda_federal">Emenda Federal</option>
                                <option value="emenda_estadual">Emenda Estadual</option>
                                <option value="emenda_municipal">Emenda Municipal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Numero documento solicitado:</label>
                            <input type="text" class="form-control" id="documento" name="documento">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Solicitante (Origem):</label>
                            <input type="text" class="form-control" id="solicitante" name="solicitante">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Beneficiario:</label>
                            <input type="text" class="form-control" id="beneficiario" name="beneficiario">
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
                        <label class="form-label">Valor</label>
                        <div class="form-group">
                            <div class="form-line">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">R$</span>
                                    </div>
                                    <input type="number" class="form-control" name="valor" id="valor">
                                </div>
                            </div>
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
                                <option value="solicitado">Solicitado</option>
                                <option value="pendente">Pendente</option>
                                <option value="pago">Pago</option>
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

                        <table class="table table-bordered table-hover" id="tabela_comentarios">
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
                        <input type="hidden" id="idteme" name="idteme">
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
                <form action="../../../controller/ControllerEmendasOrcamentarias.php?acao=deletarComentario" id="formularioExcluir" method="post">
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
                    <h5 class="modal-title" id="modalArquivosLabel">Arquivos de emendas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <table class="table table-bordered" id="tabela_arquivos">
                        <thead>
                            <tr>

                                <th>Arquivo</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>



                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalExcluirAnexo" tabindex="-1" role="dialog" aria-labelledby="modalExcluirAnexoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirAnexoLabel">Excluir anexo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerEmendasOrcamentarias.php?acao=deletarAnexo" id="formularioExcluirAnexo" method="post">
                    <div class="modal-body">
                        <label id="texto_excluir"></label>
                        <input type="hidden" id="idteme" name="idteme">
                        <input type="hidden" id="caminho_arquivo" name="caminho_arquivo">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirLabel">Excluir Emenda Orçamentaria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerEmendasOrcamentarias.php?acao=deletar" id="formularioExcluir" method="post">
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
                        <h5 class="cabecalho_paginas">Lista das emendas orçamentarias</h5>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tipo de emenda</th>
                                    <th>Num. documento</th>
                                    <th>Beneficiário</th>
                                    <th>Valor</th>
                                    <th>Assunto</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tipo de emenda</th>
                                    <th>Num. documento</th>
                                    <th>Beneficiário</th>
                                    <th>Valor</th>
                                    <th>Assunto</th>
                                    <th>Status</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <!-- include estrutura da tabela -->
                                <?php include '../../../estrutura/tabelaEmendas.php'; ?>
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
            var idteme = button.data('idteme')

            $.post('/view/emendasOrcamentarias/call_emendas.php', {
                idemendas: idteme
            }, function(data) {
                var linha = "";

                $.each(JSON.parse(data), function(index, value) {

                    linha += "<tr>";
                    linha += "<td><a href='./../../" + value["arquivo_caminho"] + "' target='_blank'>" + value["nome_arquivo"] + "</a></td>";
                    linha += "<td><button class=\"btn btn-danger\" type=\"button\" data-toggle=\"modal\" data-target=\"#modalExcluirAnexo\" data-nome=" + value["nome_arquivo"] + " data-caminho_arquivo=" + value["arquivo_caminho"] + " data-idteme=" + value["idarquivos"] + "><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button></td>";
                    linha += "</tr>";

                });

                if (linha != "") {
                    $("#tabela_arquivos tbody").html(linha);
                } else {
                    $("#tabela_arquivos tbody").html("Nenhum documento cadastrado.");
                }

            });

        });

        $('#modalEdicao').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // data parametros
            var idteme = button.data('idteme')
            var tipo_emenda = button.data('tipo_emenda')
            var numDoc = button.data('numdoc')
            var solicitante = button.data('solicitante')
            var valor = button.data('valor')
            var beneficiario = button.data('beneficiario')
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
            modal.find('#tipo_emenda').val(tipo_emenda);
            modal.find('#documento').val(numDoc);
            modal.find('#solicitante').val(solicitante);
            modal.find('#valor').val(valor);
            modal.find('#beneficiario').val(beneficiario);
            modal.find('#cidade').val(cidade);
            modal.find(`#nomeContato`).val(nomeContato);

            modal.find('#titulo').val(titulo);
            var dataFormatada = dataDoc.split('/').reverse().join('-');
            modal.find('#dataDocumento').val(dataFormatada);
            modal.find('#descricao').val(descricao);
            modal.find('#tipo').val(tipo);
            modal.find('#idteme').val(idteme);

            modal.find('#status option[value=' + status + ']').attr('selected', 'selected');

            $.post('/view/emendasOrcamentarias/call_comentarios_emendas.php', {
                idemendas: idteme
            }, function(data) {
                var linha = "";

                $.each(JSON.parse(data), function(index, value) {
                    linha += "<tr>";
                    linha += "<td><label>" + formatDate(value["data"]) + "</label></td>";
                    linha += "<td><label>" + value["comentario"] + "</label></td>";
                    linha += "<td><button class=\"btn btn-danger\" type=\"button\" data-toggle=\"modal\" data-target=\"#modalExcluirComentario\" data-idteme=" + value["idt_comentarios_emendas"] + "> <i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button></td>";
                    linha += "</tr>";
                });

                $('#tabela_comentarios tbody').html(linha);
            });

            $('#modalExcluirComentario').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)

                var idteme = button.data('idteme')

                $('#formularioExcluir .modal-body').html(`
                    <label id="texto_excluir"></label>
                    <input type="hidden" id="idteme" name="idteme">
                  
                `);


                var modal = $(this)
                modal.find('.modal-title').text('Confirmar exclusão')
                modal.find('#texto_excluir').text("Tem certeza que deseja excluir o comentario do sistema ?")

                modal.find('#idteme').val(idteme);

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

        $('#modalExcluirAnexo').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget)

            var caminho = button.data('caminho_arquivo')
            var nome = button.data('nome')
            var idteme = button.data('idteme')

            var modal = $(this)
            modal.find('.modal-title').text('Confirmar exclusão')
            modal.find('#texto_excluir').text("Tem certeza que deseja excluir o arquivo do sistema ?")
            modal.find('#caminho_arquivo').val(caminho);
            modal.find('#idteme').val(idteme);

        });

        $('#modalExcluir').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // Extract info from data-* attributes
            var idteme = button.data('idteme')
            var numDoc = button.data('numdoc');
            var idtArq = button.data('fkrequerimentos0')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            // console.log(idteme);
            $('#formularioExcluir .modal-body').html(`
                    <label id="texto_excluir"></label>
                    <input type="hidden" id="idteme" name="idteme">

                    
                `);

            //  console.log(idtArq)
            var modal = $(this)
            modal.find('.modal-title').text('Confirmar exclusão')
            modal.find('#texto_excluir').text("Tem certeza que deseja excluir a emenda orçamentaria do sistema ?")

            // modal.find('#idteme').val(numdoc);
            modal.find('#idteme').val(idteme);

        });
        
    </script>
</body>

</html>