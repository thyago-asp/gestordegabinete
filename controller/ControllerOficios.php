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
    }
}

class ControllerOficios
{

    function salvarOficios()
    {
        
        $salvar = new ModelOficios();
       
        $salvar->__set('documento', $_POST['documento']);
        $salvar->__set('solicitante', $_POST['solicitante']);
        $salvar->__set('instituicao', $_POST['instituicao']);
        $salvar->__set('nomeContato', $_POST['nomeContato']);
        $salvar->__set('titulo', $_POST['titulo']);
        $salvar->__set('data', $_POST['dataPedido']);
        $salvar->__set('descricao', $_POST['descricao']);
        $salvar->__set('status', $_POST['status']);
        $salvar->__set('tipo', $_POST['pagina']);

        $result = $salvar->salvarModel($salvar);
        
        header("location: /view/oficios/cadastrar?pg={$_POST['pagina']}&cadastrar=sucesso");
        

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
        $atualizar->__set('status', $_POST['status']);
        $atualizar->__set('tipo', $_POST['tipo']);
        $atualizar->__set('idt', $_POST['idtReq']);
        
        $atualizar->atualizarModel();
        // header("location: /view/oficios/listar?pg={$_POST['tipo']}&atualizar=sucesso");
    
    }
    function listarOficios()
    {
        return (new ModelOficios())->listarModel();
    }
    function deletarOficios()
    {
        print_r($_POST);
        $deletar = new ModelOficios();

        $deletar->__set('idt', $_POST['idtReq']);
        $deletar->__set('tipo', $_POST['tipo']);

        $deletar->deletarModel($deletar);
        header("location: /view/oficios/listar?pg={$_POST['tipo']}&excluir=sucesso");
    }
}
