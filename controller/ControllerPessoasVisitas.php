<?php

require_once "{$_SERVER['DOCUMENT_ROOT']}/model/ModelPessoaVisita.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/model/PessoaFisica.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/model/PessoaJuridica.php";

if (isset($_GET['acao'])) {

    switch ($_GET['acao']) {
        case 'salvar':
            (new ControllerPessoasVisitas())->salvar();
            break;
        case 'atualizar':
            (new ControllerPessoasVisitas())->atualizar();
            break;
        case 'listar':
            (new ControllerPessoasVisitas())->listar();
            break;
        case 'excluir':
            (new ControllerPessoasVisitas())->excluir();
            break;

        default:

            break;
    }
}


class ControllerPessoasVisitas
{

    function salvar()
    {
        $visita = new ModelPessoaVisita();
        if (
            empty($_POST['nome']) || empty($_POST['cidade']) ||
            empty($_POST['dataVisita']) || empty($_POST['comentario'])
        ) {
            header('location: /view/pessoas/visitas?cad=erro');
        } else {
            $visita->__set('nome', $_POST['nome']);
            $visita->__set('cidade', $_POST['cidade']);
            $visita->__set('data', $_POST['dataVisita']);
            $visita->__set('comentario', $_POST['comentario']);

            $visita->cadastrar($visita);
            header("location:  /view/pessoas/visitas?cad=sucesso");
        }
    }

    function autoCompleteListagem()
    {
        $listar = (new PessoaFisica())->listarM();
        $listarPF = (new PessoaJuridica())->listarM();
        return $listagem = [$listar, $listarPF];
    }

    function atualizar()
    {
        $visita = new ModelPessoaVisita();
        if (
            empty($_POST['nome']) || empty($_POST['cidade']) ||
            empty($_POST['dataVisita']) || empty($_POST['comentario'])
        ) {
            header('location: /view/pessoas/visitalistar?cad=erro');
        } else {
            $visita->__set('idVisitas', $_POST['idVisitas']);
            $visita->__set('nome', $_POST['nome']);
            $visita->__set('cidade', $_POST['cidade']);
            $visita->__set('data', $_POST['data']);
            $visita->__set('comentario', $_POST['comentario']);

            $visita->atualizar($visita);
            header('location: /view/pessoas/visitalistar?cad=sucesso');
        }
    }
    function listar()
    {
        $visita = new ModelPessoaVisita();
        return $visita->listar();
    }
    function excluir()
    {
        $visita = new ModelPessoaVisita();

        $visita->__set('idVisitas', $_POST['idVisitas']);
        $visita->excluir();
        header('location: /view/pessoas/visitalistar');
    }
}
