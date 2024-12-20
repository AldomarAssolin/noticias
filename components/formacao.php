<?php

echo $mensagem;
foreach ($formacao as $key => $value) {
?>
    <div class="card mb-3">
        <div class="row">
            <div class="col-8">
                <div class="card-header fs-6 fst-italic">
                    <?php echo $value['nivel'] ?>
                </div>
                <div class="card-body">
                    <p>
                        <?php echo $value['nome'] ?> -
                        <span class="text-info"><?php echo $value['instituicao'] ?></span>
                    </p>
                    <p>
                        <?php echo $value['cidade'] ?> - <?php echo $value['uf'] ?>
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted fst-italic"><?php echo date('d/m/y', strtotime($value['data_inicio'])) ?> - <?php echo date('d/m/y', strtotime($value['conclusao'])) ?></small>
                </div>
            </div>
            <div class="col-4">
                <img src="<?php echo $value['logo'] ?>" class="card-img-top" alt="logo">
            </div>
        </div><!--row-->
    </div><!--card-->

<?php
}
?>