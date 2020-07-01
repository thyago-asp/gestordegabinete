<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');

class ModelPessoaVisita
{


    private $nome;
    private $data;
    private $cidade;
    private $comentario;
    private $idVisitas;

    function __set($valor, $atributo)
    {
        $this->$valor = $atributo;
    }

    function __get($atributo)
    {
        return $this->$atributo;
    }

    function cadastrar()
    {

        $con = Conexao::abrirConexao();
        $query = "INSERT INTO t_visitas (nome, data, cidade, comentario) 
                    VALUES (:nome, :data, :cidade, :comentario)";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':data', $this->__get('data'));
        $stmt->bindValue(':cidade', $this->__get('cidade'));
        $stmt->bindValue(':comentario', $this->__get('comentario'));

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function atualizar()
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "UPDATE t_visitas SET nome = :nome, data = :data, cidade = 
                    :cidade, comentario = :comentario WHERE idvisitas = :idVisitas";
            $stmt = $con->prepare($query);

            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':data', $this->__get('data'));
            $stmt->bindValue(':cidade', $this->__get('cidade'));
            $stmt->bindValue(':comentario', $this->__get('comentario'));
            $stmt->bindValue(':idVisitas', $this->__get('idVisitas'));


            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function listarPessoas()
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "SELECT nome FROM t_pessoa";
            $stmt = $con->prepare($query);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function listarCidades()
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "SELECT cidade FROM t_emendas_orcamentarias";
            $stmt = $con->prepare($query);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function listar()
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "SELECT idVisitas, nome, DATE_FORMAT(data, '%d/%m/%Y') AS data, cidade, comentario FROM t_visitas";
            $stmt = $con->prepare($query);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function excluir()
    {

        $con = Conexao::abrirConexao();
        $query = "DELETE FROM t_visitas WHERE idVisitas = :idVisitas";

        $stmt = $con->prepare($query);
        $stmt->bindValue(':idVisitas', $this->__get('idVisitas'));

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
