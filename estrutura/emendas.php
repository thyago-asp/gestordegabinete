<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerEmendasOrcamentarias.php');

$status = '';
if (isset($_GET['cadastrar'])) {
    $status = $_GET['cadastrar'];
}


$listaCidades = (new ControllerEmendasOrcamentarias)->listarCidades();
?>
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

<div id="pagina" class="card-header text-center ">
    <h5 aria-describedby="aviso" class="cabecalho_paginas">Emendas orçamentarias</h5>
    <small id="aviso" class="form-text text-muted">Cadastrar</small>
</div>
<div class="card-body">
    <form action="../../../controller/ControllerEmendasOrcamentarias.php?acao=salvar" enctype="multipart/form-data" method="post">
        <div class="card-body">
            <div class="panel-body">
                <label class="form-label">Tipo de emenda</label>
                <div class="form-group">
                    <div class="form-line">

                        <select class="form-control" id="tipo_emenda" name="tipo_emenda">
                            <option value="emenda_federal"> Emenda Federal </option>
                            <option value="emenda_estadual"> Emenda Estadual</option>
                            <option value="emenda_municipal"> Emenda Municipal </option>
                        </select>
                    </div>
                </div>
                <label class="form-label">Numero documento solicitado</label>
                <div class="form-group">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="tel" id="documento" name="documento" class="form-control">
                        </div>
                    </div>
                </div>
                <label class="form-label">Solicitante (Origem)</label>
                <div class="form-group">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="tel" id="solicitante" name="solicitante" class="form-control">
                        </div>
                    </div>
                </div>

                <label class="form-label">Beneficiario</label>
                <div class="form-group">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="beneficiario" name="beneficiario" class="form-control">
                        </div>
                    </div>

                </div>
                <label class="form-label">Nome do contato</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="form-control" name="nomeContato" id="nomeContato" >

                    </div>
                </div>
                <label class="form-label">Cidade</label>
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
                <label class="form-label">Assunto</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="form-control" name="titulo" id="titulo" >

                    </div>
                </div>
                <label class="form-label">Data do documento</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="date" class="form-control" name="dataPedido" id="dataPedido" >

                    </div>
                </div>
                <label>Descrição</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea class="form-control" rows="3" id="descricao" name="descricao"></textarea>

                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="solicitado">Solicitado</option>
                        <option value="pendente">Pendente</option>
                        <option value="pago">Pago</option>
                    </select>
                </div>
                <label>Arquivos</label>
                <div class="input-group mb-3">
                    <div class="custom-file" lang="pt">
                        <input type="file" name="arquivos[]" multiple id="arquivos" class="custom-file-input">

                        <label class="custom-file-label" for="arquivos" id="nomeArq" aria-describedby="inputGroupFileAddon02">Selecione um arquivo</label>
                    </div>

                </div>
                <label id="listaNomes" aria-describedby="inputGroupFileAddon02"></label><br>
                <label class="form-label">Adicionar um comentario</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
                    </div>
                </div>

                <input type="hidden" name="tipo" value="<?php echo $input ?>">
                <div class="form-group">
                    <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                </div>
            </div>
        </div>
    </form>
</div>