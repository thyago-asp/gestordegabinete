<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/ModelEmendasOrcamentarias.php');


if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerUsuario())->cadastrar();
            break;
        case 'log':

            (new ControllerUsuario())->login();
            break;

        case 'alterar':

            (new ControllerEmendasOrcamentarias())->alterar();
            break;
        case 'resetar':

            (new ControllerEmendasOrcamentarias())->resetarSenha();
            break;
        case 'alterarSenha':
            (new ControllerEmendasOrcamentarias())->altararSenha();
            break;
        case 'excluirUsuario':
                (new ControllerEmendasOrcamentarias())->excluirUsuario();
                break;
    }
}

/**
 * Description of ControlUsuario
 *
 * @author Thyago
 */
class ControllerEmendasOrcamentarias
{
    //put your code here

    function cadastrar()
    {

    }

    public function listarCidades()
    {
        $emendas = new ModelEmendasOrcamentarias();
        
        $listaEmendas = $emendas->listar();
        
        return $listaEmendas;
    }

    public function alterar()
    {

        $usuario = new Usuario();

        $usuario->setId_usuario($_POST["id_usuario"]);
        $usuario->setNome($_POST["n_nome_editado"]);
        $usuario->setPerfil($_POST["n_perfil_editado"]);

        $result = $usuario->alterar($usuario);

        if ($result > 0) {

            if ($_SESSION["id_usuario"] == $_POST["id_usuario"]) {

                $_SESSION["nome"] = $_POST["n_nome_editado"];
                $_SESSION["perfil"] = $_POST["n_perfil_editado"];
            }

            header("Location:/view/usuariosdosistema/listar/?r=1");
        }
    }
    
    public function resetarSenha()
    {
        $idUsuario = $_REQUEST["id_usuario"];

        $usuario = new Usuario();

        $retorno = $usuario->resetarSenha($idUsuario);

        if ($retorno > 0) {
            header("Location:/view/usuariosdosistema/listar/?r=2");
        }
    }

    public function altararSenha()
    {
        $idUsuario = $_SESSION["id_usuario"];
        $senha = $_REQUEST["senha1"];

        $usuario = new Usuario();

        $usuario->setId_usuario($idUsuario);
        $usuario->setSenha(md5($senha));

        $retorno = $usuario->alterarSenha($usuario);

        if ($retorno > 0) {
            $_SESSION["primeiro_acesso"] = "0";
            header("Location:/view/main?r=1");
        }
    }

    public function excluirUsuario(){

        $idUsuario = $_REQUEST["id_usuario"];

        $usuario = new Usuario();

        $usuario->setId_usuario($idUsuario);

        $retorno = $usuario->excluirUsuario($usuario);

        if ($retorno > 0) {
            header("Location:/view/usuariosdosistema/listar/?r=3");
        }

    }
}
