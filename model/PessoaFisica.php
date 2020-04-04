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
class PessoaFisica
{
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


    function __get($atributo)
    {
        return $this->$atributo;
    }
    function __set($valor, $atributo)
    {
        $this->$valor = $atributo;
    }

}