<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/PessoaJuridica.php');


if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerPessoaJuridica())->cadastrar();
            break;

        case 'alterar':
            (new ControllerPessoaJuridica())->atualizarPJ();
            // (new ControllerPessoa())->alterar();
            break;
        case 'listar':
            (new ControllerPessoaJuridica())->listarTodosJuridico();
            break;

        case 'excluir':
            (new ControllerPessoaJuridica())->excluirUsuario();
            break;
    }
}


class ControllerPessoaJuridica
{

    public function setUsuarios() {

    }

    public function cadastrar()
    {
        // instancia do model PessoaFisica para cadastro
        $pf = new PessoaJuridica();
       
        // setta os valores
       
        $pf->__set('cnpj', $_POST["cnpj"]);
        $pf->__set('nome', $_POST["nomeJ"]);
        $pf->__set('fantasia', $_POST['fantasiaJ']);
        $pf->__set('telefone', $_POST['telefoneJ']);
        $pf->__set('logradouro', $_POST['logradouroJ']);
        $pf->__set('numero', $_POST['numeroJ']);
        $pf->__set('complemento', $_POST['complementoJ']);
        $pf->__set('bairro', $_POST['bairroJ']);
        $pf->__set('cidade', $_POST['cidadeJ']);
        $pf->__set('estado', $_POST['estadoJ']);
        $pf->__set('atividade', $_POST['atividadeJ']);
        $pf->__set('email', $_POST['email']);
       

        $result = $pf->cadastroM($pf);

        if($result) {
            header('location: /view/pessoas/cadastrar?cad=sucesso');
        } else {
            header('location: /view/pessoas/cadastrar?cad=erro');
        }
        
       
    }

    function atualizarPJ()
    {
        // instancia model pessoa fisica
        $pf = new PessoaJuridica();
        
        $pf->__set('cnpj', $_POST["n_cnpj_editado"]);
        $pf->__set('nome', $_POST["n_nome_editado"]);
        $pf->__set('nomeFantasia', $_POST['n_fantasia_editado']);
        $pf->__set('telefone', $_POST['n_telefone_editado']);
        $pf->__set('logradouro', $_POST['n_logradouro_editado']);
        $pf->__set('numero', $_POST['n_numero_editado']);
        $pf->__set('cep', $_POST['n_cep_editado']);
        $pf->__set('email', $_POST['n_email_editado']);
        
        $pf->__set('complemento', $_POST['n_complemento_editado']);
        $pf->__set('bairro', $_POST['n_bairro_editado']);
        $pf->__set('cidade', $_POST['n_cidade_editado']);
        $pf->__set('estado', $_POST['n_estado_editado']);
        $pf->__set('atividade', $_POST['n_atividade_editado']);
    
        $pf->__set('fkIdtPessoa', $_POST['fkIdtPessoa']);
        $pf->__set('idtPessoa', $_POST['idtPessoa']);
        $pf->__set('idtEndereco', $_POST['fkIdtPessoa']);
        $pf->__set('fkEndereco', $_POST['fkEndereco']);
        // setta os valores 
        $resultado = $pf->atualizarM($pf);
        
        if($resultado == true) {
            header('location: /view/pessoas/listar?atualizar=sucesso');
        } else {
            header('location: /view/pessoas/listar?atualizar=erro');
        }
    }

    function listarTodosJuridico()
    {
        return ((new PessoaJuridica())->listarM());
    }

    function excluirUsuario()
    {
        $pf = new PessoaJuridica();
        
        $pf->__set('fkIdtPessoa', $_POST['fkIdtPessoa']);
        $pf->__set('idtPessoa', $_POST['idtPessoa']);
        $pf->__set('idtEndereco', $_POST['fkIdtPessoa']);
        $pf->__set('fkEndereco', $_POST['fkIdtEndereco']);


        $resultado = $pf->excluirM($pf);
        if($resultado == true) {
            header('location: /view/pessoas/listar?excluir=sucesso');
        } else {
            header('location: /view/pessoas/listar?excluir=erro');
        }
        
    }
}
