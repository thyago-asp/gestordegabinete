<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PessoaFisica
 *
 * @author Thyago
 */
class PessoaFisica
{
    //put your code here

    // t_endereco
    private $endereco;
    private $cep;
    private $bairroF;
    private $cidadeF;
    private $estado;
    private $logradouro;
    private $numeroF;
    private $complemento;

    // t_pessoa
    private $nome;
    private $email;
    private $telefoneF;

    // t_pessoa_fisica
    private $categoria;
    private $cpf;
    private $sexo;
    private $nascimento;

    // id tabelas
    private $id;
  
    // metodos magicos do php
    // __get retorna o atributo
    function __get($atributo)
    {
        return $this->$atributo;
    }
    // __set pega o valor e atributo
    function __set($valor, $atributo)
    {
        $this->$valor = $atributo;
    }

    function cadastroM($pf)
    {
        // abre a conexao com o banco de dados
        $con = Conexao::abrirConexao();


        $query = "INSERT INTO t_endereco(endereco, cep, bairro, complemento, numero, cidade, estado)
                    VALUES (:endereco, :cep, :bairro, :complemento, :numero, :cidade, :estado);
                  INSERT INTO t_pessoa(nome, telefone, t_endereco_idt_endereco) 
                    VALUES (:nome, :telefoneF, LAST_INSERT_ID()); 
                  INSERT INTO t_pessoa_fisica(cpf, sexo, categoria, t_pessoa_idt_pessoa) 
                    VALUES(:cpf, :sexo, :categoria, LAST_INSERT_ID());
                 ";

        // prepara a query 
        $stmt = $con->prepare($query);

        // tabela t_endereco
        // $stmt->bindValue(':enderecoF', $this->__get('enderecoF'));
        $stmt->bindValue(':endereco', $this->__get('endereco'));
        $stmt->bindValue(':cep', $this->__get('cep'));
        $stmt->bindValue(':bairro', $this->__get('bairroF'));
        $stmt->bindValue(':complemento', $this->__get('complemento'));
        $stmt->bindValue(':numero', $this->__get('numeroF'));
        $stmt->bindValue(':cidade', $this->__get('cidadeF'));
        $stmt->bindValue(':estado', $this->__get('estado'));

        // passa os parametros para a query, primeiro parametro depois valor
        // tabela t_pessoa
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':telefoneF', $this->__get('telefoneF'));
        
        // // tabela t_pessoaFisica
        $stmt->bindValue(':cpf', $this->__get('cpf'));
        $stmt->bindValue(':sexo', $this->__get('sexo'));
        $stmt->bindValue(':categoria', $this->__get('categoria'));

        // por fim executa a query
        $stmt->execute();
    }

    function listarM()
    {
        $con = Conexao::abrirConexao();
        $query = "SELECT p.*, e.*, pf.* FROM t_pessoa_fisica AS pf
                    INNER JOIN t_endereco AS e 
                    INNER JOIN t_pessoa AS p 
                    on (pf.t_pessoa_idt_pessoa = p.t_endereco_idt_endereco 
                        AND e.idt_endereco = pf.t_pessoa_idt_pessoa)
                ";
        $stmt = $con->prepare($query);
        $stmt->execute();

        $objUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $objUsuarios;
    }

    function atualizarM()
    {
        $con = Conexao::abrirConexao();
        $query = "UPDATE t_endereco SET endereco = :endereco, cep = :cep, bairro = :bairro, 
                    complemento = :complemento, numero = :numero, cidade = :cidade, estado = :estado
                WHERE idt_endereco = :id;
                    UPDATE t_pessoa SET nome = :nome, telefone = :telefoneF 
                WHERE idt_pessoa = :id AND t_endereco_idt_endereco = :id;
                    UPDATE t_pessoa_fisica SET cpf = :cpf, sexo = :sexo, categoria = :categoria 
                WHERE idt_pessoa_fisica = :id AND t_pessoa_idt_pessoa = :id";

        $stmt = $con->prepare($query);

        // tabela t_endereco
        $stmt->bindValue(':endereco', $this->__get('endereco'));
       
        $stmt->bindValue(':cep', $this->__get('cep'));
        $stmt->bindValue(':bairro', $this->__get('bairroF'));
        $stmt->bindValue(':complemento', $this->__get('complemento'));
        $stmt->bindValue(':numero', $this->__get('numeroF'));
        $stmt->bindValue(':cidade', $this->__get('cidadeF'));
        $stmt->bindValue(':estado', $this->__get('estado'));

        // passa os parametros para a query, primeiro parametro depois valor

        // tabela t_pessoa
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':telefoneF', $this->__get('telefoneF'));

        // // tabela t_pessoaFisica
        $stmt->bindValue(':cpf', $this->__get('cpf'));
        $stmt->bindValue(':sexo', $this->__get('sexo'));
        $stmt->bindValue(':categoria', $this->__get('categoria'));
       
        $stmt->bindValue(':id', $this->__get('id'));

        $stmt->execute();
    }

    function excluirM()
    {
        $con = Conexao::abrirConexao();
        $query = "DELETE from t_pessoa_fisica WHERE idt_pessoa_fisica = :id AND t_pessoa_idt_pessoa = :id;
                  DELETE FROM t_pessoa WHERE idt_pessoa = :id AND t_endereco_idt_endereco = :id;
                  DELETE FROM t_endereco WHERE idt_endereco = :id;";
        $stmt = $con->prepare($query);
        $stmt->bindValue(':id', $this->__get('id'));
        $stmt->execute();
    }
}
