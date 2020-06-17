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

    }
}

/**
 * Description of ControllerEmendasOrcamentarias
 *
 * @author Thyago
 */
class ControllerEmendasOrcamentarias
{
   

    public function listarCidades()
    {
        $emendas = new ModelEmendasOrcamentarias();
        
        $listaEmendas = $emendas->listar();
        
        return $listaEmendas;
    }

    public function buscarCidades($id)
    {
        $emendas = new ModelEmendasOrcamentarias();
        
        $listaEmendas = $emendas->buscarCidade($id);
        
        return $listaEmendas;
    }

    public function buscarRecursos($id)
    {
        $emendas = new ModelEmendasOrcamentarias();
        
        $listaRecursos = $emendas->buscarRecursos($id);
        
        return $listaRecursos;
    }

    public function buscarVisitas($id)
    {
        $emendas = new ModelEmendasOrcamentarias();
        
        $listaVisitas = $emendas->buscarVisitas($id);
        
        return $listaVisitas;
    }

    public function buscarEstruturaPartido($id)
    {
        $emendas = new ModelEmendasOrcamentarias();
        
        $listaVisitas = $emendas->buscarEstruturaPartido($id);
        
        return $listaVisitas;
    }
    public function buscarItensRecursos($id){
        $emendas = new ModelEmendasOrcamentarias();
        
        $listaItensRecursos = $emendas->buscarItensRecursos($id);
        
        return $listaItensRecursos;
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
    
}
