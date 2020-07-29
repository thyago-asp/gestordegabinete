<?php
session_start();
//require_once("../../estrutura/controleLogin.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerEmendasOrcamentarias.php');
$status = "";
if (isset($_REQUEST["id"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.

    $idCidade = $_REQUEST["id"];

    // echo $idCidade;
}
if (isset($_REQUEST["cad"])) {
    $status = $_REQUEST["cad"];
}
if (isset($_REQUEST["r"])) {
    $status = $_REQUEST["r"];
}


?>
<!DOCTYPE html>

<html lang="pt">

<?php
$pagina = "sub3";
include '../../../estrutura/head.php';
?>

<body id="page-top">
    <div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog" aria-labelledby="modalRegistrar" aria-hidden="true">
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
                    <?php if ($status == "sucesso") : ?>
                        <div class="alert alert-success text-center" role="alert">
                            Registro de data salvo com sucesso.
                        </div>
                    <?php elseif ($status == "erro") : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Erro no registro verifique os campos!</strong>
                        </div>
                    <?php elseif ($status == "comentarioSucesso") : ?>
                        <div class="alert alert-success text-center" role="alert">
                            Comentario adicionado com sucesso
                        </div>
                    <?php endif; ?>
                    <?php
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
                        <div class="row">


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
                            <div class="col-lg-6">
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
                                                    <table class="table">
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
                                                                        <td class="font_cidades"><?php echo $listaRecursos[$j]->numDoc ?></td>
                                                                        <td class="font_cidades"><?php echo $listaRecursos[$j]->beneficiario ?></td>
                                                                        <td class="font_cidades">R$ <?php echo number_format($listaRecursos[$j]->valor, 2, ",", "."); ?></td>
                                                                        <td class="font_cidades"><?php echo $listaRecursos[$j]->titulo ?></td>
                                                                        <td class="font_cidades"><?php echo $listaRecursos[$j]->status?></td>
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
                                                    Comentarios
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
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                                <hr />
                                                <form method="post" action="/controller/ControllerEmendasOrcamentarias.php?acao=comentario">
                                                    <input type="hidden" name="idEmenda" value="<?php echo $idCidade ?>">
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
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#modalRegistrar" data-cidade="<?php echo $idCidade ?>" id="registrarVisita"> Registrar visita</button>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="titulo-data-visita">Data de visita</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($j = 0; $j < count($listaVisitas); $j++) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo date('d-m-Y', strtotime($listaVisitas[$j]->data)) ?></td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header cartao-recursos texto-cartao-recursos">
                                            Estrutura do Partido - PSL
                                        </div>

                                        <ul class="list-group list-group-flush">
                                            <!--<li class="list-group-item"><label class="descricao">Presidente: </label> <?php echo " ", $estruturaPartido[0]->presidente ?></li>
                                            <li class="list-group-item"><label class="descricao">Vice-presidente: </label><?php echo " ", $estruturaPartido[0]->vice_presidente ?></li>
                                            <li class="list-group-item"><label class="descricao">Secretário: </label><?php echo " ", $estruturaPartido[0]->secretario ?></li>
                                            <li class="list-group-item"><label class="descricao">2° Secretário: </label><?php echo " ", $estruturaPartido[0]->segundo_secretario ?></li>
                                            <li class="list-group-item"><label class="descricao">Tesoureiro: </label><?php echo " ", $estruturaPartido[0]->tesoureiro ?></li>
                                            <li class="list-group-item"><label class="descricao">2° Tesoureiro: </label><?php echo " ", $estruturaPartido[0]->segundo_tesoureiro ?></li>
                                            <li class="list-group-item"><label class="descricao">Vogal: </label><?php echo " ", $estruturaPartido[0]->vogal ?></li>
                                            <li class="list-group-item"><label class="descricao">Tel. do Presidente: </label><?php echo " ", $estruturaPartido[0]->contato_presidente ?></li>-->

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
                            </div>
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
    </script>

</body>

</html>