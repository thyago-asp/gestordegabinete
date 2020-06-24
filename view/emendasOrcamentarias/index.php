<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerEmendasOrcamentarias.php');
//require_once("../../estrutura/controleLogin.php");
$primeiro_acesso = "";
$retorno_alterarSenha = "";
// caso a senha do usuario seja resetada ou seja o seu primeiro acesso. 
// marcamos a variavel como verdadeira(1) para que o modalPrimeiroAcesso seja chamado
// e o usuario mude a sua senha. 

if (isset($_SESSION["primeiro_acesso"])) {
    if ($_SESSION["primeiro_acesso"] == 1) {
        $primeiro_acesso = "1";
    }
}

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
    // 1 = sucesso.
    if ($_REQUEST["r"] == "1") {
        $retorno_alterarSenha = "sucesso";
    }
}
?>
<!DOCTYPE html>

<html lang="pt">

<?php
$pagina = "sub";
include '../../estrutura/head.php';
?>

<body id="page-top">


    <!-- Modal -->
    <div class="modal fade" id="modalPrimeiroAcesso" tabindex="-1" role="dialog" aria-labelledby="modalPrimeiroAcessoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPrimeiroAcessoLabel">Atualizar a senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerUsuario.php?acao=alterarSenha" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="senha">Nova senha</label>
                            <input type="password" class="form-control" name="senha1" id="senha1" onkeyup="validarSenha()">
                        </div>
                        <div class="form-group">
                            <label for="">Repita a nova senha</label>
                            <input type="password" class="form-control" name="senha2" id="senha2" onkeyup="validarSenha()">
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" id="btn_salvarSenha" name="btn_salvarSenha">Salvar senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include '../../estrutura/menulateral.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <?php
                include '../../estrutura/barratopo.php';
                ?>


                <?php
                $emendas = new ControllerEmendasOrcamentarias();

                $listaEmendas = $emendas->listarCidades();

                ?>
                <!-- CONTEUDO PRINCIPAL DA PAGINA -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Pesquise a cidade: </span>
                                </div>
                                <input type="text" class="form-control" id="campo_cidade" aria-describedby="basic-addon1">
                            </div>
                            <div id="cidadesEncontradas"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div id="accordion">
                                <div class="card card_accordion">
                                    <div class="card-header cartao-recursos" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link texto-cartao-recursos" data-toggle="collapse" data-target="#collapseNoroeste" aria-expanded="true" aria-controls="collapseOne">
                                                Noroeste
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseNoroeste" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <?php
                                                    foreach ($listaEmendas as $cidade) {
                                                        if (trim($cidade->regiao) == "Noroeste") {
                                                    ?>
                                                            <a href="/view/emendasOrcamentarias/cidades/?id=<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></a> <br />
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card_accordion">
                                    <div class="card-header cartao-recursos" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed texto-cartao-recursos" data-toggle="collapse" data-target="#collapseOeste" aria-expanded="false" aria-controls="collapseOeste">
                                                Oeste
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOeste" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <?php
                                                    foreach ($listaEmendas as $cidade) {
                                                        if (trim($cidade->regiao) == "Oeste") {
                                                    ?>
                                                            <a href="/view/emendasOrcamentarias/cidades/?id=<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></a> <br />
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card_accordion">
                                    <div class="card-header cartao-recursos" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed texto-cartao-recursos" data-toggle="collapse" data-target="#collapseSudoeste" aria-expanded="false" aria-controls="collapseSudoeste">
                                                Sudoeste
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseSudoeste" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <?php
                                                    foreach ($listaEmendas as $cidade) {
                                                        if (trim($cidade->regiao) == "Sudoeste") {
                                                    ?>
                                                            <a href="/view/emendasOrcamentarias/cidades/?id=<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></a> <br />
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card_accordion">
                                    <div class="card-header cartao-recursos" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed texto-cartao-recursos" data-toggle="collapse" data-target="#collapseSudeste" aria-expanded="false" aria-controls="collapseSudeste">
                                                Sudeste
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseSudeste" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <?php
                                                    foreach ($listaEmendas as $cidade) {
                                                        if (trim($cidade->regiao) == "Sudeste") {
                                                    ?>
                                                            <a href="/view/emendasOrcamentarias/cidades/?id=<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></a> <br />
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div id="accordion">
                                <div class="card card_accordion">
                                    <div class="card-header cartao-recursos" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link texto-cartao-recursos" data-toggle="collapse" data-target="#collapseNorte" aria-expanded="true" aria-controls="collapseNorte">
                                                Norte pioneiro
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseNorte" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <?php
                                                    foreach ($listaEmendas as $cidade) {
                                                        if (trim($cidade->regiao) == "Norte Pioneiro") {
                                                    ?>
                                                            <a href="/view/emendasOrcamentarias/cidades/?id=<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></a> <br />
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card_accordion">
                                    <div class="card-header cartao-recursos" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed texto-cartao-recursos" data-toggle="collapse" data-target="#collapseCentro" aria-expanded="false" aria-controls="collapseCentro">
                                                Centro ocidental
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseCentro" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <?php
                                                    foreach ($listaEmendas as $cidade) {
                                                        if (trim($cidade->regiao) == "Centro ocidental") {
                                                    ?>
                                                            <a href="/view/emendasOrcamentarias/cidades/?id=<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></a> <br />
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card_accordion">
                                    <div class="card-header cartao-recursos" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed texto-cartao-recursos" data-toggle="collapse" data-target="#collapseCentrosul" aria-expanded="false" aria-controls="collapseCentrosul">
                                                Centro sul
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseCentrosul" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <?php
                                                    foreach ($listaEmendas as $cidade) {
                                                        if (trim($cidade->regiao) == "Centro sul") {
                                                    ?>
                                                            <a href="/view/emendasOrcamentarias/cidades/?id=<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></a> <br />
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card_accordion">
                                    <div class="card-header cartao-recursos" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed texto-cartao-recursos" data-toggle="collapse" data-target="#collapseCentroOriental" aria-expanded="false" aria-controls="collapseCentroOriental">
                                                Centro Oriental
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseCentroOriental" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <?php
                                                    foreach ($listaEmendas as $cidade) {
                                                        if (trim($cidade->regiao) == "Centro Oriental") {
                                                    ?>
                                                            <a href="/view/emendasOrcamentarias/cidades/?id=<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></a> <br />
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <div id="accordion">
                                <div class="card card_accordion">
                                    <div class="card-header cartao-recursos" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link texto-cartao-recursos" data-toggle="collapse" data-target="#collapseRegiaoMetropolitana" aria-expanded="true" aria-controls="collapseRegiaoMetropolitana">
                                                Região metropolitana de Curitiba
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseRegiaoMetropolitana" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <?php
                                                    foreach ($listaEmendas as $cidade) {
                                                        if (trim($cidade->regiao) == "Região metropolitana de Curitiba") {
                                                    ?>
                                                            <a href="/view/emendasOrcamentarias/cidades/?id=<?php echo $cidade->idt_emendas_orcamentarias ?>"><?php echo $cidade->cidade ?></a> <br />
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php
                include '../../estrutura/footer.php';
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
        include '../../estrutura/painelLogout.php';
        ?>

        <!-- Bootstrap core JavaScript-->
        <?php
        include '../../estrutura/importJS.php';
        ?>


        <script>
            $('#campo_cidade').on('keyup', function() {
                var cidade = $('#campo_cidade').val();
                if (cidade != "") {
                    $.post('/controller/ControllerEmendasOrcamentarias.php', {
                        acao: "buscarCidade",
                        cidade: "%" + cidade + "%"
                    }, function(event) {
                        var obj1 = JSON.parse(event);

                        if (!isEmpty(obj1)) {
                            var cod = "";
                            cod += "<div class=\"alert alert-info text-center\" role=\"alert\">";
                            cod += "<label style=\"text-align: center\"> <strong>Cidades encontradas</strong></label></br>";
                            obj1.forEach(function(o, index) {

                                var id = o.idt_emendas_orcamentarias;
                                var nomeCidade = o.cidade;
                                cod += "<a href=\" /view/emendasOrcamentarias/cidades/?id=" + id + "   \" > " + nomeCidade + "</a> <br />";

                                cod += "</br>";

                            });
                            cod += "</div>";

                            $("#cidadesEncontradas").html(cod);
                        } else {
                            var cod = "";
                            cod += "<div class=\"alert alert-danger text-center\" role=\"alert\">";
                            cod += "<label style=\"text-align: center\"> <strong>Nenhuma cidade encontrada com \"" + cidade + "\"</strong></label></br>";
                            cod += "</div>";
                            $("#cidadesEncontradas").html(cod);
                        }


                    });
                } else {
                    $("#cidadesEncontradas").html("");
                }
            });


            function isEmpty(obj) {
                for (var prop in obj) {
                    if (obj.hasOwnProperty(prop))
                        return false;
                }

                return true;
            }
        </script>

</body>

</html>