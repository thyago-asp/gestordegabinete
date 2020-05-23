<?php
require  "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerPessoaFisica.php";
require  "{$_SERVER['DOCUMENT_ROOT']}/controller/ControllerPessoaJuridica.php";

// instancia do controller de PJ
$tabelaJuridica = (new ControllerPessoaJuridica())->listarTodosJuridico();

// instancia do controller de PF
$tab = (new ControllerPessoaFisica())->listarPF();

// criacao de um array com os dados de ambas as tabelas
$tabela = [$tabelaJuridica, $tab];

// foreach dentro de outro para remover o primeiro indice do array
// e deixar percorrer a partir das informacoes que interessam

foreach ($tabela as $chave => $valor) :

  foreach ($valor as $chave => $inf) :
   
    ?>

    <tr>
      <td><?php echo $inf['nome'] ?></td>
      <td><?php echo $inf['telefone'] ?></td>
      <td><?php echo $inf['data_nascimento'] ?></td>
      <td><?php echo $inf['cidade'] ?></td>
      <td><?php echo $inf['estado'] ?></td>
      <td><?php echo $inf['categoria'] ?></td>
      <td class="text-center">
        <div class="btn-group text-center" role="group" aria-label="Button group">
          <!-- Botão editar -->
          <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao"
                  <?php if(array_key_exists("idt_pessoa_fisica", $inf)) {?>
                  
                    data-nome="<?php echo $inf['nome'] ?>"
                    data-idt_pessoa="<?php echo $inf['idt_pessoa'] ?>" 
                    data-email="<?php echo $inf['email'] ?>"
                    data-t_endereco_idt_endereco="<?php echo $inf['t_endereco_idt_endereco'] ?>" 
                    data-idt_endereco="<?php echo $inf['idt_endereco'] ?>"
                    data-cep="<?php echo $inf['cep'] ?>"
                    data-complemento="<?php echo $inf['complemento'] ?>"
                    data-idt_pessoa_fisica="<?php echo $inf['idt_pessoa_fisica'] ?>"
                    data-cpf="<?php echo $inf['cpf'] ?>" 
                    data-nascimento="<?php echo $inf['data_nascimento']?>"
                    data-sexo="<?php echo $inf['sexo'] ?>" 
                    data-categoria="<?php echo $inf['categoria'] ?>"
                    data-t_pessoa_idt_pessoa="<?php echo $inf['t_pessoa_idt_pessoa'] ?>"  
                    data-telefone="<?php echo $inf['telefone'] ?>" 
                    data-numero="<?php echo $inf['numero'] ?>"
                    data-endereco="<?php echo $inf['endereco'] ?>" 
                    data-bairro="<?php echo $inf['bairro'] ?>" 
                    data-cidade="<?php echo $inf['cidade'] ?>"
                    data-estado="<?php echo $inf['estado'] ?>"
                    data-arquivo="../../<?php echo $inf['arquivo'] ?>"

                  <?php } else { ?>
                    
                    data-idt_pessoa="<?php echo $inf['idt_pessoa'] ?>"
                    data-nome="<?php echo $inf['nome'] ?>"
                    data-telefone="<?php echo $inf['telefone'] ?>"
                    data-email="<?php echo $inf['email'] ?>"
                    data-t_endereco_idt_endereco="<?php echo  $inf['t_endereco_idt_endereco'] ?>"
                    data-idt_endereco="<?php echo $inf['idt_endereco'] ?>"
                    data-endereco="<?php echo $inf['endereco'] ?>"
                    data-cep="<?php echo $inf['cep'] ?>"
                    data-complemento="<?php echo $inf['complemento'] ?>"
                    data-numero="<?php echo $inf['numero'] ?>"
                    data-cidade="<?php echo $inf['cidade'] ?>"
                    data-estado="<?php echo $inf['estado'] ?>"
                    data-t_pessoa_idt_pessoa="<?php echo $inf['t_pessoa_idt_pessoa'] ?>"
                    data-cnpj="<?php echo $inf['cnpj'] ?>"
                    data-bairro="<?php echo $inf['bairro'] ?>"
                    data-nome_fantasia="<?php echo $inf['nome_fantasia'] ?>"
                    data-atividade="<?php echo $inf['atividade'] ?>"
                  
                  <?php } ?>
                  ><i class="fa fa-th-list" aria-hidden="true"></i></button>
          <!-- Botão excluir -->
          <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" 
          <?php if(array_key_exists("idt_pessoa_fisica", $inf)) {?>
              
                  data-idt_pessoa_fisica="<?php echo $inf['idt_pessoa_fisica'] ?>"
                  data-idt_pessoa="<?php echo $inf['idt_pessoa'] ?>" 
                  data-nome="<?php echo $inf['nome'] ?>"
                  data-idt_endereco="<?php echo $inf['idt_endereco'] ?>"
                  data-t_endereco_idt_endereco="<?php echo $inf['t_endereco_idt_endereco'] ?>"
                  data-t_pessoa_idt_pessoa="<?php echo $inf['t_pessoa_idt_pessoa'] ?>"  
                
                  
                <?php } else { ?>
                  
                  data-idt_pessoa="<?php echo $inf['idt_pessoa'] ?>"
                  data-nome="<?php echo $inf['nome'] ?>"
                  data-t_endereco_idt_endereco="<?php echo  $inf['t_endereco_idt_endereco'] ?>"
                  data-idt_endereco="<?php echo $inf['idt_endereco'] ?>"
                  data-t_pessoa_idt_pessoa="<?php echo $inf['t_pessoa_idt_pessoa'] ?>"
        
                
                <?php } ?>
                  >Excluir</button>

        </div>
      </td>
    </tr>
  <?php endforeach;
endforeach;
