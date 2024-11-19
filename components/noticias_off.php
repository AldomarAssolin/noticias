<div>
    <h4 class="fst-italic">Notícias recentes</h4>
    <ul class="list-unstyled">
        <?php

        $imagem = 'https://via.placeholder.com/250x150';

        for ($i = 0; $i < 3; $i++) {



        ?>
            <li>
                <a href="#" target="_blank" class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top">
                    <img src="<?php echo $imagem ?>" width="100%" height="96">
                    <div class="col-lg-8">
                        <h6 class="mb-0">Título</h6>
                        <small class="text-body-secondary"><?php echo 'Nov 24' ?></small>
                    </div>
                </a>
            </li>

        <?php
        }

        ?>

    </ul>
</div>