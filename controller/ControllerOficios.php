<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/ModelOficios.php');

if (isset($_GET['acao'])) {
    switch ($_GET['acao']) {

        case 'salvar':
            (new ControllerOficios())->salvarOficios();
            break;
        case 'atualizar':
            (new ControllerOficios())->atualizarOficios();
            break;

        case 'listar':
            (new ControllerOficios())->listarOficios();
            break;

        case 'deletar':
            (new ControllerOficios())->deletarOficios();
            break;
        case 'deletarComentario':
            (new ControllerOficios())->deletarComentarioOficios();
            break;
        case 'deletarAnexo':
            (new ControllerOficios())->deletarAnexo();
            break;
    }
}

class ControllerOficios
{
    function arquivos($arq)
    {

        $extencoes = [
            'pdf',
            'doc',
            'docx',
            'png',
            'jpg',
            'xlsx',
            'xls'
        ];

        $dir = "../arq/";

        $arqNome = [];
        $arqLocal = [];
        $tdsArquivos = [];
        $qtdArquivos = count($arq['arquivos']['name']);

        $cont = 0;
        while ($cont < $qtdArquivos) {
            //echo $arq['arquivos']['name'][$cont];
            $arqExtencao = pathinfo(strtolower($arq['arquivos']['name'][$cont]), PATHINFO_EXTENSION);
            $arqNome[] = pathinfo(strtolower($arq['arquivos']['name'][$cont]), PATHINFO_FILENAME);
            if (in_array($arqExtencao, $extencoes)) {

                $temp = $arq['arquivos']['tmp_name'][$cont];
                $novoNome = uniqid() . ".$arqExtencao";
                $dirImg = $dir . $novoNome;
                move_uploaded_file($temp, $dirImg);
                $arqLocal[] = $dirImg;
            }
            $cont++;
        }
        return $tdsArquivos[] = ["local" => $arqLocal, "nome" => $arqNome];
    }

    function salvarOficios()
    {

        $salvar = new ModelOficios();

        $salvar->__set('documento', $_POST['documento']);
        $salvar->__set('solicitante', $_POST['solicitante']);
        $salvar->__set('instituicao', $_POST['instituicao']);
        $salvar->__set('nomeContato', $_POST['nomeContato']);
        if ($_POST['cidade'] == "") {
            $salvar->__set('cidade', null);
        } else {
            $salvar->__set('cidade', $_POST['cidade']);
        }

        $salvar->__set('titulo', $_POST['titulo']);
        $salvar->__set('data', $_POST['dataPedido']);
        $salvar->__set('descricao', $_POST['descricao']);
        $salvar->__set('status', $_POST['status']);
        $salvar->__set('comentario', $_POST['comentario']);
        $salvar->__set('tipo', $_POST['pagina']);

        $salvar->__set('arquivos', $this->arquivos($_FILES));

        $retorno = $salvar->salvarModel($salvar);

        if ($retorno == 1) {
            header("location: /view/oficios/cadastrar?pg={$_POST['pagina']}&cadastrar=sucesso");
        }
    }
    function atualizarOficios()
    {

        $atualizar = new ModelOficios();

        $atualizar->__set('documento', $_POST['documento']);
        $atualizar->__set('solicitante', $_POST['solicitante']);
        $atualizar->__set('instituicao', $_POST['instituicao']);
        $atualizar->__set('nomeContato', $_POST['nomeContato']);
        $atualizar->__set('titulo', $_POST['titulo']);
        $atualizar->__set('data', $_POST['dataDocumento']);
        $atualizar->__set('descricao', $_POST['descricao']);
        if ($_POST['cidade'] == "") {
            $atualizar->__set('cidade', null);
        } else {
            $atualizar->__set('cidade', $_POST['cidade']);
        }
        $atualizar->__set('status', $_POST['status']);
        $atualizar->__set('tipo', $_POST['tipo']);
        $atualizar->__set('comentario', $_POST['comentario']);
        $atualizar->__set('idt', $_POST['idtofi']);

        $atualizar->__set('arquivos', $this->arquivos($_FILES));

        $retorno = $atualizar->atualizarModel();

        if ($retorno == 1) {
            header("location: /view/oficios/listar?pg={$_POST['tipo']}&atualizar=sucesso");
        }
    }
    function listarOficios()
    {
        $lista_oficios = (new ModelOficios())->listarOficios();

        return $lista_oficios;
    }
    function deletarOficios()
    {

        $deletar = new ModelOficios();

        $deletar->__set('idt', $_POST['idtofi']);
        $deletar->__set('tipo', $_POST['tipo']);

        $retorno = $deletar->deletarModel($deletar);

        if ($retorno == 1) {
            header("location: /view/oficios/listar?pg={$_POST['tipo']}&excluir=sucesso");
        }
    }

    function deletarComentarioOficios()
    {

        $deletar = new ModelOficios();

        $deletar->__set('idt', $_POST['idtofi']);

        $retorno = $deletar->deletarComentario($deletar);

        if ($retorno == 1) {
            header("location: /view/oficios/listar?pg={$_POST['tipo']}&excluir=sucesso");
        }
    }


    function deletarAnexo()
    {

        $deletar = new ModelOficios();

        $deletar->__set('idt', $_POST['idtofi']);
        $caminho_arquivo = $_POST['caminho_arquivo'];

        $retorno = $deletar->deletarAnexo($deletar);

        if ($retorno) {
            if (unlink($caminho_arquivo)) {
                header("location: /view/oficios/listar?pg={$_POST['tipo']}&excluir=sucesso");
            }
        }
    }
}
