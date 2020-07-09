   <?php

    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
        $projetosdelei = filter_input(INPUT_POST, 'idprojetosdelei', FILTER_SANITIZE_STRING);
       
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM t_comentarios_projetosdelei where t_projetosdelei_idt_projetosdelei = '" . $projetosdelei . "'";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        echo json_encode($stmt->fetchAll());
        return;
    }
    echo NULL;
