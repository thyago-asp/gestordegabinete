   <?php

    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
        $requerimento = filter_input(INPUT_POST, 'idrequerimento', FILTER_SANITIZE_STRING);
       
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_comentarios_requerimentos where t_requerimentos_idt_requerimentos = '" . $requerimento . "'";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        echo json_encode($stmt->fetchAll());
        return;
    }
    echo NULL;
