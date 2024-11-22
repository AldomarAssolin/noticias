<?php


$id = $_SESSION['id'] ?? '';
$imagem = INCLUDE_PATH . 'static/uploads/avatar.jpg';
$perfil = new Perfil();
$perfilData = $perfil->listarPerfilNomeAvatar($id);

if($_SESSION){
if ($perfilData != false) {
    $imagem = $perfilData['avatar'] ?? $imagem;
    $usuario = $perfilData['nome'];
} else {
    $imagem = $imagem;
    $usuario = $_SESSION['user'];
}
}

?>

<nav class="row navbar-top border-bottom lh-1 py-2">
    <div class="col-12 col-md-3 mb-2 pb-2 mb-md-0 pb-md-0">
        <div class="row">
            <div class="col-md-12 d-none d-md-flex justify-content-center align-items-end">
                <a class="blog-header-logo text-body-emphasis  text-decoration-none" href="<?php echo INCLUDE_PATH ?>"><?php echo NOME_EMPRESA ?></a>
            </div>
        </div>
    </div>

    <?php
    //Buscar artigos

    if (isset($_POST['buscar'])) {
        $buscar = $_POST['buscar'];
        $artigos = Artigos::buscarArtigos($buscar);

        if ($artigos == false) {
            echo '<div class="alert alert-danger" role="alert">
                    Nenhum artigo encontrado!
                </div>';
        }

        
    } else {
        $artigos = Artigos::listarArtigos();
    }
    
    ?>



    <div class="col-12 col-md-9">
        <div class="row d-flex align-items-center">
            <div class="col-12 col-md-6 mb-2">
                <a class="link-secondary" href="#" aria-label="Search">
                    <form method="post">
                        <div class="input-group flex-nowrap">
                            <input type="search" name="buscar" id="buscar" class="form-control py-0">
                            <span class="input-group-text" id="addon-wrapping">
                                <button type="submit" class="btn p-0" aria-describedby="addon-wrapping">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24">
                                        <title>Search</title>
                                        <circle cx="10.5" cy="10.5" r="7.5" />
                                        <path d="M21 21l-5.2-5.2" />
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form>
                </a>
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-between">
                <a class="blog-header text-body-emphasis  text-decoration-none mx-2" href="<?php echo INCLUDE_PATH ?>about">Sobre</a>
                <?php
                if (isset($_SESSION['login']) == false) {
                    echo '<a class="link-secondary" href="' . INCLUDE_PATH_PAINEL . '">Entrar</a>';
                } else {
                    if ($_SESSION['cargo'] >= 1) {
                        echo '<a class="link-secondary mx-2  text-decoration-none" href="' . INCLUDE_PATH_PAINEL . '">Dashboard</a>';
                    }
                    echo '<a class="link-secondary  mx-2 text-decoration-none" href="' . INCLUDE_PATH . '?logout">Sair</a>';
                    echo '<a href="' . INCLUDE_PATH . 'perfil_usuario?usuario='.$_SESSION['id'].'"><img class="rounded-circle" width="32" height="32" src="'. $imagem . '" alt="Imagem do perfil" title="' . $usuario . '"></a>';
                }
                ?>
            </div>
        </div><!--wrow-->
    </div><!--col-12 col-md-9-->

</nav>