<div>
    <?php

    ?>
    <ul class="list-unstyled">
        <?php

        $url = $_GET['url'];

        switch ($url) {
            case 'mundo':
                $artigo = Artigos::listarArtigosCategoria('mundo');
                if (!$artigo) {
                    echo '<h3 class="text-center">Nenhum artigo encontrado</h3>';
                }
                break;
            case 'brasil':
                $artigo = Artigos::listarArtigosCategoria('brasil');
                if (!$artigo) {
                    echo '<h3 class="text-center">Nenhum artigo encontrado</h3>';
                }
                break;
            case 'ti':
                $artigo = Artigos::listarArtigosCategoria('programacao');
                if (!$artigo) {
                    echo '<h3 class="text-center">Nenhum artigo encontrado</h3>';
                }
                break;
            case 'programacao':
                $artigo = Artigos::listarArtigosCategoria('programacao');
                if (!$artigo) {
                    echo '<h3 class="text-center">Nenhum artigo encontrado</h3>';
                }
                break;
            case 'curiosidades':
                $artigo = Artigos::listarArtigosCategoria('curiosidades');
                if (!$artigo) {
                    echo '<h3 class="text-center">Nenhum artigo encontrado</h3>';
                }
                break;
            default:
                $artigo = $result;
                break;
        }

        foreach ($artigo as $key => $value) {
        ?>
            <li>
                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                    href="<?php echo INCLUDE_PATH ?>artigos?id=<?php echo urlencode($value['id']) ?>">
                    <div class="col-lg-3 m-auto">
                        <img src="<?php echo './painel/' . $value['img'] ?>" alt="imagem descritiva" class="img-card-list">
                    </div>
                    <div class="col-lg-9">
                        <span class="badge rounded-pill mb-2 text-bg-primary"><?php echo $value['categoria'] ? $value['categoria'] : 'mundo' ?></span>
                        <h6 class="mb-0"><?php echo $value['titulo'] ?></h6>
                        <small class="text-body-secondary"><?php echo date('M y', strtotime($value['data_criacao'])); ?></small>
                    </div>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
</div>