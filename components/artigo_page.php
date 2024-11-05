<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Chama a função pegarArtigo para pegar o artigo selecionado
    $artigo = Artigos::pegarArtigo($id);
    $usuario_id = $artigo['usuario_id'];

    // Chama a função listarArtigosAutor para pegar os artigos do autor selecionado
    $artigos = Artigos::listarArtigosAutor($usuario_id);

?>

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link nav_link_autor text-capitalize" href="#"><?php echo $artigo['tipo'] ? $artigo['tipo'] : 'Notícia' ?></a>
                </li><!-- Tipo do artigo | Link para artigo do autor -->
                <li class="nav-item">
                    <a class="nav-link nav_link_autor text-capitalize" href="#">Mais de <strong><?php echo $artigo['nome'] ?></strong></a>
                </li><!-- Nome do autor | Link para artigos do autor -->
                <li class="nav-item">
                    <a class="nav-link nav_link_autor text-capitalize" href="#">Sobre o Autor <strong><?php echo $artigo['nome'] ?></strong></a>
                </li><!-- Sobre o autor | Link para página sobre o autor -->
            </ul>
        </div>
        <!-- Exibe o artigo selecionado -->
        <div class="card-body page">
            <h5 class="card-title"><?php echo $artigo['titulo'] ?></h5>
            <p class="card-text"><?php echo $artigo['conteudo'] ?></p>

            <?php
            if ($_SESSION) {
                // Verifica se o formulário de comentário foi enviado
            
                
            ?>
                <form class="comentar border rounded-1 p-2">
                    <label for="comentar">Comentar:</label>
                    <textarea name="comentar" id="comentar" rows="2" class="w-100"></textarea>
                    <div class="text-end">
                        <input type="submit" name="acao" value="comentar" class="btn btn-primary">
                    </div>
                </form><!-- Comentar -->

            <?php
            } 
            ?>
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