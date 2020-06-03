<?php

require_once "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerPessoasVisitas.php";
$result = (new ControllerPessoasVisitas())->listar();
foreach ($result as $chave => $valor) : ?>

    <tr>
        <td><?php echo $valor['nome'] ?></td>
        <td><?php echo $valor['data'] ?></td>
        <td><?php echo $valor['cidade'] ?></td>
        <td><?php echo $valor['comentario'] ?></td>
        <td class="text-center">
            <div class="btn-group text-center" role="group" aria-label="Button group">
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalEdicao"
                    data-idvisita="<?php echo $valor['idVisitas']?>"
                    data-nome="<?php echo $valor['nome']?>"
                    data-dataCad="<?php echo $valor['data']?>"
                    data-cidade="<?php echo $valor['cidade']?>"
                    data-comentario="<?php echo $valor['comentario']?>"
                    >
                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                </button>
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir"
                        data-idvisitas="<?php echo $valor['idVisitas']?>"
                        data-nome="<?php echo $valor['nome']?>"
                        >
                    Excluir
                </button>
            </div>
        </td>
    </tr>

<?php
endforeach;
