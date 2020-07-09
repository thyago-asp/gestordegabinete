<?php
session_start();
require_once("../../../estrutura/controleLogin.php");
$status = '';
if (isset($_GET['cad'])) {
    $status = $_GET['cad'];
}

?>
<!DOCTYPE html>
<html lang="pt-br">
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
    <div class="modal fade" id="modalTirarFoto" tabindex="-1" role="dialog" aria-labelledby="modalTirarFotoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTirarFotoLabel">Tirar foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" enctype="multipart/form-data" id="formularioEnviar" method="post">
                    <div class="modal-body">
                        <div class="area">
                            <video autoplay="true" id="webCamera">
                            </video>

                            <input type="hidden" id="base_img" name="base_img" />
                            <button type="button" onclick="takeSnapShot()">Tirar foto e salvar</button>

                            <img id="imagemConvertida" />

                        </div>


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
        <?php include '../../../estrutura/menulateral.php'; ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include '../../../estrutura/barratopo.php'; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid ">
                    <!-- Page Heading -->
                    <div id="pagina" class="card-header text-center">
                        <h3 class="cabecalho_paginas">Cadastrar pessoas</h3>
                    </div>
                </div>
                <?php if ($status == "sucesso") : ?>
                    <div class="alert alert-success text-center" role="alert">
                        Cadastro realizado com sucesso.
                    </div>
                <?php elseif ($status == "erro") : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Erro no cadastro verifique os campos!</strong>
                    </div>
                <?php endif; ?>

                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                    <form id="formF" enctype="multipart/form-data" action="../../../controller/ControllerPessoaFisica.php?acao=cad" method="post">

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header cartao-recursos" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link texto-cartao-recursos" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <!--  <img src="../../../img/ICON PF.png" class="accordion-pessoas" /> -->
                                            <label> Pessoas física </label>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">

                                        <div class="panel-body">
                                            <label class="form-label" for="nome">Nome completo</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" id="nome" class="form-control" name="nome" >

                                                </div>
                                            </div>

                                            <label class="form-label" for="email">Email</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@email.com" >

                                                </div>
                                            </div>
                                            <label class="form-label" for="telefoneF">Telefone(s)</label>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                        <input type="tel" class="form-control" id="telefoneF" maxlength="15" name="telefoneF" placeholder="1° - 00 99999-9999" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                        <input type="tel" class="form-control" id="telefoneF2" maxlength="15" name="telefoneF2" placeholder="2° - 00 99999-9999" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                        <input type="tel" class="form-control" id="telefoneF3" maxlength="15" name="telefoneF3" placeholder="3° - 00 99999-9999" >
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <label class="form-label" for="cpf">CPF</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="tel" class="form-control" id="cpf" placeholder="000.000.000-00" maxlength="14" name="CPF">

                                                </div>
                                            </div>
                                            <label class="form-label">Sexo</label>
                                            <div class="form-group">
                                                <input type="radio" name="sexo" value="masculino" id="male" class="with-gap" >
                                                <label for="male">Masculino</label>
                                                <input type="radio" name="sexo" value="feminino" id="female" class="with-gap">
                                                <label for="female" class="m-l-20">Feminino</label>
                                            </div>
                                            <label class="form-label" for="nascimento">Data de nascimento</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="date" class="form-control date" id="nascimento" name="nascimento" placeholder="Ex: 30/07/2016">
                                                </div>
                                            </div>
                                            <label class="form-label" for="cepF">Endereço</label>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="tel" id="cepF" name="cep" class="form-control" placeholder="Cep">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="logradouro" id="logradouroF" placeholder="Logradouro">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="tel" id="numeroF" name="numeroF" class="form-control" placeholder="N°">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="complemento" placeholder="Complemento">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="bairroF" name="bairroF" class="form-control" placeholder="Bairro">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="cidadeF" name="cidadeF" class="form-control" placeholder="Cidade">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="ufF" name="estado" class="form-control" placeholder="Estado">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <label class="form-label" for="categoria">Categoria</label>
                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <select name="categoria" id="categoria" class="form-control show-tick ">
                                                        <option value="">-- Selecione uma categoria --</option>
                                                        <option value="dep.estadual">Deputados estadual</option>
                                                        <option value="dep.federal">Deputado federal</option>
                                                        <option value="sec.estado">Secretário do estado</option>
                                                        <option value="familia">Família</option>
                                                        <option value="lideranca">Liderança</option>
                                                        <option value="geral">Geral</option>
                                                        <option value="prefeito">Prefeito</option>
                                                        <option value="vereador">Vereador</option>
                                                    </select>
                                                </div>

                                            </div>


                                            <br>
                                            <div class="card">
                                                <div class="card-header">
                                                    Registrar imagem da pessoa
                                                </div>
                                                <div class="card-body text-white bg-secondary text-center">
                                                    <img id="imagemConvertidaSalva" width="200px" />
                                                    <button type="button" class="btn btn-warning w-100" data-toggle="modal" data-target="#modalTirarFoto">
                                                        Registrar pela câmera
                                                    </button>
                                                    <input type="hidden" id="caminhoDaFotoTirada" name="caminhoDaFotoTirada" />
                                                </div>
                                            </div>

                                        </div>
                                        <input type="submit" class="btn btn-primary btn-cadastrar" value="Cadastrar">

                                    </div>

                                </div>

                            </div>
                        </div>

                    </form>
                    <form method="POST" id="formJ" action="../../../controller/ControllerPessoaJuridica.php?acao=cad">
                        <div class="card">
                            <div class="card-header cartao-recursos" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed text-center texto-cartao-recursos" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <!--<img src="../../../img/ICON PJ.png" class="accordion-pessoas" />-->
                                        <label> Pessoa juridica </label>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="panel-body">


                                        <label class="form-label" for="cnpj">CNPJ</label>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="tel" id="cnpj" name="cnpj" class="form-control" placeholder="CNPJ">
                                                </div>
                                            </div>
                                        </div>
                                        <label class="form-label" for="nomeJ">Nome</label>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="tel" id="nomeJ" name="nomeJ" class="form-control" placeholder="Nome">
                                                </div>
                                            </div>
                                        </div>

                                        <label class="form-label" for="fantasiaJ">Nome Fantasia</label>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="fantasiaJ" name="fantasiaJ" class="form-control" placeholder="Nome Fantasia">
                                                </div>
                                            </div>

                                        </div>
                                        <label class="form-label" for="emailJ">E-mail</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="email" class="form-control" name="emailJ" id="emailJ"  placeholder="exemplo@email.com">

                                            </div>
                                        </div>
                                        <label class="form-label" for="telefoneJ">Telefone</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="telefoneJ" id="telefoneJ" maxlength="15"  placeholder="00 9999-9999">

                                            </div>
                                        </div>

                                        <label class="form-label" for="cepJ">Endereço</label>
                                        <div id="endereco">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="tel" id="cepJ" name="cep" maxlength="10" class="form-control" placeholder="Cep">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="logradouroJ" name="logradouroJ" class="form-control" id="logradouroJ" placeholder="Logradouro">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="tel" id="numeroJ" name="numeroJ" class="form-control" placeholder="N°">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="complementoJ" name="complementoJ" class="form-control" placeholder="Complemento">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="bairroJ" name="bairroJ" class="form-control" placeholder="Bairro">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="cidadeJ" name="cidadeJ" class="form-control" placeholder="Cidade">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="estadoJ" name="estadoJ" class="form-control" placeholder="Estado">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="form-label">Atividade</label>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="atividadeJ" name="atividadeJ" class="form-control" placeholder="Atividade">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-cadastrar" value="Cadastrar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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

    <!-- Bootstrap core JavaScript-->
    <?php
    include '../../../estrutura/importJS.php';
    ?>
    <script src="../../../js/jquery.mask.min.js"></script>
    <script>
        
        $('#modalTirarFoto').on('show.bs.modal', function(e) {
            loadCamera();
        });

        $('#modalTirarFoto').on('hidden.bs.modal', function(e) {
            var video = document.querySelector("#webCamera");
            //As opções abaixo são necessárias para o funcionamento correto no iOS
            video.setAttribute('autoplay', 'false');
        });

        $(document).ready(() => {

            $('#imagemPF').on('change', function() {
                var nomeArq = $(this)[0].files[0].name;

                $('#nomeArq').text(nomeArq);
            });
            // let a = $("#imagemPF").change().val();
            // console.log(a);
            $("#telefoneF").mask('(##)# ####-####');
            $("#telefoneF2").mask('(##)# ####-####');
            $("#telefoneF3").mask('(##)# ####-####');
            $("#cpf").mask("###.###.###-##");
            $("#cepF").mask("#####-###")
            $("#telefoneJ").mask('(##)# ####-####');
            $("#cepJ").mask('#####-###');
            $("#cepF").blur(function() {
                var cep = $(this).val().replace(/\D/g, "");

                if (cep != "") {
                    console.log(cep);
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                        // console.log(dados);
                        if (!("erro" in dados)) {


                            $('#logradouroF').val(dados.logradouro);
                            // $('#logradouroF').val(dados.bairro);
                            $('#bairroF').val(dados.bairro);
                            $('#cidadeF').val(dados.localidade);
                            $('#ufF').val(dados.uf);

                        }

                    }).fail((e) => {
                        alert("CEP NÃO ENCONTRADO");
                    });

                }

            });

            $("#cepJ").blur(function() {
                var cep = $(this).val().replace(/\D/g, "");

                if (cep != "") {
                  //  console.log(cep);
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {

                            $('#logradouroJ').val(dados.logradouro);
                            $('#bairroJ').val(dados.bairro);
                            $('#cidadeJ').val(dados.localidade);
                            $('#estadoJ').val(dados.uf);

                        }



                    }).fail((e) => {
                        alert("CEP NÃO ENCONTRADO");
                    });

                }

            });
        });
    </script>
</body>

</html>