<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');

class ModelProjetosDeLei
{
    private $idt;
    private $documento;
    private $solicitante;
    private $instituicao;
    private $nomeContato;
    private $titulo;
    private $tipo;
    private $data;
    private $cidade;
    private $descricao;
    private $status;
    private $comentario;
    private $localArquivos;
    private $nomeArquivos;

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

        $query = "INSERT INTO t_arquivos_projetodelei(arquivo_caminho, nome_arquivo, t_projetosdelei_idt_projetosdelei) 
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

        $query = "SELECT MAX(idt_projetosdelei) AS ultimoid FROM t_projetosdelei";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return  $result['ultimoid'];
    }

    function salvarModel()
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "INSERT INTO t_projetosdelei(numDoc, solicitante, instituicao, 
                    nome_de_contato, data_cad_doc, tipo, titulo, descricao, t_emendas_orcamentarias_idt_emendas_orcamentarias, status, data_insert) 
                  VALUES (:numDoc, :solicitante, :instituicao, :nome_de_contato, 
                    :data_cad_doc, :tipo, :titulo, :descricao, :t_emendas_orcamentarias_idt_emendas_orcamentarias,:status, :data_insert)";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':numDoc', $this->__get('documento'));
            $stmt->bindValue(':solicitante', $this->__get('solicitante'));
            $stmt->bindValue(':instituicao', $this->__get('instituicao'));
            $stmt->bindValue(':data_cad_doc', $this->__get('data'));
            $stmt->bindValue(':nome_de_contato', $this->__get('nomeContato'));
            $stmt->bindValue(':tipo', $this->__get('tipo'));
            $stmt->bindValue(':t_emendas_orcamentarias_idt_emendas_orcamentarias', $this->__get('cidade'));
            $stmt->bindValue(':titulo', $this->__get('titulo'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':status', $this->__get('status'));
            date_default_timezone_set('America/Sao_Paulo');
            $stmt->bindValue(':data_insert', date('Y-m-d H:i:s'));

            $retorno = $stmt->execute();

            if ($retorno > 0) {
                $ultimoId = $con->lastInsertId();

                for ($j = 0; $j < count($this->__get('arquivos')['local']); $j++) {
                    $query = "INSERT INTO t_arquivos_projetodelei(arquivo_caminho, nome_arquivo, t_projetosdelei_idt_projetosdelei) 
                    VALUES (:arquivo_caminho, :nome_arquivo, :ultimoid)";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':arquivo_caminho', $this->__get('arquivos')['local'][$j]);
                    $stmt->bindValue(':nome_arquivo', $this->__get('arquivos')['nome'][$j]);
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }

                if ($this->__get('comentario') != "") {
                $query = "INSERT INTO t_comentarios_projetosdelei(comentario, data, t_projetosdelei_idt_projetosdelei) 
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

    function buscarUltimoRegistro(){
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_projetosdelei order by data_insert DESC LIMIT 1;";

        $stmt = $con->prepare($query);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function listarProjetodelei()
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT pro.*, emenda.cidade, DATE_FORMAT(data_cad_doc, '%d/%m/%Y') AS data_cad_doc FROM t_projetosdelei as pro
        left join t_emendas_orcamentarias as emenda
        on emenda.idt_emendas_orcamentarias = pro.t_emendas_orcamentarias_idt_emendas_orcamentarias";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    function listarModel()
    {

        $con = Conexao::abrirConexao();

        $query = "SELECT p.idt_projetosdelei, p.numDoc, p.solicitante, p.instituicao, p.nome_de_contato,
                    DATE_FORMAT(p.data_cad_doc, '%d/%m/%Y') AS data_cad_doc,
                    p.tipo, p.titulo, p.descricao, p.status,
                    GROUP_CONCAT(a.idarquivos SEPARATOR ',')
                    AS idarquivo,
                    GROUP_CONCAT(a.nome_arquivo SEPARATOR ',')
                    AS nomearquivo,
                    GROUP_CONCAT(a.t_projetosdelei_idt_projetosdelei SEPARATOR ',')
                    AS fkprojetosdelei,
                    GROUP_CONCAT(a.arquivo_caminho SEPARATOR ',')
                    AS caminho_arquivo
                    FROM t_projetosdelei AS p
                    LEFT JOIN t_arquivos_projetodelei as a
                    ON (a.t_projetosdelei_idt_projetosdelei = p.idt_projetosdelei) GROUP BY p.idt_projetosdelei";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function atualizarModel()
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "UPDATE t_projetosdelei 
                  SET numDoc = :numDoc, solicitante = :solicitante, instituicao = :instituicao,
                      data_cad_doc = :data_cad_doc, nome_de_contato = :nome_de_contato, titulo = :titulo,
                      descricao = :descricao, t_emendas_orcamentarias_idt_emendas_orcamentarias = :cidade, status = :status  
                  WHERE idt_projetosdelei = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':numDoc', $this->__get('documento'));
            $stmt->bindValue(':solicitante', $this->__get('solicitante'));
            $stmt->bindValue(':instituicao', $this->__get('instituicao'));
            $stmt->bindValue(':data_cad_doc', $this->__get('data'));
            $stmt->bindValue(':nome_de_contato', $this->__get('nomeContato'));
            $stmt->bindValue(':cidade', $this->__get('cidade'));        
            $stmt->bindValue(':titulo', $this->__get('titulo'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':status', $this->__get('status'));
            $stmt->bindValue(':idt', $this->__get('idt'));
            
            $retorno = $stmt->execute();
           
            if ($retorno > 0) {
                $ultimoId = $this->__get('idt');
                
                for ($j = 0; $j < count($this->__get('arquivos')['local']); $j++) {
                    $query = "INSERT INTO t_arquivos_projetodelei(arquivo_caminho, nome_arquivo, t_projetosdelei_idt_projetosdelei) 
                VALUES (:arquivo_caminho, :nome_arquivo, :ultimoid)";

                    $stmt = $con->prepare($query);
                   
                    $stmt->bindValue(':arquivo_caminho', $this->__get('arquivos')['local'][$j]);
                    $stmt->bindValue(':nome_arquivo', $this->__get('arquivos')['nome'][$j]);
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }
                if ($this->__get('comentario') != "") {
                $query = "INSERT INTO t_comentarios_projetosdelei(comentario, data, t_projetosdelei_idt_projetosdelei) 
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
        $query = "SELECT * FROM t_arquivos_projetodelei WHERE t_projetosdelei_idt_projetosdelei = :fkidt";

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
            $query = "DELETE FROM `t_projetosdelei` WHERE idt_projetosdelei = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':idt', $this->__get('idt'));
         

            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function deletarComentario()
    {
        try {
            $con = Conexao::abrirConexao();

            $query = "DELETE FROM `t_comentarios_projetosdelei` WHERE idt_comentarios_projetosdelei = :idt";

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

            $query = "DELETE FROM `t_arquivos_projetodelei` WHERE idarquivos = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':idt', $this->__get('idt'));

            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
}
