<?php


$slides = Slides::listarSlides();

//var_dump($slides);

?>



<div class="p-4 p-md-0 mb-4 rounded text-body-emphasis bg-tertiary shadow">
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner  h-250">
        <?php
        $first = true;
        foreach($slides as $key => $value){
        ?>
        <div class="carousel-item h-250 <?php echo $first ? 'active' : ''; ?>">
            <img src="<?php echo INCLUDE_PATH_PAINEL.$value['imagem'] ?>" class="image-slide-home" alt="<?php echo $value['descricao'] ?>">
            <div class="carousel-caption d-none">
                <h5><?php echo $value['titulo'] ?></h5>
                <p><?php echo $value['descricao'] ?></p>
            </div><!-- carousel-caption -->
        </div><!-- carousel-item -->
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
<div class="row g-2 mb-2">
  <div class="col-md-6">
    <a href='<?php echo INCLUDE_PATH ?>artigos?id=<?php echo urlencode($result[1]['id']) ?>' class="card-link text-decoration-none">
      <div class="card mb-3" style="height: 225px;">
        <div class="row g-0">
          <div class="col-md-8">
            <div class="card-body">
              <div class="d-flex align-items-end justify-content-between">
                <h5 class="card-title"><?php echo $result[1]['titulo'] ?></h5>
                <strong class="d-inline-block mb-2 text-primary-emphasis"><?php echo $result[1]['tipo'] ? $result[1]['tipo'] : 'Notícias' ?></strong>
              </div><!-- d-flex -->
              <p class="card-text img-card-truncate"><?php echo $result[1]['descricao'] ?>...</p>
              <p class="card-text"><small class="text-body-secondary"><?php echo date('d/m/Y', strtotime($result[1]['data_criacao'])) ?></small></p>
            </div><!-- card-body -->
          </div><!-- col-md-8 -->
          <div class="col-md-4">
            <img class="image-card" src="<?php echo './painel/' . $result[1]['img'] ?>" alt="<?php echo $result[1]['titulo'] ?>" title="<?php echo $result[2]['titulo'] ?>">
          </div><!-- col-md-4 -->
        </div><!-- row -->
      </div><!-- card -->
    </a><!-- card-link -->
  </div><!-- col-md-6 -->
  <div class="col-md-6">
    <a href='<?php echo INCLUDE_PATH ?>artigos?id=<?php echo urlencode($result[2]['id']) ?>' class="card-link text-decoration-none">
      <div class="card mb-3" style="height: 225px;">
        <div class="row g-0">
          <div class="col-md-8">
            <div class="card-body">
              <div class="d-flex align-items-end justify-content-between">
                <h5 class="card-title"><?php echo $result[2]['titulo'] ?></h5>
                <strong class="d-inline-block mb-2 text-primary-emphasis"><?php echo $result[2]['tipo'] ? $result[2]['tipo'] : 'Notícias' ?></strong>
              </div><!-- d-flex -->
              <p class="card-text img-card-truncate"><?php echo $result[2]['descricao'] ?>...</p>
              <p class="card-text"><small class="text-body-secondary"><?php echo date('d/m/Y', strtotime($result[2]['data_criacao'])) ?></small></p>
            </div><!-- card-body -->
          </div><!-- col-md-8 -->
          <div class="col-md-4">
            <img class="image-card" src="<?php echo './painel/' . $result[2]['img'] ?>" alt="<?php echo $result[1]['titulo'] ?>" title="<?php echo $result[2]['titulo'] ?>">
          </div><!-- col-md-4 -->
        </div><!-- row -->
      </div><!-- card -->
    </a><!-- card-link -->
  </div><!-- col-md-6 -->
</div><!-- cards -->