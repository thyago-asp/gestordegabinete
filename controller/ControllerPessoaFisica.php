<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Usuario.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/Crud.php');


if (isset($_REQUEST["acao"])) {
 
    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerPessoaFisica())->cadastrar();
            break;

        case 'alterar':

           // (new ControllerPessoa())->alterar();
            break;

        case 'excluirUsuario':
           // (new ControllerPessoa())->excluirUsuario();
            break;
    }
}


class ControllerPessoaFisica
{

    
    public function cadastrar(){
    $pf = new PessoaFisica();
       
    $_POST["nome"];
       $_POST["email"];
       $_POST["telefone"];
       $_POST["sexo"];
       $_POST["datadenascimento"];
        //endereco
        $_POST["cep"];
        $_POST["logradouro"];
        $_POST["numero"];
        $_POST["complemento"];
        $_POST["bairro"];
        $_POST["cidade"];
        $_POST["estado"];
        $_POST["categoria"];
    }
}
