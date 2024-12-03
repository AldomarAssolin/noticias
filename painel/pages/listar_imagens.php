<?php

// Caminho para as imagens
$imageDir = BASE_DIR . 'static/images/';
$uploadsDir = BASE_DIR . 'uploads/';

// Lista os arquivos do diretório
$imageDir = scandir($imageDir);
$uploadsDir = scandir($uploadsDir);

?>
<div class="container">

    <!-- Exibe as imagens estáticas -->
    <div class="mt-5">
        <h2 class="border-bottom pb-2">Imagens estáticas</h2>
        <div class="d-flex align-itens-center flex-wrap">
            <?php
            foreach ($imageDir as $key => $value) {
                if ($value == '.' || $value == '..') {
                    continue;
                }
            ?>
                <div class="img m-2">
                    <img src="<?php echo INCLUDE_PATH ?>static/images/<?php echo $value ?>" alt="" class="img-thumbnail" style="width:10em;height:8em;">
                </div>
            <?php
            }
            ?>
        </div>
        <!-- Exibe as imagens estáticas -->
    </div>

    <!-- Exibe os uploads de imagens -->
    <div class="mt-5">
        <h2 class="border-bottom pb-2">Uploads de Imagens</h2>
        <div class="d-flex align-itens-center flex-wrap">
            <?php
            foreach ($uploadsDir as $key => $value) {
                if ($value == '.' || $value == '..') {
                    continue;
                }
            ?>
                <div class="img m-2">
                    <img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $value ?>" alt="" class="img-thumbnail" style="width:10em;height:8em;">
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- Exibe os uploads de imagens -->


</div>