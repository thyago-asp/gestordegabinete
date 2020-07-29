   <?php

    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
        $emendas = filter_input(INPUT_POST, 'idemendas', FILTER_SANITIZE_STRING);
       
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_arquivos_emendas where t_emendas_idt_emendas = '" . $emendas . "'";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        echo json_encode($stmt->fetchAll());
        return;
    }
    echo NULL;
