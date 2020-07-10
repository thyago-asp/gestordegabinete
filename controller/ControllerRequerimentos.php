<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/ModelRequerimentos.php');

if (isset($_GET['acao'])) {
    switch ($_GET['acao']) {

        case 'salvar':
            (new ControllerRequerimentos())->salvarRequerimentos();
            break;
        case 'atualizar':
            (new ControllerRequerimentos())->atualizarRequerimentos();
            break;

        case 'listar':
            (new ControllerRequerimentos())->listarRequerimentos();
            break;

        case 'deletar':
            (new ControllerRequerimentos())->deletarRequerimentos();
            break;
        case 'deletarComentario':
            (new ControllerRequerimentos())->deletarComentario();
            break;
        case 'deletarAnexo':
            (new ControllerRequerimentos())->deletarAnexo();
            break;
    }
}

class ControllerRequerimentos
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

    function salvarRequerimentos()
    {
        $salvar = new ModelRequerimentos();
        //print_r($_POST['tipo']);
        $salvar->__set('documento', $_POST['documento']);
        $salvar->__set('solicitante', $_POST['solicitante']);
        $salvar->__set('instituicao', $_POST['instituicao']);
        $salvar->__set('nomeContato', $_POST['nomeContato']);
        $salvar->__set('titulo', $_POST['titulo']);
        if($_POST['cidade'] == ""){
            $salvar->__set('cidade', null);
        }else{
            $salvar->__set('cidade', $_POST['cidade']);
        }
        
        $salvar->__set('data', $_POST['dataPedido']);
        $salvar->__set('descricao', $_POST['descricao']);
        $salvar->__set('status', $_POST['status']);
        $salvar->__set('tipo', $_POST['tipo']);
        $salvar->__set('comentario', $_POST['comentario']);
        $arq = $this->arquivos($_FILES);

        if ($arq == false) {
            header("location: /view/requerimentos/cadastrar?pg={$_POST['tipo']}&cadastrar=sucesso");
        }

        $salvar->__set('arquivos', $arq);

        $retorno = $salvar->salvarModel($salvar);
        if ($retorno == 1) {
            header("location: /view/requerimentos/cadastrar?pg={$_POST['tipo']}&cadastrar=sucesso");
        }
    }
    function atualizarRequerimentos()
    {
        $atualizar = new ModelRequerimentos();

        $atualizar->__set('documento', $_POST['documento']);
        $atualizar->__set('solicitante', $_POST['solicitante']);
        $atualizar->__set('instituicao', $_POST['instituicao']);
        $atualizar->__set('nomeContato', $_POST['nomeContato']);
        $atualizar->__set('titulo', $_POST['titulo']);
        $atualizar->__set('data', $_POST['dataDocumento']);
        $atualizar->__set('descricao', $_POST['descricao']);
        $atualizar->__set('status', $_POST['status']);
        if($_POST['cidade'] == ""){
            $atualizar->__set('cidade', null);
        }else{
            $atualizar->__set('cidade', $_POST['cidade']);
        }
        $atualizar->__set('tipo', $_POST['tipo']);
        $atualizar->__set('idt', $_POST['idtReq']);
        $atualizar->__set('comentario', $_POST['comentario']);
        $atualizar->__set('arquivos', $this->arquivos($_FILES));

        $retorno = $atualizar->atualizarModel();

        if ($retorno == 1) {
            header("location: /view/requerimentos/listar?pg={$_POST['tipo']}&atualizar=sucesso");
        }
    }
    function listarRequerimentos()
    {
        $lista = (new ModelRequerimentos())->listarRequerimentos();


        return $lista;
    }
    function deletarRequerimentos()
    {

        $deletar = new ModelRequerimentos();

        $deletar->__set('idt', $_POST['idtReq']);
        $deletar->__set('tipo', $_POST['tipo']);

        $retorno = $deletar->deletarModel($deletar);

        if ($retorno) {
            header("location: /view/requerimentos/listar?pg={$_POST['tipo']}&excluir=sucesso");
        }
    }

    function deletarComentario()
    {

        $deletar = new ModelRequerimentos();

        $deletar->__set('idt', $_POST['idtreq']);

        $deletar->deletarComentario($deletar);

        header("location: /view/requerimentos/listar?pg={$_POST['tipo']}&excluir=sucesso");
    }

    function deletarAnexo()
    {

        $deletar = new ModelRequerimentos();

        $deletar->__set('idt', $_POST['idtreq']);
        $caminho_arquivo = $_POST['caminho_arquivo'];
        $retorno = $deletar->deletarAnexo($deletar);

        if ($retorno) {
            if (unlink($caminho_arquivo)) {

                header("location: /view/requerimentos/listar?pg={$_POST['tipo']}&excluir=sucesso");
            }
        }
    }
}
