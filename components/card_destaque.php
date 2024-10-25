<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-tertiary">
  <div id="carouselExampleDark" class="carousel carousel-dark slide slide-home">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div><!-- indicators -->
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="10000">
        <img src="..." class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Some representative placeholder content for the first slide.</p>
        </div><!-- carousel-caption -->
      </div><!-- carousel-item -->
      <div class="carousel-item" data-bs-interval="2000">
        <img src="..." class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Second slide label</h5>
          <p>Some representative placeholder content for the second slide.</p>
        </div><!-- carousel-caption -->
      </div><!-- carousel-item -->
      <div class="carousel-item">
        <img src="..." class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Third slide label</h5>
          <p>Some representative placeholder content for the third slide.</p>
        </div><!-- carousel-caption -->
      </div><!-- carousel-item -->
    </div><!-- carousel-inner -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button><!-- carousel-control-prev -->
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button><!-- carousel-control-next -->
  </div><!-- carousel -->
</div><!-- p-4 -->
<div class="row g-2 mb-2">
  <div class="col-md-6">
    <a href='<?php echo INCLUDE_PATH ?>artigo_page/<?php echo urlencode($result[1]['titulo']) ?>' class="card-link text-decoration-none">
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
    <a href='<?php echo INCLUDE_PATH ?>artigo_page/<?php echo urlencode($result[2]['titulo']) ?>' class="card-link text-decoration-none">
      <div class="card mb-3" style="height: 225px;">
        <div class="row g-0">
          <div class="col-md-8">
            <div class="card-body">
              <div class="d-flex align-items-end justify-content-between">
                <h5 class="card-title"><?php echo $result[1]['titulo'] ?></h5>
                <strong class="d-inline-block mb-2 text-primary-emphasis"><?php echo $result[1]['tipo'] ? $result[1]['tipo'] : 'Notícias' ?></strong>
              </div><!-- d-flex -->
              <p class="card-text img-card-truncate"><?php echo $result[2]['descricao'] ?>...</p>
              <p class="card-text"><small class="text-body-secondary"><?php echo date('d/m/Y', strtotime($result[1]['data_criacao'])) ?></small></p>
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