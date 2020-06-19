<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Conexao
{

    public static function abrirConexao()
    {
        $ambiente = "dev";

        switch ($ambiente) {
            case 'dev':
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "fesper35_deputados";
                break;
            case 'qas':
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_deputado_teste";
                break;
            case 'prd':
                $servername = "br12.hostgator.com.br";
                $username = "fesper35_admin";
                $password = "123123";
                $dbname = "fesper35_deputados";
                break;
            case 'teste':
                $servername = "br12.hostgator.com.br";
                $username = "fesper35_teste";
                $password = "fesper@123";
                $dbname = "fesper35_deputados_teste";
                break;
            default:
                # code...
                break;
        }

        try {
            $con = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", "$username", "$password");

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        return $con;
    }
}
