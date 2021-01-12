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


<body id="page-top">
    <!-- modal inicio -->

    <div class="modal fade" id="modalEdicao" tabindex="-1" role="dialog" aria-labelledby="modalEdicaoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEdicaoLabel">Editar pessoas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" enctype="multipart/form-data" id="formularioEnviar" method="post">
                    <div class="modal-body">

                        <input type="hidden" id="idt_pessoa" name="n_idt_pessoa_editado">
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
                <form action="" id="formularioExcluir" method="post">
                    <div class="modal-body">

                        <!-- <input type="hidden" id="idt_pessoa" name="idt_pessoa"> -->


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTirarFotoEditar" tabindex="-1" role="dialog" aria-labelledby="modalTirarFotoEditarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTirarFotoEditarLabel">Editar foto da pessoa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" enctype="multipart/form-data" id="formularioEditarFoto" method="post">
                    <div class="modal-body">
                        <div class="area">
                            <video autoplay="true" id="webCamera">
                            </video>

                            <input type="hidden" id="base_img" name="base_img" />
                            <!-- <button type="button" onclick="takeSnapShot()">Tirar foto e salvar</button> -->

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
                        Registro atualizado com sucesso.
                    </div>
                <?php elseif ($status == "erro") : ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Erro no cadastro verifique os campos.</strong>
                    </div>
                <?php endif; ?>
                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    <!-- mensagem de sucesso e erro -->

                    <!-- Fim mensagem sucesso e erro -->

                    <div class="card-header text-center">
                        <h1 class="cabecalho_paginas">Listar Pessoas</h1>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Telefone(s)</th>
                                <th>Data de nascimento</th>
                                <th>Cidade</th>

                                <th>Categoria</th>
                                <th>ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Telefone(s)</th>
                                <th>Bairro</th>
                                <th>Endereço</th>
                                <th>Cidade</th>

                                <th>Ações</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!-- include estrutura da tabela -->
                            <?php include '../../../estrutura/tabelaPessoas.php'; ?>
                            <!-- fim include estrutura da tabela -->
                        </tbody>
                    </table>
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
    <script src="../../../js/jquery.mask.min.js"></script>
    <script>
        $('#modalEdicao').on('show.bs.modal', function(event) {


            var button = $(event.relatedTarget) // Button that triggered the modal
            // var idt_pessoa = button.data('idt_pessoa')
            // Extract info from data-* attributes
            // pessoa
            var nome = button.data('nome');
            var idtPessoa = button.data('idt_pessoa');
            var email = button.data('email')
            var telefone = button.data('telefone');
            var telefone2 = button.data('telefone2');
            var telefone3 = button.data('telefone3');
            var fkIdtEndereco = button.data('t_endereco_idt_endereco');
            // pessoa fisica
            var cpf = button.data('cpf');
            var sexo = button.data('sexo');
            var nascimento = button.data('nascimento');

            var idtPF = button.data('idt_pessoa_fisica');
            var categoria = button.data('categoria');

            // pessoa juridica

            var cnpj = button.data('cnpj');
            var nomeFantasia = button.data('nome_fantasia');
            var atividade = button.data('atividade');


            // endereco
            var idtEndereco = button.data('idt_endereco');
            var fkIdtPessoa = button.data('t_pessoa_idt_pessoa');
            var cep = button.data('cep');
            var complemento = button.data('complemento');
            var endereco = button.data('endereco');
            var logradouro = button.data('logradouro');
            var bairro = button.data('bairro');
            var cidade = button.data('cidade');
            var estado = button.data('estado');
            var numero = button.data('numero');

            // pessoa juridica
            var fantasia = button.data('nome_fantasia');
            var cnpj = button.data('cnpj');

            var img = button.data('arquivo');

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)

            // define o parametro da action para atualizar usuarios

            if (idtPF >= 1) {
                $("#formularioEnviar .modal-body").html(` 
                <div class="card">
                                                
                                                <div class="card-body  text-center">
                                                    <img id="imagemConvertidaEditar" width="100px" />
                                                 <!--   <button type="button" class="btn btn-warning w-100" data-toggle="modal" data-target="#modalTirarFotoEditar">
                                                        Registrar pela câmera
                                                    </button> -->
                                                    <input type="hidden" id="caminhoDaFotoTiradaEditada" name="caminhoDaFotoTiradaEditada" />
                                                </div>
                                            </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome pessoa:</label>
                            <input type="text" class="form-control" id="n_nome_editado" name="n_nome_editado">
                        </div>
                   
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">E-mail:</label>
                            <input type="text" class="form-control" id="n_email_editado" name="n_email_editado">
                        </div>
                        <div class="form-group">
                        <input type="tel" class="form-control" id="n_telefone_editado" name="n_telefone_editado" maxlength="15" placeholder="1° - 00 99999-9999">
                            <label for="recipient-name" class="col-form-label">Telefone 2:</label>
                            <input type="tel" class="form-control" id="n_telefone_editado2" name="n_telefone_editado2" maxlength="15" placeholder="2° - 00 99999-9999">
                            <label for="recipient-name" class="col-form-label">Telefone 3:</label>
                            <input type="tel" class="form-control" id="n_telefone_editado3" name="n_telefone_editado3" maxlength="15" placeholder="3° - 00 99999-9999">
                        </div>
                        <label class="form-label">Sexo</label>
                        <div class="form-group">
                            <input type="radio" name="n_sexo_editado" value="masculino" id="n_masc_editado" class="with-gap">
                            <label for="male">Masculino</label>
                            <input type="radio" name="n_sexo_editado" value="feminino" id="n_fem_editado" class="with-gap">
                            <label for="female" class="m-l-20">Feminino</label>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">CPF:</label>
                            <input type="text" class="form-control" id="n_cpf_editado" name="n_cpf_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Data de nascimento:</label>
                            <input type="date" class="form-control" id="n_nascimento_editado" name="n_nascimento_editado">
                        </div>
                        <label class="form-label">Categoria</label>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <select name="n_categoria_editado" id="n_categoria_editado" class="form-control show-tick ">
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
                         <div class="form-group">
                            <label for="recipient-name" class="col-form-label">CEP:</label>
                            <input type="text" class="form-control" id="n_cep_editado" name="n_cep_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Logradouro:</label>
                            <input type="text" class="form-control" id="n_logradouro_editado" name="n_logradouro_editado">
                        </div>
                       
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Bairro:</label>
                            <input type="text" class="form-control" id="n_bairro_editado" name="n_bairro_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Complemento:</label>
                            <input type="text" class="form-control" id="n_complemento_editado" name="n_complemento_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">numero:</label>
                            <input type="text" class="form-control" id="n_numero_editado" name="n_numero_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Cidade:</label>
                            <input type="text" class="form-control" id="n_cidade_editado" name="n_cidade_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Estado:</label>
                            <input type="text" class="form-control" id="n_estado_editado" name="n_estado_editado">
                        </div>
                        <input type="hidden" id="idtPessoa" name="n_idtPessoa_editado">
                        <input type="hidden" id="idtEndereco" name="n_idtEndereco_editado">
                        <input type="hidden" id="fkEndereco" name="n_fkEndereco_editado">
                        <input type="hidden" id="idtPF" name="n_idtPF_editado">
                        <input type="hidden" id="fkIdtPessoa" name="n_fkIdtPessoa_editado">
                      
                `)
                $('#formularioEnviar').attr('action', '../../../controller/ControllerPessoaFisica.php?acao=alterar')

            } else {
                $("#formularioEnviar .modal-body").html(`
                   
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome pessoa:</label>
                            <input type="text" class="form-control" id="n_nome_editado" name="n_nome_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">E-mail:</label>
                            <input type="text" class="form-control" id="n_email_editado" name="n_email_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome fatasia:</label>
                            <input type="text" class="form-control" id="n_fantasia_editado" name="n_fantasia_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">CNPJ:</label>
                            <input type="text" class="form-control" id="n_cnpj_editado" name="n_cnpj_editado">
                        </div>
                        <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Telefone 1:</label>
                            <input type="tel" class="form-control" id="n_telefone_editado" name="n_telefone_editado" maxlength="15" placeholder="1° - 00 99999-9999">
                            <label for="recipient-name" class="col-form-label">Telefone 2:</label>
                            <input type="tel" class="form-control" id="n_telefone_editado2" name="n_telefone_editado2" maxlength="15" placeholder="2° - 00 99999-9999">
                            <label for="recipient-name" class="col-form-label">Telefone 3:</label>
                            <input type="tel" class="form-control" id="n_telefone_editado3" name="n_telefone_editado3" maxlength="15" placeholder="3° - 00 99999-9999">

                            
                        </div>
                        <label>Endereco</label>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Logradouro:</label>
                            <input type="text" class="form-control" id="n_logradouro_editado" name="n_logradouro_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">CEP:</label>
                            <input type="text" class="form-control" id="n_cep_editado" name="n_cep_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Bairro:</label>
                            <input type="text" class="form-control" id="n_bairro_editado" name="n_bairro_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Complemento:</label>
                            <input type="text" class="form-control" id="n_complemento_editado" name="n_complemento_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">numero:</label>
                            <input type="text" class="form-control" id="n_numero_editado" name="n_numero_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Cidade:</label>
                            <input type="text" class="form-control" id="n_cidade_editado" name="n_cidade_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome pessoa:</label>
                            <input type="text" class="form-control" id="n_estado_editado" name="n_estado_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Atividade:</label>
                            <input type="text" class="form-control" id="n_atividade_editado" name="n_atividade_editado">
                        </div>
                        <input type="hidden" id="idtPessoa" name="idtPessoa">
                        <input type="hidden" id="idtEndereco" name="idtEndereco">
                        <input type="hidden" id="fkIdtPessoa" name="fkIdtPessoa">
                        <input type="hidden" id="fkEndereco" name="fkEndereco">
                     
    `)
                $('#formularioEnviar').attr('action', '../../../controller/ControllerPessoaJuridica.php?acao=alterar')
            }
            // seta os valores do modal
            $("#n_telefone_editado").mask('(##)# ####-####');
            $("#n_telefone_editado2").mask('(##)# ####-####');
            $("#n_telefone_editado3").mask('(##)# ####-####');

            $("#n_cpf_editado").mask("###.###.###-##");
            $("#n_cep_editado").mask("#####-###")

            $("#n_cep_editado").blur(function() {
                var cep = $(this).val().replace(/\D/g, "");

                if (cep != "") {
                    console.log(cep);
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                        // console.log(dados);
                        if (!("erro" in dados)) {


                            $('#n_logradouro_editado').val(dados.logradouro);
                            // $('#logradouroF').val(dados.bairro);
                            $('#n_bairro_editado').val(dados.bairro);
                            $('#n_cidade_editado').val(dados.localidade);
                            $('#n_estado_editado').val(dados.uf);

                        }

                    }).fail((e) => {
                        alert("CEP NÃO ENCONTRADO");
                    });

                }

            });

            var idSexo = "";
            // pessoa fisica / pessoa

            if (sexo == "masculino") {
                idSexo = "masc";
            } else {
                idSexo = "fem";
            }

            modal.find('#n_nome_editado').val(nome);
            modal.find('#n_email_editado').val(email);
            modal.find('#n_telefone_editado').val(telefone)

            modal.find('#n_telefone_editado2').val(telefone2);
            modal.find('#n_telefone_editado3').val(telefone3);
            modal.find(`#n_${idSexo}_editado`).prop('checked', true);
            modal.find('#n_cpf_editado').val(cpf);
            modal.find('#n_categoria_editado').val(categoria);
            modal.find('#imagemConvertidaEditar').attr('src', img);

            modal.find('#caminhoDaFotoTiradaEditada').val(img);
            console.log(nascimento);
            var data = (nascimento);
            var dataFormatada = data.split("/").reverse().join('-')

            // pessoa Juridica
            modal.find('#n_cnpj_editado').val(cnpj);
            modal.find('#n_fantasia_editado').val(nomeFantasia);
            modal.find('#n_atividade_editado').val(atividade)


            // estado
            modal.find('#n_nascimento_editado').val(dataFormatada);
            modal.find('#n_logradouro_editado').val(endereco);
            modal.find('#n_complemento_editado').val(complemento);
            modal.find('#n_numero_editado').val(numero);
            modal.find('#n_cidade_editado').val(cidade);
            modal.find('#n_bairro_editado').val(bairro);
            modal.find('#n_cep_editado').val(cep);
            modal.find('#n_estado_editado').val(estado);
            modal.find('#idtEndereco').val(idtEndereco)
            modal.find('#idtPessoa').val(idtPessoa);
            modal.find('#idtPF').val(idtPF);
            modal.find('#fkEndereco').val(fkIdtEndereco);

            modal.find('#fkIdtPessoa').val(fkIdtPessoa);


        });

        $('#modalResetar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var idusuario = button.data('idusuario') // Extract info from data-* attributes
            var nome = button.data('nome')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)



        });

        $('#modalExcluir').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // Extract info from data-* attributes
            var nome = button.data('nome')
            var idtPessoa = button.data('idt_pessoa')
            var idtPf = button.data('idt_pessoa_fisica')
            var fkIdtEndereco = button.data('t_endereco_idt_endereco')
            var idtEndereco = button.data('idt_endereco')
            var fkIdtPessoa = button.data('t_pessoa_idt_pessoa')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            if (idtPf >= 1) {
                $('#formularioExcluir .modal-body').html(`
    <label id="texto_excluir"></label>
    <input type="hidden" id="idtPessoa" name="idtPessoa">
    <input type="hidden" id="idtPf" name="idtPf">
    <input type="hidden" id="fkIdtEndereco" name="fkIdtEndereco">
    <input type="hidden" id="idtEndereco" name="idtEndereco">
    <input type="hidden" id="fkIdtPessoa" name="fkIdtPessoa">
    `);
                $('#formularioExcluir').attr('action', '../../../controller/ControllerPessoaFisica.php?acao=excluir')
            } else {
                $('#formularioExcluir .modal-body').html(`
    <label id="texto_excluir"></label>
    <input type="hidden" id="idtPessoa" name="idtPessoa">
    <input type="hidden" id="fkIdtEndereco" name="fkIdtEndereco">
    <input type="hidden" id="idtEndereco" name="idtEndereco">
    <input type="hidden" id="fkIdtPessoa" name="fkIdtPessoa">
    `);
                $('#formularioExcluir').attr('action', '../../../controller/ControllerPessoaJuridica.php?acao=excluir')
            }
            var modal = $(this)
            modal.find('.modal-title').text('Confirmar exclusão')
            modal.find('#texto_excluir').text("Tem certeza que desaja excluir a pessoa: " + nome + " do sistema ?")

            modal.find('#idtPessoa').val(idtPessoa);
            modal.find('#idtPf').val(idtPf);
            modal.find('#fkIdtEndereco').val(fkIdtEndereco);
            modal.find('#idtEndereco').val(idtEndereco);
            modal.find('#fkIdtPessoa').val(fkIdtPessoa);

        });
    </script>
</body>

</html>