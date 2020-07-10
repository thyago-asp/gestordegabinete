<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');

class ModelRequerimentos
{
    private $idt;
    private $documento;
    private $solicitante;
    private $instituicao;
    private $nomeContato;
    private $titulo;
    private $cidade;
    private $tipo;
    private $data;
    private $descricao;
    private $status;
    private $localArquivos;
    private $nomeArquivos;
    private $idtArq;

    function __set($valor, $atributo)
    {
        $this->$valor = $atributo;
    }

    function __get($atributo)
    {
        return $this->$atributo;
    }

    function salvarArquivos()
    {

        $con = Conexao::abrirConexao();

        $query = "INSERT INTO t_arquivos_requerimentos(arquivo_caminho, nome_arquivo, t_requerimentos_idt_requerimentos) 
                    VALUES (:arquivo_caminho, :nome_arquivo, :ultimoid)";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':arquivo_caminho', $this->__get('localArquivos'));
        $stmt->bindValue(':nome_arquivo', $this->__get('nomeArquivos'));
        $stmt->bindValue(':ultimoid', $this->selecionarId());

        $stmt->execute();
    }
    function selecionarId()
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT MAX(idt_requerimentos) AS ultimoid FROM t_requerimentos";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return  $result['ultimoid'];
    }

    function salvarModel($requerimento)
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "INSERT INTO t_requerimentos(numDoc, solicitante, instituicao, 
                    nome_de_contato, data_cad_doc, tipo, titulo, descricao, t_emendas_orcamentarias_idt_emendas_orcamentarias, status) 
                  VALUES (:numDoc, :solicitante, :instituicao, :nome_de_contato, 
                    :data_cad_doc, :tipo, :titulo, :descricao, :t_emendas_orcamentarias_idt_emendas_orcamentarias, :status)";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':numDoc', $requerimento->__get('documento'));
            $stmt->bindValue(':solicitante', $requerimento->__get('solicitante'));
            $stmt->bindValue(':instituicao', $requerimento->__get('instituicao'));
            $stmt->bindValue(':data_cad_doc', $requerimento->__get('data'));
            $stmt->bindValue(':nome_de_contato', $requerimento->__get('nomeContato'));
            $stmt->bindValue(':tipo', $requerimento->__get('tipo'));
            $stmt->bindValue(':titulo', $requerimento->__get('titulo'));
            $stmt->bindValue(':descricao', $requerimento->__get('descricao'));
            $stmt->bindValue(':t_emendas_orcamentarias_idt_emendas_orcamentarias', $requerimento->__get('cidade'));
            $stmt->bindValue(':status', $requerimento->__get('status'));


            $retorno = $stmt->execute();

            if ($retorno > 0) {
                $ultimoId = $con->lastInsertId();

                for ($j = 0; $j < count($this->__get('arquivos')['local']); $j++) {
                    $query = "INSERT INTO t_arquivos_requerimentos(arquivo_caminho, nome_arquivo, t_requerimentos_idt_requerimentos) 
                    VALUES (:arquivo_caminho, :nome_arquivo, :ultimoid)";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':arquivo_caminho', $this->__get('arquivos')['local'][$j]);
                    $stmt->bindValue(':nome_arquivo', $this->__get('arquivos')['nome'][$j]);
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }

                if ($this->__get('comentario') != "") {
                    $query = "INSERT INTO t_comentarios_requerimentos(comentario, data, t_requerimentos_idt_requerimentos) 
                VALUES (:comentario, :data, :ultimoid)";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':comentario', $this->__get('comentario'));
                    date_default_timezone_set('America/Sao_Paulo');
                    $stmt->bindValue(':data', date('Y-m-d H:i:s'));
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }
            }
            return 1;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function listarRequerimentos()
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT req.*, emenda.cidade, DATE_FORMAT(data_cad_doc, '%d/%m/%Y') AS data_cad_doc FROM t_requerimentos as req
        left join t_emendas_orcamentarias as emenda
        on emenda.idt_emendas_orcamentarias = req.t_emendas_orcamentarias_idt_emendas_orcamentarias";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    function listarModel()
    {

        $con = Conexao::abrirConexao();
        $query = "SELECT p.idt_requerimentos, p.numDoc, p.solicitante, p.instituicao, p.nome_de_contato,
                    DATE_FORMAT(p.data_cad_doc, '%d/%m/%Y') AS data_cad_doc,
                    p.tipo, p.titulo, p.descricao, p.status,
                    GROUP_CONCAT(a.idarquivos SEPARATOR ',')
                    AS idarquivo,
                    GROUP_CONCAT(a.nome_arquivo SEPARATOR ',')
                    AS nomearquivo,
                    GROUP_CONCAT(a.t_requerimentos_idt_requerimentos SEPARATOR ',')
                    AS fkrequerimentos,
                    GROUP_CONCAT(a.arquivo_caminho SEPARATOR ',')
                    AS caminho_arquivo
                    FROM t_requerimentos AS p
                    LEFT JOIN t_arquivos_requerimentos as a
                    ON (a.t_requerimentos_idt_requerimentos = p.idt_requerimentos) GROUP BY p.idt_requerimentos";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function atualizarModel()
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "UPDATE t_requerimentos 
                  SET numDoc = :numDoc, solicitante = :solicitante, instituicao = :instituicao,
                      data_cad_doc = :data_cad_doc, nome_de_contato = :nome_de_contato, titulo = :titulo,
                      descricao = :descricao, t_emendas_orcamentarias_idt_emendas_orcamentarias = :cidade, status = :status  
                  WHERE tipo = :tipo AND idt_requerimentos = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':numDoc', $this->__get('documento'));
            $stmt->bindValue(':solicitante', $this->__get('solicitante'));
            $stmt->bindValue(':instituicao', $this->__get('instituicao'));
            $stmt->bindValue(':data_cad_doc', $this->__get('data'));
            $stmt->bindValue(':nome_de_contato', $this->__get('nomeContato'));
            $stmt->bindValue(':tipo', $this->__get('tipo'));
            $stmt->bindValue(':titulo', $this->__get('titulo'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':cidade', $this->__get('cidade'));
            $stmt->bindValue(':status', $this->__get('status'));
            $stmt->bindValue(':idt', $this->__get('idt'));

            $retorno = $stmt->execute();

            if ($retorno > 0) {
                $ultimoId = $this->__get('idt');

                for ($j = 0; $j < count($this->__get('arquivos')['local']); $j++) {
                    $query = "INSERT INTO t_arquivos_requerimentos(arquivo_caminho, nome_arquivo, t_requerimentos_idt_requerimentos) 
                VALUES (:arquivo_caminho, :nome_arquivo, :ultimoid)";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':arquivo_caminho', $this->__get('arquivos')['local'][$j]);
                    $stmt->bindValue(':nome_arquivo', $this->__get('arquivos')['nome'][$j]);
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }
                if ($this->__get('comentario') != "") {
                    $query = "INSERT INTO t_comentarios_requerimentos(comentario, data, t_requerimentos_idt_requerimentos) 
                VALUES (:comentario, :data, :ultimoid)";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':comentario', $this->__get('comentario'));
                    date_default_timezone_set('America/Sao_Paulo');
                    $stmt->bindValue(':data', date('Y-m-d H:i:s'));
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }
            }
            return 1;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
    function arqExcluir($idt)
    {

        $con = Conexao::abrirConexao();
        $query = "SELECT * FROM t_arquivos_requerimentos WHERE t_requerimentos_idt_requerimentos = :fkidt";

        $stmt = $con->prepare($query);
        $stmt->bindValue('fkidt', $idt);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $chave => $valor) {
            unlink($valor['arquivo_caminho']);
        }
    }
    function deletarModel()
    {
        try {
            $con = Conexao::abrirConexao();
            $this->arqExcluir($this->__get('idt'));

            $query = "DELETE FROM t_requerimentos
                    WHERE idt_requerimentos = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':idt', $this->__get('idt'));

            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
    function deletarComentario()
    {
        try {
            $con = Conexao::abrirConexao();

            $query = "DELETE FROM `t_comentarios_requerimentos` WHERE idt_comentarios_requerimentos = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':idt', $this->__get('idt'));

            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function deletarAnexo()
    {
        try {
            $con = Conexao::abrirConexao();

            $query = "DELETE FROM `t_arquivos_requerimentos` WHERE idarquivos = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':idt', $this->__get('idt'));

            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
}
