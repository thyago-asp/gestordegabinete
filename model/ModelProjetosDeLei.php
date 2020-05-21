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
    private $descricao;
    private $status;
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

    function salvarArquivos() {
    
        $con = Conexao::abrirConexao();

        $query = "INSERT INTO t_arquivos_projetosdelei(arquivo_caminho, nome_arquivo, t_projetosdelei_idt_projetosdelei) 
                    VALUES (:arquivo_caminho, :nome_arquivo, :ultimoid)";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':arquivo_caminho', $this->__get('localArquivos'));
        $stmt->bindValue(':nome_arquivo', $this->__get('nomeArquivos'));
        $stmt->bindValue(':ultimoid', $this->selecionarId());
        
        $stmt->execute();

    } 

    function selecionarId() {
        $con = Conexao::abrirConexao();

        $query = "SELECT MAX(idt_projetosdelei) AS ultimoid FROM t_projetosdelei";
        
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return  $result['ultimoid'];
    }

    function salvarModel()
    {

        $con = Conexao::abrirConexao();
        $query = "INSERT INTO t_projetosdelei(numDoc, solicitante, instituicao, 
                    nome_de_contato, data_cad_doc, tipo, titulo, descricao, status) 
                  VALUES (:numDoc, :solicitante, :instituicao, :nome_de_contato, 
                    :data_cad_doc, :tipo, :titulo, :descricao, :status)";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':numDoc', $this->__get('documento'));
        $stmt->bindValue(':solicitante', $this->__get('solicitante'));
        $stmt->bindValue(':instituicao', $this->__get('instituicao'));
        $stmt->bindValue(':data_cad_doc', $this->__get('data'));
        $stmt->bindValue(':nome_de_contato', $this->__get('nomeContato'));
        $stmt->bindValue(':tipo', $this->__get('tipo'));
        $stmt->bindValue(':titulo', $this->__get('titulo'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':status', $this->__get('status'));
        
        $stmt->execute();

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
                    FROM t_projetosDeLei AS p
                    LEFT JOIN t_arquivos_projetodelei as a
                    ON (a.t_projetosdelei_idt_projetosdelei = p.idt_projetosdelei) GROUP BY p.idt_projetosdelei";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function atualizarModel()
    {

        $con = Conexao::abrirConexao();
        $query = "UPDATE t_projetosdelei 
                  SET numDoc = :numDoc, solicitante = :solicitante, instituicao = :instituicao,
                      data_cad_doc = :data_cad_doc, nome_de_contato = :nome_de_contato, titulo = :titulo,
                      descricao = :descricao, status = :status  
                  WHERE tipo = :tipo AND idt_oficios = :idt";

        $stmt = $con->prepare($query);

        print_r($this->__get('data'));
        $stmt->bindValue(':numDoc', $this->__get('documento'));
        $stmt->bindValue(':solicitante', $this->__get('solicitante'));
        $stmt->bindValue(':instituicao', $this->__get('instituicao'));
        $stmt->bindValue(':data_cad_doc', $this->__get('data'));
        $stmt->bindValue(':nome_de_contato', $this->__get('nomeContato'));
        $stmt->bindValue(':tipo', $this->__get('tipo'));
        $stmt->bindValue(':titulo', $this->__get('titulo'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':status', $this->__get('status'));
        $stmt->bindValue(':idt', $this->__get('idt'));

        $stmt->execute();
    }

    function deletarModel()
    {
        $con = Conexao::abrirConexao();

        $query = "DELETE FROM `t_projetosdelei` WHERE idt_oficios = :idt AND tipo = :tipo";
        
        $stmt = $con->prepare($query);

        $stmt->bindValue(':idt', $this->__get('idt'));
        $stmt->bindValue(':tipo', $this->__get('tipo'));

        $stmt->execute();

    }
}
