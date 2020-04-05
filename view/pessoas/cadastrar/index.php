<?php
session_start();
require_once("../../../estrutura/controleLogin.php");

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4 text-center">
                        <h1 class="h3 mb-0 text-gray-800 text-center">Pessoas</h1>
                    </div>
                </div>


                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                    <form action="../../../controller/controllerPessoaFisica.php?acao=cad" method="post">

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Pessoa Fisica
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="panel-body">
                                            <label class="form-label">Nome completo</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="nome" required>

                                                </div>
                                            </div>

                                            <label class="form-label">Email</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="email" class="form-control" name="email" required>

                                                </div>
                                            </div>
                                            <label class="form-label">Telefone</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="tel" class="form-control" name="telefoneF" required>

                                                </div>
                                            </div>
                                            <label class="form-label">Sexo</label>
                                            <div class="form-group">
                                                <input type="radio" name="sexo" value="masculino" id="male" class="with-gap">
                                                <label for="male">Masculino</label>
                                                <input type="radio" name="sexo" value="feminino" id="female" class="with-gap">
                                                <label for="female" class="m-l-20">Feminino</label>
                                            </div>
                                            <label class="form-label">Data de nascimento</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="date" class="form-control date" name="nascimento" required placeholder="Ex: 30/07/2016">
                                                </div>
                                            </div>
                                            <label class="form-label">Endereço</label>
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
                                            <label class="form-label">Categoria</label>
                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <select name="categoria" class="form-control show-tick ">
                                                        <option value="">-- Selecione uma categoria --</option>
                                                        <option value="dep.estadual">Deputados estadual</option>
                                                        <option value="dep.federal">Deputado federal</option>
                                                        <option value="familia">Família</option>
                                                        <option value="lideranca">Liderança</option>
                                                        <option value="geral">Geral</option>
                                                        <option value="prefeito">Prefeito</option>
                                                        <option value="vereador">Vereador</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link collapsed text-center" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Pessoa Juridica
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="panel-body">


                                    <label class="form-label">CNPJ</label>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="tel" id="cnpj" class="form-control" placeholder="CNPJ">
                                            </div>
                                        </div>
                                    </div>
                                    <label class="form-label">Nome</label>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="tel" id="nomeJ" class="form-control" placeholder="Nome">
                                            </div>
                                        </div>
                                    </div>

                                    <label class="form-label">Nome Fantasia</label>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="fantasiaJ" class="form-control" placeholder="Nome Fantasia">
                                            </div>
                                        </div>

                                    </div>
                                    <label class="form-label">Telefone</label>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="telefoneJ" required placeholder="Telefone">

                                        </div>
                                    </div>

                                    <label class="form-label">Endereço</label>
                                    <div class="row clearfix">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="logradouroJ" class="form-control" id="logradouroJ" placeholder="Logradouro">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="tel" id="numeroJ" class="form-control" placeholder="N°">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="complementoJ" class="form-control" placeholder="Complemento">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="bairroJ" class="form-control" placeholder="Bairro">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="cidadeJ" class="form-control" placeholder="Cidade">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="estadoJ" class="form-control" placeholder="Estado">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="form-label">Atividade</label>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="atividadeJ" class="form-control" placeholder="Atividade">
                                            </div>
                                        </div>
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
</body>

</html>