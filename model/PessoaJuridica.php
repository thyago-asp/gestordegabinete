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
class PessoaJuridica
{
    //put your code here

    // t_endereco
   
    private $cep;
    private $bairro;
    private $cidade;
    private $estado;
    private $logradouro;
    private $numero;
    private $complemento;

    // t_pessoa
    private $nome;
    private $email;
    private $telefoneF;

    // t_pessoa_juridica
    private $atividade;
    private $cnpj;
    private $nomeFantasia;
    // private $atividade;

    // id tabelas
    private $fkIdtPF;
    private $idtEndereco;
    private $idtPessoa;
    private $fkEndereco;
    private $fkIdtPessoa;
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
                    VALUES (:logradouro, :cep, :bairro, :complemento, :numero, :cidade, :estado);
                  INSERT INTO t_pessoa(nome, telefone, t_endereco_idt_endereco) 
                    VALUES (:nome, :telefone, LAST_INSERT_ID()); 
                  INSERT INTO t_pessoa_juridica (t_pessoa_idt_pessoa, cnpj, nome_fantasia, atividade) 
                    VALUES (LAST_INSERT_ID(), :cnpj, :nome_fantasia, :atividade);
                 ";

        // prepara a query 
        $stmt = $con->prepare($query);

        // tabela t_endereco
        $stmt->bindValue(':logradouro', $this->__get('logradouro'));
        $stmt->bindValue(':cep', $this->__get('cep'));
        $stmt->bindValue(':bairro', $this->__get('bairro'));
        $stmt->bindValue(':complemento', $this->__get('complemento'));
        $stmt->bindValue(':numero', $this->__get('numero'));
        $stmt->bindValue(':cidade', $this->__get('cidade'));
        $stmt->bindValue(':estado', $this->__get('estado'));
       

        // passa os parametros para a query, primeiro parametro depois valor
        // tabela t_pessoa
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':telefone', $this->__get('telefone'));
        
        // // tabela t_pessoa_uridica
        $stmt->bindValue(':cnpj', $this->__get('cnpj'));
        $stmt->bindValue(':nome_fantasia', $this->__get('fantasia'));
        $stmt->bindValue(':atividade', $this->__get('atividade'));

        // por fim executa a query
        $stmt->execute();

        return true;
    }

    function listarM()
    {
        $con = Conexao::abrirConexao();
        $query = "SELECT p.*, e.*, pj.* FROM t_pessoa_juridica AS pj 
                    INNER JOIN t_endereco AS e
                    INNER JOIN t_pessoa AS p
                        on (pj.t_pessoa_idt_pessoa = p.t_endereco_idt_endereco 
                            AND e.idt_endereco = pj.t_pessoa_idt_pessoa)
                ";
        $stmt = $con->prepare($query);
        $stmt->execute();

        $objUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $objUsuarios;
    }

    function atualizarM()
    {
        $con = Conexao::abrirConexao();
        $query = "UPDATE t_endereco SET endereco = :logradouro, cep = :cep, bairro = :bairro, 
                    complemento = :complemento, numero = :numero, cidade = :cidade, estado = :estado
                    WHERE idt_endereco = :idtEndereco;
                  UPDATE t_pessoa SET nome = :nome, email = :email, telefone = :telefone 
                    WHERE idt_pessoa = :idtPessoa AND t_endereco_idt_endereco = :fkIdtEndereco;
                    UPDATE t_pessoa_juridica SET cnpj = :cnpj, 
                    nome_fantasia = :nomeFantasia, atividade = :atividade
                    WHERE t_pessoa_idt_pessoa = :fkIdtPessoa;
                    ";

        $stmt = $con->prepare($query);

        // tabela t_endereco
       
        $stmt->bindValue(':cep', $this->__get('cep'));
        $stmt->bindValue(':bairro', $this->__get('bairro'));
        $stmt->bindValue(':logradouro', $this->__get('logradouro'));
        $stmt->bindValue(':complemento', $this->__get('complemento'));
        $stmt->bindValue(':numero', $this->__get('numero'));
        $stmt->bindValue(':cidade', $this->__get('cidade'));
        $stmt->bindValue(':estado', $this->__get('estado'));

        // tabela t_pessoa
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':telefone', $this->__get('telefone'));
        $stmt->bindValue(':email', $this->__get('email'));

        // tabela t_pessoaJuridica
        $stmt->bindValue(':cnpj', $this->__get('cnpj'));
        $stmt->bindValue(':nomeFantasia', $this->__get('nomeFantasia'));
        $stmt->bindValue(':atividade', $this->__get('atividade'));   
       
        // ids e chaves estrangeiras
        $stmt->bindValue(':idtEndereco', $this->__get('idtEndereco'));
        $stmt->bindValue(':fkIdtEndereco', $this->__get('fkEndereco'));
        $stmt->bindValue(':idtPessoa', $this->__get('idtPessoa'));
        $stmt->bindValue(':fkIdtPessoa', $this->__get('fkIdtPessoa'));

        $stmt->execute();
    }

    function excluirM()
    {
        $con = Conexao::abrirConexao();
        $query = "DELETE from t_pessoa_juridica WHERE t_pessoa_idt_pessoa = :fkIdtPessoa;
                  DELETE FROM t_pessoa WHERE idt_pessoa = :idtPessoa AND t_endereco_idt_endereco = :fkIdtEndereco;
                  DELETE FROM t_endereco WHERE idt_endereco = :idtEndereco;";
        $stmt = $con->prepare($query);
        $stmt->bindValue(':idtEndereco', $this->__get('idtEndereco'));
        $stmt->bindValue(':fkIdtEndereco', $this->__get('fkEndereco'));
        $stmt->bindValue(':idtPessoa', $this->__get('idtPessoa'));
        $stmt->bindValue(':fkIdtPessoa', $this->__get('fkIdtPessoa'));

        $stmt->execute();
    }
}
