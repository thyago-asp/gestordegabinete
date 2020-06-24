<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/ModelRequerimentos.php');

if (isset($_GET['acao'])) {
    switch ($_GET['acao']) {

        case 'salvar':
            (new ControllerRequerimentos())->salvarRequerimentos();
            break;
        case 'atualizar':
            (new ControllerRequerimentos())->atualizarRequerimentos();
            break;

        case 'listar':
            (new ControllerRequerimentos())->listarRequerimentos();
            break;

        case 'deletar':
            (new ControllerRequerimentos())->deletarRequerimentos();
            break;
    }
}

class ControllerRequerimentos
{

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

        $dir = "../bancodedados/arq/";

        $arqNome = [];
        $arqLocal = [];
        $tdsArquivos = null;
        $qtdArquivos = count($arq['arquivos']['name']);

        $cont = 0;
        while ($cont < $qtdArquivos) {

            $arqExtencao = pathinfo(strtolower($arq['arquivos']['name'][$cont]), PATHINFO_EXTENSION);
            $arqNome[] = pathinfo(strtolower($arq['arquivos']['name'][$cont]), PATHINFO_FILENAME);
            if (in_array($arqExtencao, $extencoes)) {

                $temp = $arq['arquivos']['tmp_name'][$cont];
                $novoNome = uniqid() . ".$arqExtencao";
                $dirImg = $dir . $novoNome;
                
                move_uploaded_file($temp, $dirImg);
                

                
            }
            $arqLocal[] = $dirImg;
            $cont++;
        }
        echo "<pre>";
        print_r($arqLocal);
        print_r($arqNome);
         ($tdsArquivos = ["local" => $arqLocal, "nome" => $arqNome]);
        
         return $tdsArquivos;
    }

    function salvarRequerimentos()
    {
        $salvar = new ModelRequerimentos();
        //print_r($_POST['tipo']);
        $salvar->__set('documento', $_POST['documento']);
        $salvar->__set('solicitante', $_POST['solicitante']);
        $salvar->__set('instituicao', $_POST['instituicao']);
        $salvar->__set('nomeContato', $_POST['nomeContato']);
        $salvar->__set('titulo', $_POST['titulo']);
        $salvar->__set('data', $_POST['dataPedido']);
        $salvar->__set('descricao', $_POST['descricao']);
        $salvar->__set('status', $_POST['status']);
        $salvar->__set('tipo', $_POST['tipo']);
        $arq = $this->arquivos($_FILES);
        if($arq == false) {
            header("location: /view/requerimentos/cadastrar?pg={$_POST['tipo']}&cadastrar=sucesso");
        }
    
        $salvar->__set('arquivos', $arq);

        $retorno = $salvar->salvarModel($salvar);
        if ($retorno == 1) {
            header("location: /view/requerimentos/cadastrar?pg={$_POST['tipo']}&cadastrar=sucesso");
        }
    }
    function atualizarRequerimentos()
    {
        $atualizar = new ModelRequerimentos();

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

        $retorno = $atualizar->atualizarModel();

        if ($retorno == 1) {
            header("location: /view/requerimentos/listar?pg={$_POST['tipo']}&atualizar=sucesso");
        }
    }
    function listarRequerimentos()
    {
        $lista_requerimentos = (new ModelRequerimentos())->listarRequerimentos();

        return $lista_requerimentos;
    }
    function deletarRequerimentos()
    {

        $deletar = new ModelRequerimentos();

        $deletar->__set('idt', $_POST['idtReq']);
        $deletar->__set('tipo', $_POST['tipo']);
        $retorno = $deletar->deletarModel($deletar);

        if ($retorno == 1) {
            header("Location: /view/requerimentos/listar?pg={$_POST['tipo']}&excluir=sucesso");
        }
    }
}
