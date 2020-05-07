<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/ModelProjetosDeLei.php');

if (isset($_GET['acao'])) {
    switch ($_GET['acao']) {

        case 'salvar':
            (new ControllerProjetosDeLei())->salvarProjetosDeLei();
            break;
        case 'atualizar':
            (new ControllerProjetosDeLei())->atualizarProjetosDeLei();
            break;
        case 'listar':
            (new ControllerProjetosDeLei())->listarProjetosDeLei();
            break;

        case 'deletar':
            (new ControllerProjetosDeLei())->deletarProjetosDeLei();
            break;
    }
}

class ControllerProjetosDeLei
{

    function salvarProjetosDeLei()
    {
        
        $salvar = new ModelProjetosDeLei();
       
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
        
        header("location: /view/ProjetosDeLei/cadastrar?pg={$_POST['pagina']}&cadastrar=sucesso");
        

    }
    function atualizarProjetosDeLei()
    {
        
        $atualizar = new ModelProjetosDeLei();

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
        header("location: /view/ProjetosDeLei/listar?pg={$_POST['tipo']}&atualizar=sucesso");
    
    }
    function listarProjetosDeLei()
    {
        return (new ModelProjetosDeLei())->listarModel();
    }
    function deletarProjetosDeLei()
    {
        print_r($_POST);
        $deletar = new ModelProjetosDeLei();

        $deletar->__set('idt', $_POST['idtReq']);
        $deletar->__set('tipo', $_POST['tipo']);

        $deletar->deletarModel($deletar);
        header("location: /view/ProjetosDeLei/listar?pg={$_POST['tipo']}&excluir=sucesso");
    }
}
