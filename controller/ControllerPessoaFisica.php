<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/PessoaFisica.php');
// require_once($_SERVER['DOCUMENT_ROOT'] . '/')
// require_once($_SERVER['DOCUMENT_ROOT'] . '/Crud.php');


if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerPessoaFisica())->cadastrar();
            break;

        case 'alterar':
            (new ControllerPessoaFisica())->atualizarUsuario();
            // (new ControllerPessoa())->alterar();
            break;
        case 'listar':
            (new ControllerPessoaFisica())->listarTodos();
            break;

        case 'excluirUsuario':
            (new ControllerPessoaFisica())->excluirUsuario();
            break;
    }
}


class ControllerPessoaFisica
{


    public function cadastrar()
    {
        // instancia do model PessoaFisica para cadastro
        $pf = new PessoaFisica();
        // Verifica se a variavel post está vazia 
        if (empty($_POST)) {
            header('location: /view/pessoas/cadastrar?=erro');
        }
        // setta os valores 
        print_r($_POST);
        
        $pf->__set('nome', $_POST["nome"]);
        $pf->__set('email', $_POST["email"]);
        $pf->__set('telefoneF', $_POST['telefoneF']);
        $pf->__set('sexo', $_POST['sexo']);
        $pf->__set('nascimento', $_POST['nascimento']);
        $pf->__set('cep', $_POST['cep']);
        $pf->__set('logradouro', $_POST['logradouro']);
        $pf->__set('numeroF', $_POST['numeroF']);
        $pf->__set('complemento', $_POST['complemento']);
        $pf->__set('nascimento', $_POST['nascimento']);
        $pf->__set('bairroF', $_POST['bairroF']);
        $pf->__set('cidadeF', $_POST['cidadeF']);
        $pf->__set('estado', $_POST['estado']);
        $pf->__set('categoria', $_POST['categoria']);

       $pf->cadastroM($pf);
        // header('location: /view/pessoas/cadastrar?=sucesso');
    }
    
    function atualizarUsuario()
    {
        echo "teste";
        // instancia model pessoa fisica
        $pf = new PessoaFisica();

        $pf->__set('nome', 'Alana');
        $pf->__set('email', 'alana@gmail.com');
        $pf->__set('telefoneF', '98832844');
        $pf->__set('sexo', 'feminino');
        $pf->__set('nascimento', '02/03/1998');
        $pf->__set('cep', '19983-800');
        $pf->__set('logradouro', 'bananinhas');
        $pf->__set('numeroF', '199');
        $pf->__set('complemento', 'casa');
        $pf->__set('nascimento', '02/03/1990');
        $pf->__set('bairroF', 'uberaba');
        $pf->__set('cidadeF', 'curitiba');
        $pf->__set('estado', 'parana');
        $pf->__set('categoria', 'dep');
        $pf->__set('id', 2);
        print_r($pf);
        // setta os valores 
        $pf->atualizarM($pf);
    }

    function listarTodos()
    {
        echo "<pre>";
        print_r(((new PessoaFisica())->listarM()));
    }

    function excluirUsuario() {
        $pf = new PessoaFisica();
        
        $pf->__set('id', 2);
        $pf->excluirM($pf);
    }

}
