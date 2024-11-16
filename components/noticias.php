<?php

require_once('./conn/getAPI.php');
//var_dump($dataDestaque);

if ($dataDestaque) {
    if ($dataDestaque['error']) {
        $noticias = $dataDestaque['error'];
    } else {
        $noticias = $dataDestaque['data'];
    }
}


?>

<div>
    <h4 class="fst-italic">Notícias recentes</h4>
    <ul class="list-unstyled">
        <?php
        foreach ($noticias as $noticia) {
            $uri = $noticia['url'];
            $titulo = $noticia['title'];
            $data = $noticia['published_at'];
            $imagem = $noticia['image_url'];
            $categorias = $noticia['categories'];

            if ($imagem == null) {
                $imagem = 'https://via.placeholder.com/250x150';
            } else {
                $imagem = $imagem;
            }

        ?>
            <li>
                <a href="<?php echo $uri ?>" target="_blank" class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top">
                    <img src="<?php echo $imagem ?>" width="100%" height="96">
                    <div class="col-lg-8">
                        <h6 class="mb-0"><?php echo $titulo ?></h6>
                        <small class="text-body-secondary"><?php echo date('d M y', strtotime($data)) ?></small>
                    </div>
                </a>
            </li>

        <?php
        }

        ?>

    </ul>
</div>