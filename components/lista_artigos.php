<div>
    <?php

    $imagem = INCLUDE_PATH . 'static/uploads/avatar.jpg';
    $img = $imagem;

    ?>
    <ul class="list-unstyled px-2">
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
        
        foreach($artigo as $key => $value){
        

        ?>
            <li class="p-2 border-top">
                <a class="py-3 mb-2 link-body-emphasis text-decoration-none" href="<?php echo INCLUDE_PATH ?>artigos?id=<?php echo urlencode($value['id']) ?>">
                    <div class="card mb-2 border-0 d-flex flex-column flex-lg-row align-items-center">
                        <div class="col-lg-3 px-2 mb-2 mb-md-0">
                            <img src="<?php echo INCLUDE_PATH_PAINEL . $value['capa'] ?>" alt="imagem descritiva" width="200" height="200">
                        </div>
                        <div class="col-lg-9">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="mb-0"><?php echo $value['titulo'] ?></h6>
                                    </div><!--col-->
                                    <div class="col-6 text-end">
                                        <span class="badge rounded-pill mb-2 text-bg-primary"><?php echo $value['categoria'] ? $value['categoria'] : 'mundo' ?></span>
                                    </div><!--col-->
                                </div><!--row-->
                            </div>
                            <div class="card-body">
                                <p class="text-body-secondary mt-2"><?php echo $value['descricao'] ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-6">
                                        <img src="<?php echo INCLUDE_PATH_PAINEL . $value['avatar'] == NULL ? INCLUDE_PATH_PAINEL . $value['avatar'] : $img ?>" alt="imagem descritiva" class="rounded-circle" width="16" height="16">
                                        <span class="fs-6 fst-italic"><?php echo $value['autor'] != NULL ? $value['autor'] : $value['email'] ?></span>
                                    </div><!--col-->
                                    <div class="col-6 text-end">
                                        <small class="text-body-secondary"><?php echo date('M y', strtotime($value['data_criacao'])); ?></small>
                                    </div><!--col-->
                                </div><!--row-->
                            </div><!--card-footer-->
                        </div><!--col-9-->
                    </div><!--card-->
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
</div>
