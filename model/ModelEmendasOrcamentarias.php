<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
/**
 * Description of Usuario
 *
 * @author Thyago
 */
class ModelEmendasOrcamentarias
{
    //put your code here
    private $id;
    private $cidade;
    private $distancia_capital;
    private $regiao;
    private $prefeito;
    private $vice_prefeito;
    private $populacao;
    private $votos2018;
    private $eleitores;

    private $idt;
    private $tipo_emenda;
    private $beneficiario;
    private $valor;
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
    private $idtArq;

    function __set($valor, $atributo)
    {
        $this->$valor = $atributo;
    }

    function __get($atributo)
    {
        return $this->$atributo;
    }

    function salvarModel($emenda)
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "INSERT INTO t_emendas(tipo_emenda, numDoc, solicitante, beneficiario, 
                    nome_de_contato, valor, titulo, data_cad_doc, descricao, status, t_emendas_orcamentarias_idt_emendas_orcamentarias) 
                  VALUES (:tipo_emenda, :numDoc, :solicitante, :beneficiario, :nome_de_contato, 
                  :valor, :titulo, :data_cad_doc, :descricao, :status, :t_emendas_orcamentarias_idt_emendas_orcamentarias)";

            $stmt = $con->prepare($query);
            $stmt->bindValue(':tipo_emenda', $emenda->__get('tipo_emenda'));
            $stmt->bindValue(':numDoc', $emenda->__get('documento'));
            $stmt->bindValue(':solicitante', $emenda->__get('solicitante'));
            $stmt->bindValue(':beneficiario', $emenda->__get('beneficiario'));
            $stmt->bindValue(':nome_de_contato', $emenda->__get('nomeContato'));
            $stmt->bindValue(':valor', $emenda->__get('valor'));
            $stmt->bindValue(':titulo', $emenda->__get('titulo'));
            $stmt->bindValue(':data_cad_doc', $emenda->__get('data'));
            $stmt->bindValue(':descricao', $emenda->__get('descricao'));
            $stmt->bindValue(':status', $emenda->__get('status'));
            $stmt->bindValue(':t_emendas_orcamentarias_idt_emendas_orcamentarias', $emenda->__get('cidade'));

            $retorno = $stmt->execute();

            if ($retorno > 0) {
                $ultimoId = $con->lastInsertId();

                for ($j = 0; $j < count($this->__get('arquivos')['local']); $j++) {
                    $query = "INSERT INTO t_arquivos_emendas(arquivo_caminho, nome_arquivo, t_emendas_idt_emendas) 
                    VALUES (:arquivo_caminho, :nome_arquivo, :ultimoid)";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':arquivo_caminho', $this->__get('arquivos')['local'][$j]);
                    $stmt->bindValue(':nome_arquivo', $this->__get('arquivos')['nome'][$j]);
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }

                if ($this->__get('comentario') != "") {
                    $query = "INSERT INTO t_comentarios_emendas(comentario, data, t_emendas_idt_emendas) 
                VALUES (:comentario, :data, :ultimoid)";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':comentario', $this->__get('comentario'));
                    date_default_timezone_set('America/Sao_Paulo');
                    $stmt->bindValue(':data', date('Y-m-d H:i:s'));
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }
            }
            return 1;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function listarEmendas()
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT emenda.*, cidade.cidade, DATE_FORMAT(data_cad_doc, '%d/%m/%Y') AS data_cad_doc FROM t_emendas as emenda
        left join t_emendas_orcamentarias as cidade
        on cidade.idt_emendas_orcamentarias = emenda.t_emendas_orcamentarias_idt_emendas_orcamentarias";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    public function listar()
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT idt_emendas_orcamentarias, cidade, regiao FROM t_emendas_orcamentarias";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }
    function deletarModel()
    {
        try {
            $con = Conexao::abrirConexao();
            $this->arqExcluir($this->__get('idt'));

            $query = "DELETE FROM t_emendas
                    WHERE idt_emendas = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':idt', $this->__get('idt'));

            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    function arqExcluir($idt)
    {

        $con = Conexao::abrirConexao();
        $query = "SELECT * FROM t_arquivos_emendas WHERE t_emendas_idt_emendas = :fkidt";

        $stmt = $con->prepare($query);
        $stmt->bindValue('fkidt', $idt);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $chave => $valor) {
            unlink($valor['arquivo_caminho']);
        }
    }
    public function listarComentarios($id)
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_comentarios_emenda where t_emendas_orcamentarias_idt_emendas_orcamentarias = :id";

        $stmt = $con->prepare($query);
        $stmt->bindValue(':id', $id);
        $result = $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    function deletarComentario()
    {
        try {
            $con = Conexao::abrirConexao();

            $query = "DELETE FROM `t_comentarios_emendas` WHERE idt_comentarios_emendas = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':idt', $this->__get('idt'));

            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    public function pesquisarCidade($cidade)
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT idt_emendas_orcamentarias, cidade FROM t_emendas_orcamentarias WHERE cidade LIKE :cidade";

        $stmt = $con->prepare($query);
        $stmt->bindValue(':cidade', $cidade);
        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function registrarVisita($data, $id)
    {
        try {
            $con = Conexao::abrirConexao();

            $query = "INSERT INTO t_visita_cidade (data, t_emendas_orcamentarias_idt_emendas_orcamentarias) 
                    VALUES (:data, :t_emendas_orcamentarias_idt_emendas_orcamentarias)";

            $stmt = $con->prepare($query);
            $stmt->bindValue(':data', $data);
            $stmt->bindValue(':t_emendas_orcamentarias_idt_emendas_orcamentarias', $id);
            $result = $stmt->execute();


            return $result;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    public function addComentario($comentario, $id)
    {
        try {
            $con = Conexao::abrirConexao();

            $query = "INSERT INTO t_comentarios_emenda (comentario, data, t_emendas_orcamentarias_idt_emendas_orcamentarias) 
                    VALUES (:comentario, :data, :t_emendas_orcamentarias_idt_emendas_orcamentarias)";

            $stmt = $con->prepare($query);
            $stmt->bindValue(':comentario', $comentario);
            date_default_timezone_set('America/Sao_Paulo');
            $stmt->bindValue(':data', date('Y-m-d'));
            $stmt->bindValue(':t_emendas_orcamentarias_idt_emendas_orcamentarias', $id);

            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }

    public function buscarCidade($id)
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_emendas_orcamentarias WHERE idt_emendas_orcamentarias = :id";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':id', $id);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function buscarRecursos($id)
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_emendas WHERE t_emendas_orcamentarias_idt_emendas_orcamentarias = :id";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':id', $id);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }


    public function buscarItensRecursos($id)
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_recursos as r inner join t_itens_recurso as it on it.t_recursos_idt_recursos = r.idt_recursos where r.idt_recursos = :id;";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':id', $id);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function buscarApoiadores($id)
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_apoiadores WHERE t_emendas_orcamentarias_idt_emendas_orcamentarias = :id";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':id', $id);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function buscarEstruturaPartido($id)
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_estrutura_partido WHERE t_emendas_orcamentarias_idt_emendas_orcamentarias = :id";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':id', $id);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    function deletarAnexo()
    {
        try {
            $con = Conexao::abrirConexao();

            $query = "DELETE FROM `t_arquivos_emendas` WHERE idarquivos = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':idt', $this->__get('idt'));

            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
    function atualizarModel()
    {
        try {
            $con = Conexao::abrirConexao();
            $query = "UPDATE t_emendas 
                  SET tipo_emenda = :tipo_emenda, numDoc = :numDoc, solicitante = :solicitante, beneficiario = :beneficiario,
                      data_cad_doc = :data_cad_doc, nome_de_contato = :nome_de_contato, titulo = :titulo,
                      descricao = :descricao, t_emendas_orcamentarias_idt_emendas_orcamentarias = :cidade, status = :status  
                  WHERE idt_emendas = :idt";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':tipo_emenda', $this->__get('tipo_emenda'));
            $stmt->bindValue(':numDoc', $this->__get('documento'));
            $stmt->bindValue(':solicitante', $this->__get('solicitante'));
            $stmt->bindValue(':beneficiario', $this->__get('beneficiario'));
            $stmt->bindValue(':data_cad_doc', $this->__get('data'));
            $stmt->bindValue(':nome_de_contato', $this->__get('nomeContato'));
            
            $stmt->bindValue(':titulo', $this->__get('titulo'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':cidade', $this->__get('cidade'));
            $stmt->bindValue(':status', $this->__get('status'));
            $stmt->bindValue(':idt', $this->__get('idt'));

            $retorno = $stmt->execute();

            if ($retorno > 0) {
                $ultimoId = $this->__get('idt');

                for ($j = 0; $j < count($this->__get('arquivos')['local']); $j++) {
                    $query = "INSERT INTO t_arquivos_emendas(arquivo_caminho, nome_arquivo, t_emendas_idt_emendas) 
                VALUES (:arquivo_caminho, :nome_arquivo, :ultimoid)";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':arquivo_caminho', $this->__get('arquivos')['local'][$j]);
                    $stmt->bindValue(':nome_arquivo', $this->__get('arquivos')['nome'][$j]);
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }
                if ($this->__get('comentario') != "") {
                    $query = "INSERT INTO t_comentarios_emendas(comentario, data, t_emendas_idt_emendas) 
                VALUES (:comentario, :data, :ultimoid)";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':comentario', $this->__get('comentario'));
                    date_default_timezone_set('America/Sao_Paulo');
                    $stmt->bindValue(':data', date('Y-m-d H:i:s'));
                    $stmt->bindValue(':ultimoid', $ultimoId);

                    $stmt->execute();
                }
            }
            return 1;
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }
    }
    public function buscarVisitas($id)
    {
        $con = Conexao::abrirConexao();


        $query = "SELECT * FROM t_visita_cidade WHERE t_emendas_orcamentarias_idt_emendas_orcamentarias = :id ORDER BY DATE(data) DESC";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':id', $id);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of cidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return  self
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get the value of distancia_capital
     */
    public function getDistancia_capital()
    {
        return $this->distancia_capital;
    }

    /**
     * Set the value of distancia_capital
     *
     * @return  self
     */
    public function setDistancia_capital($distancia_capital)
    {
        $this->distancia_capital = $distancia_capital;

        return $this;
    }

    /**
     * Get the value of regiao
     */
    public function getRegiao()
    {
        return $this->regiao;
    }

    /**
     * Set the value of regiao
     *
     * @return  self
     */
    public function setRegiao($regiao)
    {
        $this->regiao = $regiao;

        return $this;
    }

    /**
     * Get the value of votos2018
     */
    public function getVotos2018()
    {
        return $this->votos2018;
    }

    /**
     * Set the value of votos2018
     *
     * @return  self
     */
    public function setVotos2018($votos2018)
    {
        $this->votos2018 = $votos2018;

        return $this;
    }

    /**
     * Get the value of eleitores
     */
    public function getEleitores()
    {
        return $this->eleitores;
    }

    /**
     * Set the value of eleitores
     *
     * @return  self
     */
    public function setEleitores($eleitores)
    {
        $this->eleitores = $eleitores;

        return $this;
    }

    /**
     * Get the value of populacao
     */
    public function getPopulacao()
    {
        return $this->populacao;
    }

    /**
     * Set the value of populacao
     *
     * @return  self
     */
    public function setPopulacao($populacao)
    {
        $this->populacao = $populacao;

        return $this;
    }

    /**
     * Get the value of vice_prefeito
     */
    public function getVice_prefeito()
    {
        return $this->vice_prefeito;
    }

    /**
     * Set the value of vice_prefeito
     *
     * @return  self
     */
    public function setVice_prefeito($vice_prefeito)
    {
        $this->vice_prefeito = $vice_prefeito;

        return $this;
    }

    /**
     * Get the value of prefeito
     */
    public function getPrefeito()
    {
        return $this->prefeito;
    }

    /**
     * Set the value of prefeito
     *
     * @return  self
     */
    public function setPrefeito($prefeito)
    {
        $this->prefeito = $prefeito;

        return $this;
    }
}
