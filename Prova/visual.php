<?php
$this->view('relatorios/cabecalho');
?>

<table  class="relatorio container">
<thead>
    <tr>
        <th style="width: 10%;text-align: center;">Classificação</th>
        <th style="width: 25%;text-align: center;">Plano de Contas </th>
        <?php
        /**
        * Array de títulos da tabela, com as entidades
        */
        foreach($entidades as $entidade) {
         echo '<th style="width: 25%;text-align: center;">'.$entidade.'</th>';
        }
        ?>
    </tr>
</thead>

        <tr>
        <?php
        foreach($fluxos as $fluxo) {
            $temp = [];
            /**
            * Lista os fluxos de acordo com a classificação da natureza de lançamento
            */
            echo '<tr>';
            echo '<td style="width: 10%;text-align: left;">'.$fluxo['classificacao'].'</td>';
            echo '<td style="width: 25%;text-align: left;">'.$fluxo['descricao'].'</td>';
            /**
             * Repetição da lista de preços e entidades
             */
            $precos = preg_split('/[,]/', preg_replace('/[][]/', '', $fluxo['array_entidade']));
            foreach($precos as $preco) {
                /**
                * Explode a entidade e seu devido preço, inserindo no array temporário, sendo a chave entidade e o valor o preço
                */
                $preco = preg_split('/[=>]/', $preco);
                $temp[$preco[0]] = $preco[2];
            }
            /**
             * Lista os preços de acordo com as entidades da tabela
             */
            foreach($entidades as $key => $entidade) {
                echo '<td style="width: 25%;text-align: '.(!empty($temp[$key]) && $temp[$key] > 0 ? 'right' : 'center').';">'.(!empty($temp[$key]) && $temp[$key] > 0 ? 'R$ '.number_format($temp[$key],2,",",".") : '-').'</td>';
            }
            echo '</tr>';
            /**
             * Limpa a variável temporária, para liberar memória
             */
            unset($temp);
        }
        ?>
        </tr>
</table>

<?php
$this->view('relatorios/rodape');
?>