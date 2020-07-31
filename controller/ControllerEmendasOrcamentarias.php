<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/ModelEmendasOrcamentarias.php');


if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {

        case 'salvar':

            (new ControllerEmendasOrcamentarias())->salvarEmendas();
            break;
        case 'alterar':

            (new ControllerEmendasOrcamentarias())->alterar();
            break;
        case 'atualizarEmenda':

            (new ControllerEmendasOrcamentarias())->atualizarEmendas();
            break;
        case 'deletar':

            (new ControllerEmendasOrcamentarias())->deletarEmendas();
            break;
        case 'deletarAnexo':

            (new ControllerEmendasOrcamentarias())->deletarAnexo();
            break;
        case 'buscarCidade':

            (new ControllerEmendasOrcamentarias())->buscarCidade();
            break;

        case 'registrarVisita':

            (new ControllerEmendasOrcamentarias())->registrarVisita();
            break;
        case 'comentario':

            (new ControllerEmendasOrcamentarias())->addComentarios();
            break;
        case 'deletarComentario':

            (new ControllerEmendasOrcamentarias())->deletarComentario();
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

    public function addComentarios()
    {
        $emendas = new ModelEmendasOrcamentarias();

        $retorno = $emendas->addComentario($_REQUEST["comentario"], $_REQUEST["idEmenda"]);

        if ($retorno) {
            header('location: /view/emendasOrcamentarias/cidades/?id=' . $_REQUEST["idEmenda"] . '&r=comentarioSucesso');
        }
        return $retorno;
    }

    function deletarEmendas()
    {

        $deletar = new ModelEmendasOrcamentarias();

        $deletar->__set('idt', $_POST['idteme']);

        $retorno = $deletar->deletarModel($deletar);

        if ($retorno) {
            header("location: /view/emendasOrcamentarias/listar/?excluir=sucesso");
        }
    }

    function deletarComentario()
    {

        $deletar = new ModelEmendasOrcamentarias();

        $deletar->__set('idt', $_POST['idteme']);

        $deletar->deletarComentario($deletar);

        header("location: /view/emendasORcamentarias/listar/?excluirComentario=sucesso");
    }

    function deletarAnexo()
    {

        $deletar = new ModelEmendasOrcamentarias();

        $deletar->__set('idt', $_POST['idteme']);
        $caminho_arquivo = $_POST['caminho_arquivo'];
        $retorno = $deletar->deletarAnexo($deletar);

        if ($retorno) {
            if (unlink($caminho_arquivo)) {

                header("location: /view/emendasOrcamentarias/listar?excluirAnexo=sucesso");
            }
        }
    }

    function atualizarEmendas()
    {
        $atualizar = new ModelEmendasOrcamentarias();

        $atualizar->__set('tipo_emenda', $_POST['tipo_emenda']);
        $atualizar->__set('documento', $_POST['documento']);
        $atualizar->__set('solicitante', $_POST['solicitante']);
        $atualizar->__set('beneficiario', $_POST['beneficiario']);
        $atualizar->__set('nomeContato', $_POST['nomeContato']);
        $atualizar->__set('valor', $_POST['valor']);
        // Titulo = Assunto
        $atualizar->__set('titulo', $_POST['titulo']);
        $atualizar->__set('data', $_POST['dataDocumento']);
        $atualizar->__set('descricao', $_POST['descricao']);
        $atualizar->__set('status', $_POST['status']);
        if ($_POST['cidade'] == "") {
            $atualizar->__set('cidade', null);
        } else {
            $atualizar->__set('cidade', $_POST['cidade']);
        }
        $atualizar->__set('tipo', $_POST['tipo']);
        $atualizar->__set('idt', $_POST['idteme']);
        $atualizar->__set('comentario', $_POST['comentario']);
        $atualizar->__set('arquivos', $this->arquivos($_FILES));

        $retorno = $atualizar->atualizarModel();

        if ($retorno == 1) {
            header("location: /view/emendasOrcamentarias/listar/?atualizar=sucesso");
        }
    }

    public function listarComentarios($id)
    {
        $emendas = new ModelEmendasOrcamentarias();

        $retorno = $emendas->listarComentarios($id);


        return $retorno;
    }

    public function buscarCidade()
    {
        $emendas = new ModelEmendasOrcamentarias();

        $listaEmendas = $emendas->pesquisarCidade($_REQUEST["cidade"]);

        echo json_encode($listaEmendas);
        return;
    }

    public function registrarVisita()
    {
        $emendas = new ModelEmendasOrcamentarias();

        $resultado = $emendas->registrarVisita($_REQUEST["idDataVisita"], $_REQUEST["idCidadeHidden"]);

        if ($resultado) {
            header('location: /view/emendasOrcamentarias/cidades/?id=' . $_REQUEST["idCidadeHidden"] . '&cad=sucesso');
        }
    }

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
    function arquivos($arq)
    {

        $extencoes = [
            'pdf',
            'doc',
            'docx',
            'png',
            'jpg',
            'xlsx',
            'xls'
        ];

        $dir = "../arq/";

        $arqNome = [];
        $arqLocal = [];
        $tdsArquivos = [];
        $qtdArquivos = count($arq['arquivos']['name']);

        $cont = 0;
        while ($cont < $qtdArquivos) {
            //echo $arq['arquivos']['name'][$cont];
            $arqExtencao = pathinfo(strtolower($arq['arquivos']['name'][$cont]), PATHINFO_EXTENSION);
            $arqNome[] = pathinfo(strtolower($arq['arquivos']['name'][$cont]), PATHINFO_FILENAME);
            if (in_array($arqExtencao, $extencoes)) {

                $temp = $arq['arquivos']['tmp_name'][$cont];
                $novoNome = uniqid() . ".$arqExtencao";
                $dirImg = $dir . $novoNome;
                move_uploaded_file($temp, $dirImg);
                $arqLocal[] = $dirImg;
            }
            $cont++;
        }
        return $tdsArquivos[] = ["local" => $arqLocal, "nome" => $arqNome];
    }

    function listarEmendas()
    {
        $lista = (new ModelEmendasOrcamentarias())->listarEmendas();


        return $lista;
    }

    function salvarEmendas()
    {
        $salvar = new ModelEmendasOrcamentarias();
        //print_r($_POST['tipo']);
        $salvar->__set('tipo_emenda', $_POST['tipo_emenda']);
        $salvar->__set('documento', $_POST['documento']);
        $salvar->__set('solicitante', $_POST['solicitante']);
        $salvar->__set('beneficiario', $_POST['beneficiario']);
        $salvar->__set('nomeContato', $_POST['nomeContato']);


        if ($_POST['cidade'] == "") {
            $salvar->__set('cidade', null);
        } else {
            $salvar->__set('cidade', $_POST['cidade']);
        }
        $salvar->__set('valor', $_POST['valor']);
        // Assunto passou a se chamar TITULO
        $salvar->__set('titulo', $_POST['titulo']);

        $salvar->__set('data', $_POST['dataPedido']);
        $salvar->__set('descricao', $_POST['descricao']);
        $salvar->__set('status', $_POST['status']);

        $salvar->__set('comentario', $_POST['comentario']);
        $arq = $this->arquivos($_FILES);

        if ($arq == false) {
            header("location: /view/emendasOrcamentarias/cadastrar/?cadastrar=sucesso");
        }

        $salvar->__set('arquivos', $arq);

        $retorno = $salvar->salvarModel($salvar);
        if ($retorno == 1) {
            header("location: /view/emendasOrcamentarias/cadastrar/?cadastrar=sucesso");
        }
    }

    public function buscarEstruturaPartido($id)
    {
        $emendas = new ModelEmendasOrcamentarias();

        $listaVisitas = $emendas->buscarEstruturaPartido($id);

        return $listaVisitas;
    }
    public function buscarItensRecursos($id)
    {
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
