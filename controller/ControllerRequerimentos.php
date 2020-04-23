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
    }
}

class ControllerRequerimentos
{

    function salvarRequerimentos()
    {
        $salvar = new ModelRequerimentos();
        //print_r($_POST['tipo']);
        $salvar->__set('documento', $_POST['documento']);
        $salvar->__set('solicitante', $_POST['solicitante']);
        $salvar->__set('instituicao', $_POST['instituicao']);
        $salvar->__set('nomeContato', $_POST['nomeContato']);
        $salvar->__set('titulo', $_POST['titulo']);
        $salvar->__set('data', $_POST['dataPedido']);
        $salvar->__set('descricao', $_POST['descricao']);
        $salvar->__set('status', $_POST['status']);
        $salvar->__set('tipo', $_POST['tipo']);

        $result = $salvar->salvarModel($salvar);
        
        header("location: /view/requerimentos/cadastrar?pg={$_POST['tipo']}&cadastrar=sucesso");
        

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
        $atualizar->__set('tipo', $_POST['tipo']);
        $atualizar->__set('idt', $_POST['idtReq']);
        
        $atualizar->atualizarModel();
        header("location: /view/requerimentos/listar?pg={$_POST['tipo']}&atualizar=sucesso");
    
    }
    function listarRequerimentos()
    {
        return (new ModelRequerimentos())->listarModel();
    }
    function deletarRequerimentos()
    {
        //print_r($_POST);
        $deletar = new ModelRequerimentos();

        $deletar->__set('idt', $_POST['idtReq']);
        $deletar->__set('tipo', $_POST['tipo']);

        $deletar->deletarModel($deletar);
        header("location: /view/requerimentos/listar?pg={$_POST['tipo']}&excluir=sucesso");
    }
}
