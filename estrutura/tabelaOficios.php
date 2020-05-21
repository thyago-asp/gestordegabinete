<?php
$url = '';
require_once "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerOficios.php";

$lista = (new ControllerOficios())->listarOficios();
$i = 0;
if(!isset($lista[0][0]['arquivo']['nome']))
    $totArq = 1;
else
    $totArq = count($lista[0][0]['arquivos']['nome']);
    
foreach ($lista as $key => $valor) :
?>
        
        <tr>
            <td><?php echo $valor['numDoc'] ?></td>
            <td><?php echo $valor['solicitante'] ?></td>
            <td><?php echo $valor['instituicao'] ?></td>
            <td><?php echo $valor['nome_de_contato'] ?></td>
            <td><?php echo $valor['data_cad_doc'] ?></td>
            <td><?php echo $valor['titulo'] ?></td>
            <td><?php echo $valor['status'] ?></td>
            <td class="text-center">
            <div class="btn-group text-center" role="group" aria-label="Button group">
                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modalArquivos"
                    <?php if(isset($valor[0])):
                            foreach($valor[0] as $chave => $inf):
                                    
                                while ($i < $totArq) {
                                    if(array_key_exists($i, $inf['nome'])){
                                        echo "data-nome$i='{$inf['nome'][$i]}'";
                                        echo "data-idArq$i='{$inf['idArquivo'][$i]}'"; 
                                        echo "data-fkOficioss$i='{$inf['fkArquivo'][$i]}'";
                                        echo "data-linkArq$i='{$inf['linkArq'][$i]}'";
                                    }
                                    $i++;          
                                }
                                
                                $totArq = count($inf['nome']);
                                $i = 0; 
                            endforeach;
                          endif; 
                    ?>
                
                ><i class="fa fa-folder-open" aria-hidden="true"></i>
                <!-- Botão editar -->
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

        ?>