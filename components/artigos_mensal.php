<?php

$artigosMes = Artigos::listarArtigosMes();

?>

<div class="p-4">
    <h4 class="fst-italic">Archives</h4>
    <ol class="list-unstyled mb-0">
        <?php
        foreach ($artigosMes as $key => $value) {
            $dataCriacao = date('F Y', strtotime($value['data_criacao']));
            $mes = date('m', strtotime($value['data_criacao']));
            if ($key == 0) {

        ?>
                <li><a href="<?php echo INCLUDE_PATH . 'artigos_mes?mouth=' . $mes ?>"><?php echo $dataCriacao ?></a></li>
        <?php
            }
        }
        ?>
    </ol>
</div>