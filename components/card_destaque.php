<?php
//Objetivo: listar os slides cadastrados no banco de dados
$slides = Slides::listarSlides();
?>
<!--Slides-->
<div class="p-md-0 mb-4 rounded text-body-emphasis bg-tertiary border-bottom">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $first = true;
            foreach ($slides as $key => $value) {
            ?>
                <a href="<?php echo $value['link'] ?>" target="_blank">
                    <div class="carousel-item h-250 <?php echo $first ? 'active' : ''; ?>">
                        <img src="<?php echo $value['imagem'] ?>" class="image-slide-home" alt="<?php echo $value['descricao'] ?>">
                        <div class="carousel-caption d-none">
                            <h5><?php echo $value['titulo'] ?></h5>
                            <p><?php echo $value['descricao'] ?></p>
                        </div><!-- carousel-caption -->
                    </div><!-- carousel-item -->
                </a>
            <?php
                $first = false;
            }
            ?>
        </div><!-- carousel-inner -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div><!-- carousel -->
</div><!-- p-4 -->
<!--Slides-->