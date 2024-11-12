<nav class="row border-bottom lh-1 py-2">
    <div class="col-12 col-md-8 mb-2 pb-2 mb-md-0 pb-md-0">
        <div class="row">
            <div class="col-12 col-md-4 pt-1">
                <div class="px-2">
                    <a class="navbar-brand text-uppercase d-flex justify-content-center align-items-end" href="<?php echo INCLUDE_PATH ?>">
                        <img src="<?php echo INCLUDE_PATH ?>/static/images/logomarca.png" alt="Logo do Site" width="160" height="40">
                    </a>
                </div>
            </div>
            <div class="col-md-8 d-none d-md-flex justify-content-center align-items-end">
                <a class="blog-header-logo text-body-emphasis  text-decoration-none" href="<?php echo INCLUDE_PATH ?>">Blog</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 d-flex align-items-end">
        <div class="w-100 d-flex justify-content-around align-items-end">
            <a class="link-secondary" href="#" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24">
                    <title>Search</title>
                    <circle cx="10.5" cy="10.5" r="7.5" />
                    <path d="M21 21l-5.2-5.2" />
                </svg>
            </a>
            <a class="blog-header text-body-emphasis  text-decoration-none mx-2" href="<?php echo INCLUDE_PATH ?>about">Sobre</a>
            <?php
            if (isset($_SESSION['login']) == false) {
                echo '<a class="link-secondary" href="' . INCLUDE_PATH_PAINEL . '">Entrar</a>';
            } else {
                if($_SESSION['cargo'] >= 1){
                echo '<a class="link-secondary mx-2  text-decoration-none" href="' . INCLUDE_PATH_PAINEL . '">Dashboard</a>';
                }
                echo '<a class="link-secondary  mx-2 text-decoration-none" href="' . INCLUDE_PATH_PAINEL . '?loggout">Sair</a>';
                echo '<a href="'. INCLUDE_PATH . 'perfil"><img class="rounded-circle" width="32" height="32" src="' . INCLUDE_PATH_PAINEL . $_SESSION['img'] . '" alt="Imagem do perfil"></a>';
            }

            ?>
        </div>
    </div>

</nav>