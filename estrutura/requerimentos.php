<?php
$status = '';
if (isset($_GET['cadastrar'])) {
    $status = $_GET['cadastrar'];
}

$url = strtolower($_GET['pg']);
if ($url == "pedidos") {
    $titulo = "Pedidos de informações";
    $input = "pedidos";
}
if ($url == "envio") {
    $titulo = "Envio de expedientes";
    $input = "envio";
}
if ($url == "voto") {
    $titulo = "Voto de louvor e pesar";
    $input = "voto";
}
if ($url == "diversos") {
    $titulo = "Diversos";
    $input = "diversos";
}
if ($url == "declaracoes") {
    $titulo = "Declarações de presença";
    $input = "declaracoes";
}

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
    <h5 class="cabecalho_paginas"><?php echo $titulo ?></h5>
</div>
<div class="card-body">
    <form action="../../../controller/ControllerRequerimentos.php?acao=salvar" enctype="multipart/form-data" method="post">

        <div class="card-body">
            <div class="panel-body">
                <label class="form-label">Numero documento solicitado</label>
                <div class="form-group">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="tel" id="documento" name="documento" class="form-control" placeholder="DOCUMENTO">
                        </div>
                    </div>
                </div>
                <label class="form-label">Solicitante (Origem)</label>
                <div class="form-group">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="tel" id="solicitante" name="solicitante" class="form-control" placeholder="SOLICITANTE">
                        </div>
                    </div>
                </div>

                <label class="form-label">Instituição (Destino)</label>
                <div class="form-group">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="instituicao" name="instituicao" class="form-control" placeholder="INSTITUIÇÃO">
                        </div>
                    </div>

                </div>
                <label class="form-label">Nome do contato</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="form-control" name="nomeContato" id="nomeContato" required placeholder="NOME DO CONTATO">

                    </div>
                </div>
                <label class="form-label">Titulo</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="form-control" name="titulo" id="titulo" required placeholder="titulo">

                    </div>
                </div>
                <label class="form-label">Data do documento</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="date" class="form-control" name="dataPedido" id="dataPedido" required>

                    </div>
                </div>
                <label>Descrição</label>
                <div class="form-group">
                    <div class="form-line">
                        <textarea class="form-control" rows="3" id="descricao" name="descricao" placeholder="Descrição"></textarea>

                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="aberto">Aberto</option>
                        <option value="aguardando">Aguardando informação</option>
                        <option value="concluido">Concluido</option>
                    </select>
                </div>
                <label>Arquivos</label>
                <div class="form-group">
                    <div class="form-line">
                        <input type="file" class="form-control" name="arquivos[]" multiple id="arquivos">

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