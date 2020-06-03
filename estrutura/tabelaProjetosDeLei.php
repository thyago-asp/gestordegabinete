<?php

require "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerProjetosDeLei.php";
$lista_projetodelei = (new ControllerProjetosDeLei())->listarProjetosDeLei();
/*
if(!isset($lista[0][0]['arquivo']['nome']))
    $totArq = 1;
else
    $totArq = count($lista[0][0]['arquivos']['nome']);
$i = 0;
*/
foreach ($lista_projetodelei as $projetodelei) :
?>

    <tr>
        <td><?php echo $projetodelei['numDoc'] ?></td>
        <td><?php echo $projetodelei['solicitante'] ?></td>
        <td><?php echo $projetodelei['instituicao'] ?></td>
        <td><?php echo $projetodelei['tipo'] ?></td>
        <td><?php echo $projetodelei['data_cad_doc'] ?></td>
        <td><?php echo $projetodelei['titulo'] ?></td>
        <td><?php echo $projetodelei['status'] ?></td>
        <td class="text-center">
            <div class="btn-group text-center" role="group" aria-label="Button group">
                <!-- Botão editar -->
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalArquivos" data-idtpro="<?php echo $projetodelei['idt_projetosdelei'] ?>">
                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                </button>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" data-idtpro="<?php echo $projetodelei['idt_projetosdelei'] ?>" data-numDoc="<?php echo $projetodelei['numDoc'] ?>" data-solicitante="<?php echo $projetodelei['solicitante'] ?>" data-instituicao="<?php echo $projetodelei['instituicao'] ?>" data-nomeContato="<?php echo $projetodelei['nome_de_contato'] ?>" data-dataDoc="<?php echo $projetodelei['data_cad_doc'] ?>" data-tipo="<?php echo $projetodelei['tipo'] ?>" data-titulo="<?php echo $projetodelei['titulo'] ?>" data-descricao="<?php echo $projetodelei['descricao'] ?>" data-status="<?php echo $projetodelei['status'] ?>"><i class="fa fa-th-list" aria-hidden="true"></i></button>
                <!-- Botão excluir -->
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" data-numDoc="<?php echo $projetodelei['numDoc'] ?>" data-idtpro="<?php echo $projetodelei['idt_projetosdelei'] ?>" data-tipo="<?php echo $projetodelei['tipo'] ?>">Excluir</button>
            </div>
        </td>
    </tr>

<?php
endforeach;

?>