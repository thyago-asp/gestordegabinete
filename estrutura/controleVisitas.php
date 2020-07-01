<?php

require_once "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerPessoasVisitas.php";
$listaCidades = (new ControllerPessoasVisitas())->autoCompleteListagem();
$listaPessoas = (new ControllerPessoasVisitas())->listarPessoas();
?>
<div>
    <label for="nome">Nome visitante</label>
    <select class="form-control" id="visitas" name="nome" aria-describedby="emailHelp">
        <option value=""></option>
        <?php
        foreach($listaPessoas as $item){
           
        ?>
            <option value="<?php echo $item->nome ?>"><?php echo $item->nome ?></option>
        <?php
        }
        ?>
    </select>
    <small id="emailHelp" class="form-text text-muted"><a href="/view/pessoas/cadastrar">Clique aqui para cadastar uma nova pessoa</a></small>
    <label for="cidade">Cidade</label>
    <select class="form-control" name="cidade" id="cidade">
        <option value=""></option>
        <?php
        foreach($listaCidades as $item){
           
        ?>
            <option value="<?php echo $item->cidade ?>"><?php echo $item->cidade ?></option>
        <?php
        }
        ?>
    </select>
</div>