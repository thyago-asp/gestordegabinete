<?php

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
class PessoaFisica {
    //put your code here

    private $nome;
    private $email;
    private $telefone;
    private $sexo;
    private $datadenascimento;
    
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;
    private $categoria;

    // inicio getters

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }
    function getTelefone() {
        return $this->telefone;
    }
    function getSexo() {
        return $this->sexo;
    }
    function getDatadenascimento() {
        return $this->datadenascimento;
    }
    function getCep() {
        return $this->cep;
    }
    function getLogradouro() {
        return $this->logradouro;
    }
    function getNumero() {
        return $this->numero;
    }
    function getComplemento() {
        return $this->complemento;
    }
    function getBairro() {
        return $this->bairro;
    }
    function getCidade() {
        return $this->cidade;
    }
    function getEstado() {
        return $this->estado;
    }
    function getCategoria() {
        return $this->categoria;
    }
    // fim getter
    
    // inicio setters

    function setNome($nome) {
        $this->nome = $nome;
    }
    function setemail($email) {
        $this->email = $email;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
    function setSexo($sexo) {
        $this->sexo = $sexo;
    }
    function setDatanascimento($datanascimento) {
        $this->datanascimento = $datanascimento;
    }
    function setCep($cep) {
        $this->cep = $cep;
    }
    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }
    function setNumero($numero) {
        $this->numero = $numero;
    }
    function setCompletomento($completomento) {
        $this->completomento = $completomento;
    }
    function setBairro($bairro) {
        $this->bairro = $bairro;
    }
    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
}
