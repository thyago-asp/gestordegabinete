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



    public function listar()
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT idt_emendas_orcamentarias, cidade, regiao FROM t_emendas_orcamentarias";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
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
            $stmt->bindValue(':data', date("d/m/Y", strtotime($data)));
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

        $query = "SELECT * FROM t_recursos WHERE t_emendas_orcamentarias_idt_emendas_orcamentarias = :id";

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

    public function buscarVisitas($id)
    {
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_visita_cidade WHERE t_emendas_orcamentarias_idt_emendas_orcamentarias = :id ORDER BY data ASC";

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
