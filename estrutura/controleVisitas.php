<?php

require_once "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerPessoasVisitas.php";
$lista = (new ControllerPessoasVisitas())->autoCompleteListagem();
?>
<div>
    <label for="nome">Nome visitante</label>
    <select class="form-control" id="visitas" name="nome">
        <option value=""></option>
        <?php
        foreach ($lista[0] as $key => $value) : ?>
            <option value="<?php echo $value['nome'] ?>"><?php echo $value['nome'] ?></option>
        <?php
        endforeach; ?>
    </select>
    <label for="cidade">Cidade</label>
    <select class="form-control" name="cidade" id="cidade">
        <option value=""></option>
        <?php
        foreach ($lista[0] as $key => $value) : ?>
            <option value="<?php echo $value['cidade'] ?>"><?php echo $value['cidade'] ?></option>
        <?php
        endforeach; ?>
    </select>
</div>