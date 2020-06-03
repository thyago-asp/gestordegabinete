<?php
require "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerRequerimentos.php";

$lista = (new ControllerRequerimentos())->listarRequerimentos();

/*if (!isset($req[0][0]['arquivo']['nome']))
    $totArq = 1;
else
    $totArq = count($req[0][0]['arquivos']['nome']);

$i = 0;

*/

foreach ($lista as $requerimento) {
?>

    <tr>
        <td><?php echo $requerimento['solicitante'] ?></td>
        <td><?php echo $requerimento['instituicao'] ?></td>
        <td><?php echo $requerimento['tipo'] ?></td>
        <td><?php echo $requerimento['data_cad_doc'] ?></td>
        <td><?php echo $requerimento['titulo'] ?></td>
        <td><?php echo $requerimento['numDoc'] ?></td>
        <td class="text-center">
            <div class="btn-group text-center" role="group" aria-label="Button group">
                <!-- Botão editar -->
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalArquivos" data-idtreq="<?php echo $requerimento['idt_requerimentos'] ?>">
                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                </button>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" data-idtReq="<?php echo $requerimento['idt_requerimentos'] ?>" data-numDoc="<?php echo $requerimento['numDoc'] ?>" data-solicitante="<?php echo $requerimento['solicitante'] ?>" data-instituicao="<?php echo $requerimento['instituicao'] ?>" data-nomeContato="<?php echo $requerimento['nome_de_contato'] ?>" data-dataDoc="<?php echo $requerimento['data_cad_doc'] ?>" data-tipo="<?php echo $requerimento['tipo'] ?>" data-titulo="<?php echo $requerimento['titulo'] ?>" data-descricao="<?php echo $requerimento['descricao'] ?>" data-status="<?php echo $requerimento['status'] ?>"><i class="fa fa-th-list" aria-hidden="true"></i></button>
                <!-- Botão excluir -->
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" data-numDoc="<?php echo $requerimento['numDoc'] ?>" data-idtreq="<?php echo $requerimento['idt_requerimentos'] ?>" data-tipo="<?php echo $requerimento['tipo'] ?>">Excluir</button>

            </div>
        </td>
    </tr>
<?php
}
