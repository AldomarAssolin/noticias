<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $artigo = Artigos::pegarArtigo($id);
    // Chama a função listarArtigosAutor para pegar os artigos do autor selecionado
    $artigos = Artigos::listarArtigosAutor($id);
    //var_dump($artigos);
?>
<div class="col-md-8">
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link nav_link_autor" href="#"><?php echo $artigo['tipo'] ? $artigo['tipo'] : 'Notícia' ?></a>
                </li><!-- Tipo do artigo | Link para artigo do autor -->
                <li class="nav-item">
                    <a class="nav-link nav_link_autor" href="#">Mais de <strong><?php echo $artigo['nome'] ?></strong></a>
                </li><!-- Nome do autor | Link para artigos do autor -->
                <li class="nav-item">
                    <a class="nav-link nav_link_autor" href="#">Sobre o Autor <strong><?php echo $artigo['nome'] ?></strong></a>
                </li><!-- Sobre o autor | Link para página sobre o autor -->
            </ul>
        </div>
        <!-- Exibe o artigo selecionado -->
        <div class="card-body page">
            <h5 class="card-title"><?php echo $artigo['titulo'] ?></h5>
            <p class="card-text"><?php echo $artigo['conteudo'] ?></p>
        </div>
        <!-- Fim artigo selecionado -->
        <!-- Exibe os artigos do autor -->
        <div class="card-body page">
            <?php
            if ($artigos == false) {
                Painel::alert('erro', 'Autor não encontrado!');
            } else {
                foreach ($artigos as $key => $value) {

            ?>
                    <h5 class="card-title"><?php echo $value['nome'] ? $value['nome'] : '' ?></h5>
                    <p class="card-text"><?php echo $value['titulo'] ? $value['titulo'] : '' ?></p>

        <?php
                }
            }
        } else {
            Painel::alert('erro', 'Você precisa passar o slug do artigo!');
        }

        ?>
        <!--fim artigos do autor-->
        </div>
        <div class="card-body page">
            <h5 class="card-title">Sobre o autor</h5>
            <p class="card-text">Aqui será exibida a página sobre o autor</p>
        </div>
    </div>
    <h2></h2>
    <p></p>
</div>