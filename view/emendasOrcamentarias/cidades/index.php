<?php
session_start();
//require_once("../../../estrutura/controleLogin.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerEmendasOrcamentarias.php');
$status = "";
$idCidade = "";
if (isset($_REQUEST["id"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
    $idCidade = $_REQUEST["id"];
}
if (isset($_REQUEST["cad"])) {
    $status = $_REQUEST["cad"];
}
if (isset($_REQUEST["r"])) {
    $status = $_REQUEST["r"];
}

if (isset($_GET["excluirVisita"])) {
    $status = $_GET["excluirVisita"];
}

?>
<!DOCTYPE html>

<html lang="pt">

<?php
$pagina = "sub3";
include '../../../estrutura/head.php';
?>

<body id="page-top">
    <!-- <div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog" aria-labelledby="modalRegistrar" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalRegistrarLabel">Registrar visita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerEmendasOrcamentarias.php?acao=registrarVisita" id="formularioExcluir" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="idCidadeHidden" id="idCidadeHidden">
                        <div class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label">Date</label>
                            <div class="col-10">
                                <input class="form-control" type="date" value="" name="idDataVisita" id="idDataVisita" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <div class="modal fade" id="modalExcluirVisita" tabindex="-1" role="dialog" aria-labelledby="modalExcluirVisita" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirVisitaLabel">Excluir comentario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerEmendasOrcamentarias.php?acao=deletarVisita" id="formularioExcluir" method="post">
                    <div class="modal-body">

                        <input type="hidden" name="idCidadeRegistro" id="idCidadeRegistro" />
                        <input type="hidden" name="idVisitaHidden" id="idVisitaHidden" />
                        <div class="form-group row">
                            <label>Tem certeza que deseja excluir o comentario ?</label>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                                    <input type="text" class="form-control" name="valor" id="valor">
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

                    </div>
                </form>
            </div>
        </div>
    </div>
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
                    <?php  if ($status == "erro") { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro no registro verifique os campos!</strong>
                        </div>
                    <?php } else if ($status == "comentarioSucesso") { ?>
                        <div class="alert alert-success text-center" role="alert">
                        Comentário adicionado com sucesso
                        </div>
                    <?php } else if ($status == "sucesso") {
                    ?>

                        <div class="alert alert-success text-center" role="alert">
                            Comentário excluido com sucesso
                        </div>

                    <?php
                    }




                    $emendas = new ControllerEmendasOrcamentarias();

                    $listaCidades = $emendas->buscarCidades($idCidade);
                    $listaRecursos = $emendas->buscarRecursos($idCidade);
                    $listaVisitas = $emendas->buscarVisitas($idCidade);
                    $estruturaPartido = $emendas->buscarEstruturaPartido($idCidade);

                    if (!empty($listaCidades)) {
                    ?>
                        <div id="pagina" class="card-header text-center h5">
                            <h5 class="nome_cidade"><?php echo $listaCidades[0]->cidade ?></h5>
                            <label id="campo_regiao"><?php echo $listaCidades[0]->regiao; ?></label> </br>
                            <label id="distancia_capital">Distância da capital: </label> <?php echo $listaCidades[0]->distancia_capital; ?> Km
                        </div>
                        <div class="row mt-10">


                            <div class="col col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <label class="descricao">Prefeito: </label> <?php echo $listaCidades[0]->prefeito; ?><br />
                                                        </li>
                                                        <li class="list-group-item"><label class="descricao">Vice-prefeito: </label> <?php echo $listaCidades[0]->vice_prefeito; ?><br />
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <label class="descricao">População: </label> <?php echo $listaCidades[0]->populacao; ?>
                                                            <label class="descricao">Eleitores: </label> <?php echo $listaCidades[0]->eleitores; ?><br />
                                                        </li>

                                                        <li class="list-group-item">
                                                            <label class="descricao">Votos 2018: </label> <?php echo $listaCidades[0]->votos2018; ?>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-lg-12">
                                <?php
                                //Busco quais são os anos que estão nos registros das emendas dessa cidade
                                $listaAnosRegistrados = array();
                                for ($i = 0; $i < count($listaRecursos); $i++) {
                                    $listaAnosRegistrados[] = explode("-", $listaRecursos[$i]->data_cad_doc)[0];
                                }

                                // Tiramos os anos repedidos e com a função array_values regulariazamos os 
                                // index da lista
                                $anos = array_values(array_unique($listaAnosRegistrados));
                                arsort($anos);
                                // Para cada ano  teremos um accordion
                                for ($i = 0; $i < count($anos); $i++) {
                                    $ano = array_values($anos)[$i];

                                    // Verifico quanto que deu o total de recursos para o ano.
                                    $valorTotal = 0;
                                    for ($k = 0; $k < count($listaRecursos); $k++) {
                                        if ($ano == explode("-", $listaRecursos[$k]->data_cad_doc)[0]) {
                                            $valorTotal = $valorTotal + $listaRecursos[$k]->valor;
                                        }
                                    }

                                ?> <div id="accordion">
                                        <div class="card card_accordion">
                                            <div class="card-header cartao-recursos" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link texto-cartao-recursos" data-toggle="collapse" data-target="#collapse<?php echo $ano ?>" aria-expanded="true" aria-controls="collapseOne">
                                                        Recursos - <?php echo $ano ?> - <?php echo " R$ ", number_format($valorTotal, 2, ",", "."); ?>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse<?php echo $ano ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="font_titulo_cidades" scope="col">Tipo</th>
                                                                <th class="font_titulo_cidades" scope="col">Protocolo</th>
                                                                <th class="font_titulo_cidades" scope="col">Destino</th>
                                                                <th class="font_titulo_cidades" scope="col">Valor</th>
                                                                <th class="font_titulo_cidades" scope="col">Assunto</th>
                                                                <th class="font_titulo_cidades" scope="col">Status</th>
                                                                <th class="font_titulo_cidades" scope="col">Data</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            // Percorremos todos os recursos cadastrados, e com isso, separamos os recursos 
                                                            // do no especifico do laço atual.
                                                            for ($j = 0; $j < count($listaRecursos); $j++) {
                                                                if ($ano == explode("-", $listaRecursos[$j]->data_cad_doc)[0]) {

                                                                    switch ($listaRecursos[$j]->tipo_emenda) {
                                                                        case "emenda_federal":
                                                                            $tipo_emenda = "Emenda Federal";
                                                                            break;
                                                                        case "emenda_estadual":
                                                                            $tipo_emenda = "Emenda Estadual";
                                                                            break;
                                                                        case "emenda_municipal":
                                                                            $tipo_emenda = "Emenda Municipal";
                                                                            break;
                                                                    }
                                                            ?>
                                                                    <tr>
                                                                        <td class="font_cidades"><?php echo $tipo_emenda ?></th>
                                                                        <td class="font_cidades"><button class="btn font_titulo_cidades" type="button" data-toggle="modal" data-target="#modalEdicao" data-idteme="<?php echo $listaRecursos[$j]->idt_emendas ?>" data-tipo_emenda="<?php echo $listaRecursos[$j]->tipo_emenda ?>" data-numDoc="<?php echo $listaRecursos[$j]->numDoc ?>" data-solicitante="<?php echo $listaRecursos[$j]->solicitante ?>" data-beneficiario="<?php echo $listaRecursos[$j]->beneficiario ?>" data-cidade="<?php echo $listaRecursos[$j]->t_emendas_orcamentarias_idt_emendas_orcamentarias ?>" data-nomeContato="<?php echo $listaRecursos[$j]->nome_de_contato ?>" data-dataDoc="<?php echo $listaRecursos[$j]->data_cad_doc ?>" data-tipo="<?php echo $listaRecursos[$j]->tipo ?>" data-titulo="<?php echo $listaRecursos[$j]->titulo ?>" data-descricao="<?php echo $listaRecursos[$j]->descricao ?>" data-status="<?php echo $listaRecursos[$j]->status ?>" data-valor="<?php echo $listaRecursos[$j]->valor ?>"><?php echo $listaRecursos[$j]->numDoc ?></button></td>
                                                                        <td class="font_cidades"><?php echo $listaRecursos[$j]->beneficiario ?></td>
                                                                        <td class="font_cidades">R$ <?php echo number_format($listaRecursos[$j]->valor, 2, ",", "."); ?></td>
                                                                        <td class="font_cidades"><?php echo $listaRecursos[$j]->titulo ?></td>
                                                                        <td class="font_cidades"><?php echo $listaRecursos[$j]->status ?></td>
                                                                        <td class="font_cidades"><?php echo $listaRecursos[$j]->data_cad_doc ?></td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php


                                }

                                ?>
                                <div id="accordion">
                                    <div class="card card_accordion">
                                        <div class="card-header cartao-recursos" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link texto-cartao-recursos" data-toggle="collapse" data-target="#collapseComentario" aria-expanded="true" aria-controls="collapseOne">
                                                    Visitas
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseComentario" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Data</th>
                                                            <th>Comentario</th>
                                                            <th>Excluir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $emendas = new ControllerEmendasOrcamentarias();

                                                        $lista = $emendas->listarComentarios($idCidade);

                                                        for ($i = 0; $i < sizeof($lista); $i++) {
                                                        ?>
                                                            <tr>
                                                                <td><label><?php echo date('d-m-Y', strtotime($lista[$i]["data"])) ?></label></td>


                                                                <td><label><?php echo $lista[$i]["comentario"] ?></label></td>

                                                                <td><button class="btn font_titulo_cidades" type="button" data-toggle="modal" data-target="#modalExcluirVisita" data-idvisita="<?php echo $lista[$i]["idt_comentarios_emenda"] ?>" data-idcidade="<?php echo $idCidade ?>"> <i class="fa fa-trash " style="color: red" aria-hidden="true"></i></button></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                                <hr />
                                                <label class="b">Registrar visita</label>
                                                <hr />
                                                <form method="post" action="/controller/ControllerEmendasOrcamentarias.php?acao=comentario">
                                                    <input type="hidden" name="idEmenda" value="<?php echo $idCidade ?>">
                                                    <div class="form-group row">
                                                        <label for="example-date-input" class="col-4 col-form-label">Data da visita</label>
                                                        <div class="col-8">
                                                            <input class="form-control" type="date" value="" name="idDataVisita" id="idDataVisita" required>
                                                        </div>
                                                    </div>
                                                    <label class="form-label">Adicionar um comentario</label>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-cadastrar">Adicionar comentario</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <form action="" method="post">
                                    <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#modalRegistrar" data-cidade="<?php echo $idCidade ?>" id="registrarVisita"> Registrar visita</button>
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th class="titulo-data-visita font_titulo_cidades">Data de visita</th>
                                                <th class="titulo-data-visita font_titulo_cidades">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            for ($j = 0; $j < count($listaVisitas); $j++) {
                                            ?>
                                                <tr>
                                                    <td class="font_cidades" style="text-align: center"><?php echo date('d-m-Y', strtotime($listaVisitas[$j]->data)) ?> </td>
                                                    <td><button class="btn font_titulo_cidades" type="button" data-toggle="modal" data-target="#modalExcluirVisita" data-idvisita="<?php echo $listaVisitas[$j]->idt_visita_cidade ?>" data-idcidade="<?php echo $listaVisitas[$j]->t_emendas_orcamentarias_idt_emendas_orcamentarias ?>"> <i class="fa fa-trash " style="color: red" aria-hidden="true"></i></button></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div> -->
                            <!-- <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header cartao-recursos texto-cartao-recursos">
                                            Estrutura do Partido - PSL
                                        </div>

                                        <ul class="list-group list-group-flush"> -->
                            <!--<li class="list-group-item"><label class="descricao">Presidente: </label> <?php echo " ", $estruturaPartido[0]->presidente ?></li>
                                            <li class="list-group-item"><label class="descricao">Vice-presidente: </label><?php echo " ", $estruturaPartido[0]->vice_presidente ?></li>
                                            <li class="list-group-item"><label class="descricao">Secretário: </label><?php echo " ", $estruturaPartido[0]->secretario ?></li>
                                            <li class="list-group-item"><label class="descricao">2° Secretário: </label><?php echo " ", $estruturaPartido[0]->segundo_secretario ?></li>
                                            <li class="list-group-item"><label class="descricao">Tesoureiro: </label><?php echo " ", $estruturaPartido[0]->tesoureiro ?></li>
                                            <li class="list-group-item"><label class="descricao">2° Tesoureiro: </label><?php echo " ", $estruturaPartido[0]->segundo_tesoureiro ?></li>
                                            <li class="list-group-item"><label class="descricao">Vogal: </label><?php echo " ", $estruturaPartido[0]->vogal ?></li>
                                            <li class="list-group-item"><label class="descricao">Tel. do Presidente: </label><?php echo " ", $estruturaPartido[0]->contato_presidente ?></li>-->
                            <!-- 
                                            <li class="list-group-item"><label class="descricao">Presidente: </label> </li>
                                            <li class="list-group-item"><label class="descricao">Vice-presidente: </label></li>
                                            <li class="list-group-item"><label class="descricao">Secretário: </label></li>
                                            <li class="list-group-item"><label class="descricao">2° Secretário: </label></li>
                                            <li class="list-group-item"><label class="descricao">Tesoureiro: </label></li>
                                            <li class="list-group-item"><label class="descricao">2° Tesoureiro: </label></li>
                                            <li class="list-group-item"><label class="descricao">Vogal: </label></li>
                                            <li class="list-group-item"><label class="descricao">Tel. do Presidente: </label></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                </div>
            <?php

                    } else {
            ?>

                <button type="button" class="btn btn-success">Voltar para página de cidades</button>
            <?php
                    }
            ?>
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
    <script>
        $("#idDataVisita").on('click', () => {
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
            $("#idDataVisita").val(data);
        });

        $("#modalRegistrar").on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // Extract info from data-* attributes
            var idCidade = button.data('cidade')


            $("#idCidadeHidden").val(idCidade);


        });

        $("#modalExcluirVisita").on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // Extract info from data-* attributes
            var idvisita = button.data('idvisita')
            var idcidade = button.data('idcidade')

            $("#idVisitaHidden").val(idvisita)
            $("#idCidadeRegistro").val(idcidade)

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
            var valorNovo = valor.toLocaleString('pt-br', {
                minimumFractionDigits: 2
            })

            // seta os valores do modal
            modal.find('#tipo_emenda').val(tipo_emenda);
            modal.find('#documento').val(numDoc);
            modal.find('#solicitante').val(solicitante);
            modal.find('#valor').val(valorNovo);
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
                    linha += "</tr>";
                });

                $('#tabela_comentarios tbody').html(linha);
            });
        });

        function number_format(number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
    </script>

</body>

</html>