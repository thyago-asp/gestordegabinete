<?php
//require "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerEmendasOrcamentarias.php";

$lista = (new ControllerEmendasOrcamentarias())->listarEmendas();

/*if (!isset($req[0][0]['arquivo']['nome']))
    $totArq = 1;
else
    $totArq = count($req[0][0]['arquivos']['nome']);

$i = 0;

*/

foreach ($lista as $emenda) {
    switch ($emenda['status']) {
        case "solicitado":
            $status = "Solicitado";
            break;
        case "pendente":
            $status = "Pendente";
            break;
        case "pago":
            $status = "Pago";
            break;
    }
    $tipo_emenda = "";
    switch ($emenda['tipo_emenda']) {
        case "emenda_federal":
            $tipo_emenda = "Emenda Federal";
            break;
        case "emenda_estadual":
            $tipo_emenda = "Emenda Estadual";
            break;
        case "emenda_municipal":
            $tipo_emenda = "Emenda Municipal";
            break;

    }


?>
          

    <tr>
        <td><?php echo $tipo_emenda ?></td>
        <td><?php echo $emenda['numDoc'] ?></td>
        <td><?php echo $emenda['beneficiario'] ?></td>
        <td><?php echo " R$ ", number_format($emenda['valor'], 2, ",", "."); ?></td>
        <td><?php echo $emenda['titulo'] ?></td>
        <td><?php echo $status ?></td>
        <td><?php echo $emenda["cidade"] ?></td>
        <td><?php echo $emenda['data_cad_doc'] ?></td>
        
        
        <td class="text-center">
            <div class="btn-group text-center" role="group" aria-label="Button group">
                <!-- Botão editar -->
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalArquivos" data-idteme="<?php echo $emenda['idt_emendas'] ?>">
                <i class="fa fa-file-alt" aria-hidden="true"></i>
                </button>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" data-idteme="<?php echo $emenda['idt_emendas'] ?>" data-tipo_emenda="<?php echo $emenda['tipo_emenda'] ?>" data-numDoc="<?php echo $emenda['numDoc'] ?>" data-solicitante="<?php echo $emenda['solicitante'] ?>" data-beneficiario="<?php echo $emenda['beneficiario'] ?>" data-cidade="<?php echo $emenda['t_emendas_orcamentarias_idt_emendas_orcamentarias'] ?>" data-nomeContato="<?php echo $emenda['nome_de_contato'] ?>" data-dataDoc="<?php echo $emenda['data_cad_doc'] ?>" data-tipo="<?php echo $emenda['tipo'] ?>" data-titulo="<?php echo $emenda['titulo'] ?>" data-descricao="<?php echo $emenda['descricao'] ?>" data-status="<?php echo $emenda['status'] ?>" data-valor="<?php echo $emenda['valor'] ?>"> <i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                <!-- Botão excluir -->
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" data-numDoc="<?php echo $emenda['numDoc'] ?>" data-idteme="<?php echo $emenda['idt_emendas'] ?>"> <i class="fa fa-trash" aria-hidden="true"></i></button>

            </div>
        </td>
    </tr>
<?php
}
