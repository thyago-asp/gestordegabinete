   <?php

    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
  
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_requerimentos order by data_insert DESC LIMIT 1;";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        echo json_encode($stmt->fetchAll());
        return;
    }
    echo NULL;
