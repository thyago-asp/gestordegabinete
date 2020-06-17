<?php
session_start();
//require_once("../../estrutura/controleLogin.php");
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerEmendasOrcamentarias.php');

if (isset($_REQUEST["id"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.

    $idCidade = $_REQUEST["id"];

    echo $idCidade;
}
?>
<!DOCTYPE html>

<html lang="pt">

<?php
$pagina = "sub3";
include '../../../estrutura/head.php';
?>

<body id="page-top">


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
                                                            <label  class="descricao">População: </label> <?php echo $listaCidades[0]->populacao; ?>
                                                            <label  class="descricao">Eleitores: </label> <?php echo $listaCidades[0]->eleitores; ?><br />
                                                        </li>

                                                        <li class="list-group-item">
                                                            <label  class="descricao">Votos 2018: </label> <?php echo $listaCidades[0]->votos2018; ?>
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
                                                        Recursos - <?php echo $listaRecursos[$i]->ano ?> - <?php echo " R$ ",$valorTotal ?>
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
                                                                    <td>R$ <?php echo $listaItensRecursos[$j]->tipo ?></th>
                                                                    <td>R$ <?php echo $listaItensRecursos[$j]->destino ?></td>
                                                                    <td>R$ <?php echo $listaItensRecursos[$j]->protocolo ?></td>
                                                                    <td>R$ <?php echo $listaItensRecursos[$j]->valor ?></td>
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="titulo-data-visita">Data de visita</th>

                                        </tr>
                                    </thead>
                                    <tbody >
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
                                            Estrutura do partido
                                        </div>

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><label class="descricao">Presidente: </label> <?php echo " " , $estruturaPartido[0]->presidente ?></li>
                                            <li class="list-group-item"><label class="descricao">Vice-presidente: </label><?php echo " " , $estruturaPartido[0]->vice_presidente ?></li>
                                            <li class="list-group-item"><label class="descricao">Secretário: </label><?php echo " " ,$estruturaPartido[0]->secretario ?></li>
                                            <li class="list-group-item"><label class="descricao">2° Secretário: </label><?php echo " " ,$estruturaPartido[0]->segundo_secretario ?></li>
                                            <li class="list-group-item"><label class="descricao">Tesoureiro: </label><?php echo " " ,$estruturaPartido[0]->tesoureiro ?></li>
                                            <li class="list-group-item"><label class="descricao">2° Tesoureiro: </label><?php echo " " ,$estruturaPartido[0]->segundo_tesoureiro ?></li>
                                            <li class="list-group-item"><label class="descricao">Vogal: </label><?php echo " " ,$estruturaPartido[0]->vogal ?></li>
                                            <li class="list-group-item"><label class="descricao">Tel. do Presidente: </label><?php echo " " ,$estruturaPartido[0]->contato_presidente ?></li>
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


</body>

</html>