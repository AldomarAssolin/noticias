<nav class="row flex-nowrap justify-content-between align-items-center border-bottom lh-1 py-3">
    <div class="col-3 pt-1 ">
        <div class="px-2">
            <a class="navbar-brand text-uppercase" href="<?php echo INCLUDE_PATH ?>"><?php echo NOME_EMPRESA ?></a>

        </div>
    </div>
    <div class="col-4 text-center">
        <a class="blog-header-logo text-body-emphasis align-items-center text-decoration-none" href="<?php echo INCLUDE_PATH ?>">Blog</a>
    </div>
    <div class="col-5 d-flex justify-content-end align-items-center">
        <a class="link-secondary" href="#" aria-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24">
                <title>Search</title>
                <circle cx="10.5" cy="10.5" r="7.5" />
                <path d="M21 21l-5.2-5.2" />
            </svg>
        </a>
        <?php

        try {
            if (isset($_SESSION['online']) == false) {
                echo '<a class="link-secondary" href="' . INCLUDE_PATH_PAINEL . '">Entrar</a>';
            } else {
                echo '<a class="link-secondary mx-2  text-decoration-none" href="' . INCLUDE_PATH_PAINEL . '">Dashboard</a>';
                echo '<a class="link-secondary  text-decoration-none" href="' . INCLUDE_PATH_PAINEL . '?loggout">Sair</a>';
            }
        } catch (Exception $e) {
            echo 'ERRO'; //'<a class="link-secondary" href="' . INCLUDE_PATH_PAINEL . '">Entrar</a>';
        }

        ?>
    </div>

</nav>