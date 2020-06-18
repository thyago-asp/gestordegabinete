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


                                for ($i = 0; $i < count($listaRecursos); $i++) {

                                    $listaItensRecursos = $emendas->buscarItensRecursos($listaRecursos[$i]->idt_recursos);
                                    $valorTotal = 0;
                                    for ($k = 0; $k < count($listaItensRecursos); $k++) {
                                        $valorTotal = $valorTotal + $listaItensRecursos[$k]->valor;
                                    }
                                    // print_r($listaItensRecursos);
                                ?> <div id="accordion">
                                        <div class="card card_accordion">
                                            <div class="card-header cartao-recursos" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link texto-cartao-recursos" data-toggle="collapse" data-target="#collapse<?php echo $listaRecursos[$i]->ano ?>" aria-expanded="true" aria-controls="collapseOne">
                                                        Recursos - <?php echo $listaRecursos[$i]->ano ?> - <?php echo " R$ ", number_format($valorTotal, 2, ",", "."); ?>
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapse<?php echo $listaRecursos[$i]->ano ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Tipo</th>
                                                                <th scope="col">Destino</th>
                                                                <th scope="col">Protcolo</th>
                                                                <th scope="col">Valor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            for ($j = 0; $j < count($listaItensRecursos); $j++) {
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $listaItensRecursos[$j]->tipo ?></th>
                                                                    <td><?php echo $listaItensRecursos[$j]->destino ?></td>
                                                                    <td><?php echo $listaItensRecursos[$j]->protocolo ?></td>
                                                                    <td>R$ <?php echo number_format($listaItensRecursos[$j]->valor, 2, ",", "."); ?></td>
                                                                </tr>
                                                            <?php
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
                                                <td style="text-align: center"><?php echo $listaVisitas[$j]->data ?></td>

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
                                            <li class="list-group-item"><label class="descricao">Presidente: </label> <?php echo " ", $estruturaPartido[0]->presidente ?></li>
                                            <li class="list-group-item"><label class="descricao">Vice-presidente: </label><?php echo " ", $estruturaPartido[0]->vice_presidente ?></li>
                                            <li class="list-group-item"><label class="descricao">Secretário: </label><?php echo " ", $estruturaPartido[0]->secretario ?></li>
                                            <li class="list-group-item"><label class="descricao">2° Secretário: </label><?php echo " ", $estruturaPartido[0]->segundo_secretario ?></li>
                                            <li class="list-group-item"><label class="descricao">Tesoureiro: </label><?php echo " ", $estruturaPartido[0]->tesoureiro ?></li>
                                            <li class="list-group-item"><label class="descricao">2° Tesoureiro: </label><?php echo " ", $estruturaPartido[0]->segundo_tesoureiro ?></li>
                                            <li class="list-group-item"><label class="descricao">Vogal: </label><?php echo " ", $estruturaPartido[0]->vogal ?></li>
                                            <li class="list-group-item"><label class="descricao">Tel. do Presidente: </label><?php echo " ", $estruturaPartido[0]->contato_presidente ?></li>
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
        $("#modalRegistrar").on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // Extract info from data-* attributes
            var idCidade = button.data('cidade')


            $("#idCidadeHidden").val(idCidade);


        });
    </script>

</body>

</html>