<?php
require  "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerPessoaFisica.php";
require  "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerPessoaJuridica.php";


// instancia do controller de PJ
$listaPessoaJuridica = (new ControllerPessoaJuridica())->listarTodosJuridico();

// instancia do controller de PF
$listaPessoaFisica = (new ControllerPessoaFisica())->listarPF();

// monta os registros das pessoas fisicas
foreach ($listaPessoaFisica as $pf) {
  $categoria   = "";
  switch ($pf->categoria) {

    case 'dep.estadual':
      $categoria = "Deputados estadual";
      break;
    case 'dep.estadual':
      $categoria = "Deputados estadual";
      break;
    case 'dep.federal':
      $categoria = "Deputados federal";
      break;
    case 'sec.estado':
      $categoria = "Secretário do estado";
      break;
    case 'familia':
      $categoria = "Família";
      break;
    case 'lideranca':
      $categoria = "Liderança";
      break;
    case 'geral':
      $categoria = "Geral";
      break;
    case 'prefeito':
      $categoria = "Prefeito";
      break;
    case 'vereador':
      $categoria = "Vereador";
      break;
  }

?>
  <tr>
    <td><?php echo $pf->nome ?></td>
    <td>
      <ol type="a">
        <?php

        if ($pf->telefone != "") {
        ?><li><?php echo $pf->telefone ?></li><?php
                                            }
                                            if ($pf->telefone2 != "") {
                                              ?><li><?php echo $pf->telefone2 ?></li><?php
                                                }

                                                if ($pf->telefone3 != "") {
                                                  ?><li><?php echo $pf->telefone3 ?></li><?php
                                                    }

                                                      ?>
      </ol>
    </td>
    <td><?php echo $pf->nascimento ?></td>
    <td><?php echo $pf->cidade ?></td>

    <td><?php echo $categoria ?></td>

    <td class="text-center">
      <div class="btn-group text-center" role="group" aria-label="Button group">
        <!-- Botão editar -->
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" data-nome="<?php echo $pf->nome ?>" data-idt_pessoa="<?php echo $pf->idt_pessoa ?>" data-email="<?php echo $pf->email ?>" data-t_endereco_idt_endereco="<?php echo $pf->t_endereco_idt_endereco ?>" data-idt_endereco="<?php echo $pf->idt_endereco ?>" data-cep="<?php echo $pf->cep ?>" data-complemento="<?php echo $pf->complemento ?>" data-idt_pessoa_fisica="<?php echo $pf->idt_pessoa_fisica ?>" data-cpf="<?php echo $pf->cpf ?>" data-nascimento="<?php echo $pf->nascimento ?>" data-sexo="<?php echo $pf->sexo ?>" data-categoria="<?php echo $pf->categoria ?>" data-t_pessoa_idt_pessoa="<?php echo $pf->t_pessoa_idt_pessoa ?>" data-telefone="<?php echo $pf->telefone ?>" data-telefone2="<?php echo $pf->telefone2 ?>" data-telefone3="<?php echo $pf->telefone3 ?>" data-numero="<?php echo $pf->numero ?>" data-endereco="<?php echo $pf->endereco ?>" data-bairro="<?php echo $pf->bairro ?>" data-cidade="<?php echo $pf->cidade ?>" data-estado="<?php echo $pf->estado ?>" data-arquivo="../../<?php echo $pf->arquivo ?>"><i class="fa fa-th-list" aria-hidden="true"></i></button>
        <!-- Botão excluir -->
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" data-idt_pessoa_fisica="<?php echo $pf->idt_pessoa_fisica ?>" data-idt_pessoa="<?php echo $pf->idt_pessoa ?>" data-nome="<?php echo $pf->nome ?>" data-idt_endereco="<?php echo $pf->idt_endereco ?>" data-t_endereco_idt_endereco="<?php echo $pf->t_endereco_idt_endereco ?>" data-t_pessoa_idt_pessoa="<?php echo $pf->t_pessoa_idt_pessoa ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>

      </div>
    </td>
  </tr>
<?php
}

// monta os registros das pessoas juridicas
foreach ($listaPessoaJuridica as $inf) {
?>

  <tr>
    <td><?php echo $inf['nome'] ?></td>
    <td>
      <ol type="a">
        <?php
        $cont = 1;
        while ($cont <= 3) {

          if ($cont == 1) {
        ?><li><?php echo $inf['telefone'] ?></li><?php
                                                } else {
                                                  if ($inf['telefone' . $cont] != "") {
                                                  ?><li><?php echo $inf['telefone' . $cont] ?></li><?php
                                                                                                    }
                                                                                                  }
                                                                                                  $cont++;
                                                                                                }
                                                                                                      ?>
      </ol>
    </td>

    <td class="text-center"><?php echo " PJ - Não tem data de nascimento" ?></td>

    <td><?php echo $inf['cidade'] ?></td>

    <td class="text-center"><?php echo " PJ - Não tem categoria " ?></td>

    <td class="text-center">
      <div class="btn-group text-center" role="group" aria-label="Button group">
        <!-- Botão editar -->
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" data-idt_pessoa="<?php echo $inf['idt_pessoa'] ?>" data-nome="<?php echo $inf['nome'] ?>" data-telefone="<?php echo $inf['telefone'] ?>" data-telefone2="<?php echo $inf['telefone2'] ?>" data-telefone3="<?php echo $inf['telefone3'] ?>" data-email="<?php echo $inf['email'] ?>" data-t_endereco_idt_endereco="<?php echo  $inf['t_endereco_idt_endereco'] ?>" data-idt_endereco="<?php echo $inf['idt_endereco'] ?>" data-endereco="<?php echo $inf['endereco'] ?>" data-cep="<?php echo $inf['cep'] ?>" data-complemento="<?php echo $inf['complemento'] ?>" data-numero="<?php echo $inf['numero'] ?>" data-cidade="<?php echo $inf['cidade'] ?>" data-estado="<?php echo $inf['estado'] ?>" data-t_pessoa_idt_pessoa="<?php echo $inf['t_pessoa_idt_pessoa'] ?>" data-cnpj="<?php echo $inf['cnpj'] ?>" data-bairro="<?php echo $inf['bairro'] ?>" data-nome_fantasia="<?php echo $inf['nome_fantasia'] ?>" data-atividade="<?php echo $inf['atividade'] ?>" ?><i class="fa fa-th-list" aria-hidden="true"></i></button>
        <!-- Botão excluir -->
        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" data-idt_pessoa="<?php echo $inf['idt_pessoa'] ?>" data-nome="<?php echo $inf['nome'] ?>" data-t_endereco_idt_endereco="<?php echo  $inf['t_endereco_idt_endereco'] ?>" data-idt_endereco="<?php echo $inf['idt_endereco'] ?>" data-t_pessoa_idt_pessoa="<?php echo $inf['t_pessoa_idt_pessoa'] ?>" ?><i class="fa fa-trash" aria-hidden="true"></i></button>

      </div>
    </td>
  </tr>
<?php
}
