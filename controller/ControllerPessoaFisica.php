<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/PessoaFisica.php');



if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerPessoaFisica())->cadastrar();
            break;

        case 'alterar':
            (new ControllerPessoaFisica())->atualizarUsuario();
            break;

        case 'listar':
            (new ControllerPessoaFisica())->listarPF();
            break;

        case 'excluir':
            (new ControllerPessoaFisica())->excluirUsuario();
            break;
    }
}


class ControllerPessoaFisica
{


    function caminhoImagem($imgSrc) {
        $dir = "../bancodedados/img/";
        $imgExtencao = (pathinfo($imgSrc['imagem']['name'], PATHINFO_EXTENSION));
        
        $temp = ($imgSrc['imagem']['tmp_name']);
        $novoNome = uniqid() . ".$imgExtencao";
        $dirImg =  $dir . $novoNome;
        move_uploaded_file($temp, $dir . $novoNome);

        return $dirImg;
    }

    public function cadastrar()
    {
        // instancia do model PessoaFisica para cadastro
        $pf = new PessoaFisica();
        // Verifica se a variavel post está vazia 
        if (empty($_POST)) {
            header('location: /view/pessoas/cadastrar?=erro');
        }
        
        // setta os valores 

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
        $pf->__set('arquivo', $this->caminhoImagem($_FILES));


        $pf->__set('cpf', $_POST['CPF']);

       

        $resultado = $pf->cadastroM($pf);

        if ($resultado == true) {
            header('location: /view/pessoas/cadastrar?cad=sucesso');
        } else {
            header('location: /view/pessoas/cadastrar?cad=erro');
        }
    }

    function atualizarUsuario()
    {
        // instancia model pessoa fisica
        $pf = new PessoaFisica();

        
        // t_endereco 
        $pf->__set('cep', $_POST['n_cep_editado']);
        $pf->__set('logradouro', $_POST['n_logradouro_editado']);
        $pf->__set('numeroF', $_POST['n_numero_editado']);
        $pf->__set('complemento', $_POST['n_complemento_editado']);
        $pf->__set('endereco', $_POST['n_logradouro_editado']);
        $pf->__set('bairroF', $_POST['n_bairro_editado']);
        $pf->__set('cidadeF', $_POST['n_cidade_editado']);
        $pf->__set('estado', $_POST['n_estado_editado']);
        $pf->__set('idtEndereco', $_POST['n_idtEndereco_editado']);

        // pessoa fisica
        $pf->__set('categoria', $_POST['n_categoria_editado']);
        $pf->__set('cpf', $_POST['n_cpf_editado']);
        $pf->__set('sexo', $_POST['n_sexo_editado']);
        $pf->__set('idtPF', $_POST['n_idtPF_editado']);
        $pf->__set('fkIdtEndereco', $_POST['n_fkEndereco_editado']);

        // t_pessoa
        $pf->__set('nome', $_POST['n_nome_editado']);
        $pf->__set('email', $_POST['n_email_editado']);
        $pf->__set('telefoneF', $_POST['n_telefone_editado']);
        $pf->__set('idtPessoa', $_POST['n_idtPessoa_editado']);
        $pf->__set('fkIdtPessoa', $_POST['n_fkIdtPessoa_editado']);
    
        if($_FILES['imagem']['error'] == 4) {
            $arquivo = str_replace("../", "", $_POST['manterImg']);
            $arquivo = $arquivo;
            
        } else {
            $arquivo = $this->caminhoImagem($_FILES);
            
        }
        
        $pf->__set('arquivo', $arquivo);
       
        // setta os valores 
        $resultado = $pf->atualizarM($pf);
        if($resultado) {
            header('location: /view/pessoas/listar?atualizar=sucesso');
        } else {
            header('location: /view/pessoas/listar?atualizar=erro');
        }

    }

    function listarPF()
    {
        return ((new PessoaFisica))->listarM();
    }

    function excluirUsuario()
    {
        $pf = new PessoaFisica();

        $pf->__set('idtEndereco', $_POST['idtPessoa']);
        $pf->__set('idtPF', $_POST['idtPf']);
        $pf->__set('fkIdtEndereco', $_POST['fkIdtEndereco']);
        $pf->__set('idtPessoa', $_POST['idtEndereco']);
        $pf->__set('fkIdtPessoa', $_POST['fkIdtPessoa']);
        $resultado = $pf->excluirM($pf);

        if ($resultado == true) {
            header('location: /view/pessoas/listar?excluir=sucesso');
        } else {
            header('location: /view/pessoas/listar?excluir=erro');
        }
    }
}
