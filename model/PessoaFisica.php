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
  // private $endereco;
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
  private $telefoneF2;
  private $telefoneF3;

  // t_pessoa_fisica
  private $categoria;
  private $cpf;
  private $sexo;
  private $nascimento;

  // ids
  private $fkIdtPF;
  private $idtEndereco;
  private $id;

  private $arquivo;

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

  function cadastroM()
  {
    try {
      // abre a conexao com o banco de dados
      $con = Conexao::abrirConexao();


      $query = "INSERT INTO t_endereco(endereco, cep, bairro, complemento, numero, cidade, estado)
                    VALUES (:endereco, :cep, :bairro, :complemento, :numero, :cidade, :estado);
                  INSERT INTO t_pessoa(nome, email, telefone, telefone2, telefone3, t_endereco_idt_endereco) 
                    VALUES (:nome, :email, :telefoneF, :telefoneF2, :telefoneF3,LAST_INSERT_ID()); 
                  INSERT INTO t_pessoa_fisica(cpf, sexo, data_nascimento, categoria, arquivo, t_pessoa_idt_pessoa) 
                    VALUES(:cpf, :sexo, :data_nascimento, :categoria, :arquivo, LAST_INSERT_ID());
                 ";

      // prepara a query 
      $stmt = $con->prepare($query);

      // tabela t_endereco
      $stmt->bindValue(':endereco', $this->__get('logradouro'));
      $stmt->bindValue(':cep', $this->__get('cep'));
      $stmt->bindValue(':bairro', $this->__get('bairroF'));
      $stmt->bindValue(':complemento', $this->__get('complemento'));
      $stmt->bindValue(':numero', $this->__get('numeroF'));
      $stmt->bindValue(':cidade', $this->__get('cidadeF'));
      $stmt->bindValue(':estado', $this->__get('estado'));

      // passa os parametros para a query, primeiro parametro depois valor
      // tabela t_pessoa
      $stmt->bindValue(':nome', $this->__get('nome'));
      $stmt->bindValue(':email', $this->__get('email'));
      $stmt->bindValue(':telefoneF', $this->__get('telefoneF'));
      $stmt->bindValue(':telefoneF2', $this->__get('telefoneF2'));
      $stmt->bindValue(':telefoneF3', $this->__get('telefoneF3'));

      // // tabela t_pessoaFisica

      $stmt->bindValue(':cpf', $this->__get('cpf'));
      $stmt->bindValue(':sexo', $this->__get('sexo'));
      $stmt->bindValue(':data_nascimento', $this->__get('nascimento'));
      $stmt->bindValue(':categoria', $this->__get('categoria'));

      $stmt->bindValue(':arquivo', $this->__get('arquivo'));

      // por fim executa a query
      $result = $stmt->execute();

      return $result;
    } catch (PDOException $e) {
      print_r($e->getMessage());
    }
  }

  function listarM()
  {
    try {
      $con = Conexao::abrirConexao();
      $query = "select p.*, pf.*, ende.*, DATE_FORMAT(pf.data_nascimento, '%d/%m/%Y') AS nascimento from t_pessoa as p 
                inner join t_pessoa_fisica as pf 
                inner join t_endereco as ende
                on pf.t_pessoa_idt_pessoa = p.idt_pessoa
                and ende.idt_endereco = p.t_endereco_idt_endereco";
      $stmt = $con->prepare($query);
      $stmt->execute();

      $pessoas = $stmt->fetchAll(PDO::FETCH_OBJ);

      return $pessoas;
    } catch (PDOException $e) {
      print_r($e->getMessage());
    }
  }

  function atualizarM()
  {
    try {
      $con = Conexao::abrirConexao();
      $query = "UPDATE t_endereco SET endereco = :endereco, cep = :cep, bairro = :bairro, 
                    complemento = :complemento, numero = :numero, cidade = :cidade, estado = :estado
                    WHERE idt_endereco = :idtEndereco;
                  UPDATE t_pessoa SET nome = :nome, telefone = :telefoneF, telefone2 = :telefoneF2, telefone3 = :telefoneF3,email = :email 
                    WHERE idt_pessoa = :idtPessoa AND t_endereco_idt_endereco = :fkidtEndereco;
                  UPDATE t_pessoa_fisica SET cpf = :cpf, sexo = :sexo, data_nascimento = :data_nascimento, categoria = :categoria,
                    arquivo = :arquivo
                    WHERE idt_pessoa_fisica = :idtPF AND t_pessoa_idt_pessoa = :fkIdtPessoa
                 ";

      $stmt = $con->prepare($query);

      // passa os parametros para a query, primeiro parametro depois valor
      // tabela t_endereco
      $stmt->bindValue(':endereco', $this->__get('endereco'));
      $stmt->bindValue(':cep', $this->__get('cep'));
      $stmt->bindValue(':bairro', $this->__get('bairroF'));
      $stmt->bindValue(':complemento', $this->__get('complemento'));
      $stmt->bindValue(':numero', $this->__get('numeroF'));
      $stmt->bindValue(':cidade', $this->__get('cidadeF'));
      $stmt->bindValue(':estado', $this->__get('estado'));
      $stmt->bindValue(':idtEndereco', $this->__get('idtEndereco'));


      // tabela t_pessoa
      $stmt->bindValue(':nome', $this->__get('nome'));
      $stmt->bindValue(':telefoneF', $this->__get('telefoneF'));
      $stmt->bindValue(':telefoneF2', $this->__get('telefoneF2'));
      $stmt->bindValue(':telefoneF3', $this->__get('telefoneF3'));
      $stmt->bindValue(':email', $this->__get('email'));
      $stmt->bindValue(':idtPessoa', $this->__get('idtPessoa'));
      $stmt->bindValue(':fkidtEndereco', $this->__get('fkIdtEndereco'));

      // // tabela t_pessoaFisica
      $stmt->bindValue(':cpf', $this->__get('cpf'));
      $stmt->bindValue(':sexo', $this->__get('sexo'));
      $stmt->bindValue(':data_nascimento', $this->__get('nascimento'));
      $stmt->bindValue(':categoria', $this->__get('categoria'));
      $stmt->bindValue(':arquivo', $this->__get('arquivo'));

      $stmt->bindValue(':idtPF', $this->__get('idtPF'));
      $stmt->bindValue(':fkIdtPessoa', $this->__get('fkIdtPessoa'));



      $result = $stmt->execute();

      return $result;
    } catch (PDOException $e) {
      print_r($e->getMessage());
    }
  }

  function excluirM()
  {
    try {
      $con = Conexao::abrirConexao();

      $query = "DELETE FROM t_pessoa_fisica WHERE idt_pessoa_fisica = :idtPF AND t_pessoa_idt_pessoa = :fkIdtPessoa;
                  DELETE FROM t_pessoa WHERE idt_pessoa = :idtPessoa AND t_endereco_idt_endereco = :fkIdtEndereco;
                  DELETE FROM t_endereco WHERE idt_endereco = :idtEndereco;";
      $stmt = $con->prepare($query);

      $stmt->bindValue(':idtPF', $this->__get('idtPF'));
      $stmt->bindValue(':fkIdtPessoa', $this->__get('fkIdtPessoa'));



      $stmt->bindValue(':idtPessoa', $this->__get('idtPessoa'));
      $stmt->bindValue(':fkIdtEndereco', $this->__get('fkIdtEndereco'));

      $stmt->bindValue(':idtEndereco', $this->__get('idtEndereco'));

      $stmt->execute();

      return true;
    } catch (PDOException $e) {
      print_r($e->getMessage());
    }
  }
}
