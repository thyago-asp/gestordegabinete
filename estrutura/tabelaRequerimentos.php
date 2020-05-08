<?php
require $_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerRequerimentos.php';

$req = (new ControllerRequerimentos())->listarRequerimentos();
$i = 0;
$totArq = count($req[0][0]['arquivos']['nome']);


foreach ($req as $chave => $valor) :
?>

    <tr>
        <td><?php echo $valor['solicitante'] ?></td>
        <td><?php echo $valor['instituicao'] ?></td>
        <td><?php echo $valor['nome_de_contato'] ?></td>
        <td><?php echo $valor['data_cad_doc'] ?></td>
        <td><?php echo $valor['titulo'] ?></td>
        <td><?php echo $valor['numDoc'] ?></td>
        <td class="text-center">
            <div class="btn-group text-center" role="group" aria-label="Button group">
                <!-- Botão editar -->
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalArquivos"
                        <?php foreach($valor[0] as $chave => $inf):
                                
                                while ($i < $totArq) {
                                    if(array_key_exists($i, $inf['nome'])){
                                        echo "data-nome$i='{$inf['nome'][$i]}'";
                                        echo "data-idArq$i='{$inf['idArquivo'][$i]}'"; 
                                        echo "data-fkrequerimentos$i='{$inf['fkArquivo'][$i]}'";
                                        echo "data-linkArq$i='{$inf['linkArq'][$i]}'";
                                    }
                                    $i++;          
                                }
                                
                                $totArq = count($inf['nome']);
                                $i = 0; 
                            endforeach; ?>
                    
                ><i class="fa fa-folder-open" aria-hidden="true"></i>
                </button>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" 
                
                        data-idtReq="<?php echo $valor['idt_oficios'] ?>" 
                        data-numDoc="<?php echo $valor['numDoc'] ?>" 
                        data-solicitante="<?php echo $valor['solicitante'] ?>" 
                        data-instituicao="<?php echo $valor['instituicao'] ?>" 
                        data-nomeContato="<?php echo $valor['nome_de_contato'] ?>" 
                        data-dataDoc="<?php echo $valor['data_cad_doc'] ?>" 
                        data-tipo="<?php echo $valor['tipo'] ?>" 
                        data-titulo="<?php echo $valor['titulo'] ?>" 
                        data-descricao="<?php echo $valor['descricao'] ?>" 
                        data-status="<?php echo $valor['status'] ?>" 
                       ><i class="fa fa-th-list" aria-hidden="true"></i></button>
                <!-- Botão excluir -->
                <button class="btn btn-danger" type="button" 
                        data-toggle="modal" 
                        data-target="#modalExcluir"
                        data-numDoc="<?php echo $valor['numDoc'] ?>" 
                        data-idtreq="<?php echo $valor['idt_oficios'] ?>"
                        data-tipo="<?php echo $valor['tipo'] ?>"
                    >Excluir</button>

            </div>
        </td>
    </tr>
<?php
endforeach;
