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

        $con = Conexao::abrirConexao();
        $query = "UPDATE t_visitas SET nome = :nome, data = :data, cidade = 
                    :cidade, comentario = :comentario WHERE idVisitas = :idVisitas";
        $stmt = $con->prepare($query);

        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':data', $this->__get('data'));
        $stmt->bindValue(':cidade', $this->__get('cidade'));
        $stmt->bindValue(':comentario', $this->__get('comentario'));
        $stmt->bindValue(':idVisitas', $this->__get('idVisitas'));

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function listar()
    {
        $con = Conexao::abrirConexao();
        $query = "SELECT idVisitas, nome, DATE_FORMAT(data, '%d/%m/%Y') AS data, cidade, comentario FROM t_visitas";
        $stmt = $con->prepare($query);
        try {
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
