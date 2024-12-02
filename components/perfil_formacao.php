<?php

$formacao = Perfil::getFormacao($id);
?>

<!--card formacao-->
<div class="mb-3">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title py-2">Formação</h2>
        </div>
    </div>
    <?php
    foreach ($formacao as $key => $value) {
    ?>
        <div class="d-flex text-body-secondary pt-3 border-bottom">
            <div class="row w-100">
                <div class="col-2 d-flex align-items-end pb-2">
                    <img src="<?php echo htmlspecialchars($value['logo']) ?>" class="card-img-top" alt="logo" width="80" height="80">
                </div><!--col-8-->
                <div class="col-10 d-flex flex-column align-items-start justify-content-end pb-2">
                    <p class="mb-0 small lh-sm">
                        <strong class="d-block text-gray-dark text-start mb-2"><?php echo htmlspecialchars(ucfirst($value['nivel'])) ?></strong>
                        <?php echo htmlspecialchars(ucfirst($value['nome'])) ?>
                        <span class="text-info fst-italic"><?php echo htmlspecialchars(ucfirst($value['instituicao'])) ?></span>
                    </p>
                    <small class="text-muted fst-italic">
                        <?php echo htmlspecialchars(strtoupper($value['cidade'])) ?> - <?php echo htmlspecialchars(strtoupper($value['uf'])) ?>
                        <?php echo date('d/m/Y', strtotime($value['data_inicio'])) ?> - <?php echo date('d/m/Y', strtotime($value['conclusao'])) ?>
                    </small>
                </div>
            </div><!--row-->
        </div><!--d-flex-->

    <?php
    }
    ?>

</div><!--card-->
<!--card formacao-->