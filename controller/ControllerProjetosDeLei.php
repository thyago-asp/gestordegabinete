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
        $salvar->__set('tipo', $_POST['tipo']);

        $salvar->__set('arquivos', $this->arquivos($_FILES));

        $retorno = $salvar->salvarModel($salvar);
        if ($retorno == 1) {
            header("location: /view/projetosDeLei/cadastrar?pg={$_POST['tipo']}&cadastrar=sucesso");
        }
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
        $atualizar->__set('idt', $_POST['idtpro']);

        $retorno = $atualizar->atualizarModel();

        if ($retorno == 1) {
            header("location: /view/projetosDeLei/listar?pg={$_POST['tipo']}&atualizar=sucesso");
        }
    }
    function listarProjetosDeLei()
    {
        $lista_projetodelei = (new ModelProjetosDeLei())->listarProjetodelei();

        return $lista_projetodelei;
    }
    function deletarProjetosDeLei()
    {

        $deletar = new ModelProjetosDeLei();

        $deletar->__set('idt', $_POST['idtpro']);
        $deletar->__set('tipo', $_POST['tipo']);

        $retorno = $deletar->deletarModel($deletar);
        if ($retorno == 1) {
            header("location: /view/projetosDeLei/listar?pg={$_POST['tipo']}&excluir=sucesso");
        }
    }
}
