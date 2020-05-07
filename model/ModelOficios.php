<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');

class ModelOficios
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

    function __set($valor, $atributo)
    {
        $this->$valor = $atributo;
    }

    function __get($atributo)
    {
        return $this->$atributo;
    }

    function salvarModel()
    {

        $con = Conexao::abrirConexao();
        $query = "INSERT INTO t_oficios(numDoc, solicitante, instituicao, 
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
        $query = "SELECT idt_oficios, numDoc, solicitante, instituicao, nome_de_contato,
                    DATE_FORMAT(data_cad_doc, '%d/%m/%Y') AS data_cad_doc, 
                    tipo, titulo, descricao, status 
                  FROM t_oficios";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function atualizarModel()
    {

        $con = Conexao::abrirConexao();
        $query = "UPDATE t_oficios 
                  SET numDoc = :numDoc, solicitante = :solicitante, instituicao = :instituicao,
                      data_cad_doc = :data_cad_doc, nome_de_contato = :nome_de_contato, titulo = :titulo,
                      descricao = :descricao, status = :status  
                  WHERE tipo = :tipo AND idt_oficios = :idt";

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
        $stmt->bindValue(':idt', $this->__get('idt'));

        $stmt->execute();
    }

    function deletarModel()
    {
        $con = Conexao::abrirConexao();

        $query = "DELETE FROM `t_oficios` WHERE idt_oficios = :idt AND tipo = :tipo";
        
        $stmt = $con->prepare($query);

        $stmt->bindValue(':idt', $this->__get('idt'));
        $stmt->bindValue(':tipo', $this->__get('tipo'));

        $stmt->execute();

    }
}
