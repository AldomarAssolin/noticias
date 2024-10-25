<div class="col-md-8">


    <h3 class="pb-2 fst-italic">
        Notícias e Releases
    </h3>
    <?php include('./components/navbarCategory.php'); ?>

    <div>
        <?php

        ?>
        <ul class="list-unstyled">
            <?php
            
            foreach ($result as $key => $value) {
            ?>
                <li>
                    <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" 
                        href="<?php echo INCLUDE_PATH ?>artigos?id=<?php echo urlencode($value['id']) ?>">
                        <div class="col-lg-3 m-auto">
                            <img src="<?php echo './painel/' . $value['img']?>" alt="imagem descritiva" class="img-card-list">
                        </div>
                        <div class="col-lg-9">
                            <span class="badge rounded-pill mb-2 text-bg-primary"><?php echo $value['tipo'] ? $value['tipo'] : 'Notícias' ?></span>                                                       
                            <h6 class="mb-0"><?php echo $value['titulo'] ?></h6>
                            <small class="text-body-secondary"><?php echo date('d/m/Y', strtotime($value['data_criacao'])); ?></small>
                        </div>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>




</div>