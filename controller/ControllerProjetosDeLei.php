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
            'png'
        ];

        $dir = "../bancodedados/arq/";

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
            } else {

                return "arquivo invalido";
            }
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
        $salvar->__set('tipo', $_POST['pagina']);

        $salvar->__set('arquivos', $this->arquivos($_FILES));

        $salvar->salvarModel($salvar);

        $ciclo = count($salvar->arquivos['local']);
        $contador = 0;
        while ($contador < $ciclo) {

            $arquivos[] = [$salvar->arquivos['local'][$contador], $salvar->arquivos['nome'][$contador]];

            $salvar->__set('localArquivos', $arquivos[$contador][0]);
            $salvar->__set('nomeArquivos', $arquivos[$contador][1]);
            $salvar->salvarArquivos();
            $contador++;
        }



        header("location: /view/ProjetosDeLei/cadastrar?pg={$_POST['pagina']}&cadastrar=sucesso");
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
        $atualizar->__set('idt', $_POST['idtReq']);

        $atualizar->atualizarModel();
        header("location: /view/ProjetosDeLei/listar?pg={$_POST['tipo']}&atualizar=sucesso");
    }
    function listarProjetosDeLei()
    {
        $lista = (new ModelProjetosDeLei())->listarModel();
        if (isset($lista[0]['nomearquivo'])) {

            foreach ($lista as $key => $value) {
                $nome = explode(',', $value['nomearquivo']);
                $idarquivo = explode(',', $value['idarquivo']);
                $fkprojetosdelei = explode(',', $value['fkprojetosdelei']);
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
        }
    }
    function deletarProjetosDeLei()
    {
        print_r($_POST);
        $deletar = new ModelProjetosDeLei();

        $deletar->__set('idt', $_POST['idtReq']);
        $deletar->__set('tipo', $_POST['tipo']);

        $deletar->deletarModel($deletar);
        header("location: /view/ProjetosDeLei/listar?pg={$_POST['tipo']}&excluir=sucesso");
    }
}
