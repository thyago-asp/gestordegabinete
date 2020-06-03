<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/ModelOficios.php');

if (isset($_GET['acao'])) {
    switch ($_GET['acao']) {

        case 'salvar':
            (new ControllerOficios())->salvarOficios();
            break;
        case 'atualizar':
            (new ControllerOficios())->atualizarOficios();
            break;

        case 'listar':
            (new ControllerOficios())->listarOficios();
            break;

        case 'deletar':
            (new ControllerOficios())->deletarOficios();
            break;
    }
}

class ControllerOficios
{
    function arquivos($arq)
    {

        $extencoes = [
            'pdf',
            'doc',
            'docx',
            'png', 
            'jpg'
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

                $cont++;
            }
        }
        return $tdsArquivos[] = ["local" => $arqLocal, "nome" => $arqNome];
    }

    function salvarOficios()
    {

        $salvar = new ModelOficios();

        $salvar->__set('documento', $_POST['documento']);
        $salvar->__set('solicitante', $_POST['solicitante']);
        $salvar->__set('instituicao', $_POST['instituicao']);
        $salvar->__set('nomeContato', $_POST['nomeContato']);
        $salvar->__set('titulo', $_POST['titulo']);
        $salvar->__set('data', $_POST['dataPedido']);
        $salvar->__set('descricao', $_POST['descricao']);
        $salvar->__set('status', $_POST['status']);
        $salvar->__set('tipo', $_POST['pagina']);

        $salvar->__set('arquivos', $this->arquivos($_FILES));


        $retorno = $salvar->salvarModel($salvar);
        
        if ($retorno == 1) {
            header("location: /view/oficios/cadastrar?pg={$_POST['pagina']}&cadastrar=sucesso");
        }
    }
    function atualizarOficios()
    {

        $atualizar = new ModelOficios();

        $atualizar->__set('documento', $_POST['documento']);
        $atualizar->__set('solicitante', $_POST['solicitante']);
        $atualizar->__set('instituicao', $_POST['instituicao']);
        $atualizar->__set('nomeContato', $_POST['nomeContato']);
        $atualizar->__set('titulo', $_POST['titulo']);
        $atualizar->__set('data', $_POST['dataDocumento']);
        $atualizar->__set('descricao', $_POST['descricao']);
        $atualizar->__set('status', $_POST['status']);
        $atualizar->__set('tipo', $_POST['tipo']);
        $atualizar->__set('idt', $_POST['idtofi']);

        $retorno = $atualizar->atualizarModel();

        if ($retorno == 1) {
            header("location: /view/oficios/listar?pg={$_POST['tipo']}&atualizar=sucesso");
        }
    }
    function listarOficios()
    {
        $lista_oficios = (new ModelOficios())->listarOficios();

        return $lista_oficios;
        /* $lista = (new ModelOficios())->listarModel();
        if (isset($lista[0]['nomearquivo'])) {

            foreach ($lista as $key => $value) {
                $nome = explode(',', $value['nomearquivo']);
                $idarquivo = explode(',', $value['idarquivo']);
                $fkprojetosdelei = explode(',', $value['fkrequerimentos']);
                $link = explode(',', $value['caminho_arquivo']);
                $a['arquivos'] = [
                    "nome" => $nome,
                    "idArquivo" => $idarquivo,
                    "fkArquivo" => $fkprojetosdelei,
                    "linkArq" => $link
                ];

                array_push($lista[$key], $a);
            }
            return $lista;
        } else {
            return $lista;
        }*/
    }
    function deletarOficios()
    {

        $deletar = new ModelOficios();

        $deletar->__set('idt', $_POST['idtofi']);
        $deletar->__set('tipo', $_POST['tipo']);

        $retorno = $deletar->deletarModel($deletar);

        if ($retorno == 1) {
            header("location: /view/oficios/listar?pg={$_POST['tipo']}&excluir=sucesso");
        }
    }
}
