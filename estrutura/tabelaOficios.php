<?php
$url = '';
require_once "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerOficios.php";

$lista = (new ControllerOficios())->listarOficios();
echo "<pre>";
//print_r($lista);
$i = 0;
/*if(!isset($lista[0][0]['arquivo']['nome']))
    $totArq = 1;
else
    $totArq = count($lista[0][0]['arquivos']['nome']);
  */
foreach ($lista as $oficio) :
?>

    <tr>
        <td><?php echo $oficio['numDoc'] ?></td>
        <td><?php echo $oficio['solicitante'] ?></td>
        <td><?php echo $oficio['instituicao'] ?></td>
        <td><?php echo $oficio['tipo'] ?></td>
        <td><?php echo $oficio['data_cad_doc'] ?></td>
        <td><?php echo $oficio['titulo'] ?></td>
        <td><?php echo $oficio['status'] ?></td>
        <td class="text-center">
            <div class="btn-group text-center" role="group" aria-label="Button group">
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalArquivos" data-idtofi="<?php echo $oficio['idt_oficios'] ?>">
                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                </button>
                <!-- Botão editar -->
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" data-idtofi="<?php echo $oficio['idt_oficios'] ?>" data-numDoc="<?php echo $oficio['numDoc'] ?>" data-solicitante="<?php echo $oficio['solicitante'] ?>" data-instituicao="<?php echo $oficio['instituicao'] ?>" data-nomeContato="<?php echo $oficio['nome_de_contato'] ?>" data-dataDoc="<?php echo $oficio['data_cad_doc'] ?>" data-tipo="<?php echo $oficio['tipo'] ?>" data-titulo="<?php echo $oficio['titulo'] ?>" data-descricao="<?php echo $oficio['descricao'] ?>" data-status="<?php echo $oficio['status'] ?>"><i class="fa fa-th-list" aria-hidden="true"></i></button>
                <!-- Botão excluir -->
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" data-numDoc="<?php echo $oficio['numDoc'] ?>" data-idtofi="<?php echo $oficio['idt_oficios'] ?>" data-tipo="<?php echo $oficio['tipo'] ?>">Excluir</button>

            </div>
        </td>
    </tr>

<?php
endforeach;

?>