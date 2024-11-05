<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    

    // Chama a função pegarArtigo para pegar o artigo selecionado
    $artigo = Artigos::pegarArtigo($id);
    $usuario_id = $artigo['usuario_id'];

    // Chama a função listarArtigosAutor para pegar os artigos do autor selecionado
    $artigos = Artigos::listarArtigosAutor($usuario_id);
}


?>

<!-- botões para comentarios
<div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
<button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Primary button</button>
<button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
</div> 
-->

<section class="px-4 pt-2 my-5 border-bottom">
    <div class="text-center">
        <h3>
            <span class="badge text-bg-secondary">
                <?php echo $artigo['categoria'] ? $artigo['categoria'] : 'mundo' ?>
            </span>
        </h3>
        <h1 class="display-4 fw-bold text-body-emphasis py-3">
            <?php echo $artigo['titulo'] ?>
        </h1>
        <div class="overflow-hidden " style="max-height: 30vh;">
            <div class="container px-5">
                <img src="<?php echo INCLUDE_PATH_PAINEL . $artigo['img'] ?>" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
            </div>
        </div>
        <div class="mx-auto mt-5">
            <p class="lead mb-4"><?php echo $artigo['subtitulo'] ?></p>
            <blockquote class="blockquote mb-0">
                <footer class="blockquote-footer">
                    <img src="<?php echo INCLUDE_PATH_PAINEL . $artigo['avatar'] ?>" alt="" width="32" height="32" class="rounded-circle mx-2">
                    <cite title="Source Title">
                        <?php echo $artigo['nome'] ?>
                        <span class="mb-3"><?php echo date('My', strtotime($artigo['data_criacao'])); ?></span>
                    </cite>
                </footer>
            </blockquote>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center my-5">
                <a href="<?php echo INCLUDE_PATH ?>lista_artigos_autor?id=<?php echo $artigo['usuario_id'] ?>" class="btn btn-primary btn-lg px-4 me-sm-3">Mais artigos do autor</a>
                <a href="a" class="btn btn-outline-secondary btn-lg px-4">Favoritar</a>
            </div>
        </div>
    </div>

    <div class="my-5">
        <?php echo $artigo['conteudo'] ?>
    </div>

    <div class="comentario">
        <h3>Comentários</h3>
        <div class="comentario-item">
            <div class="comentario-item-header">
                <?php

                $comentarios = Comentarios::listarComentarios($id);

                if ($comentarios == false) {
                    echo '<h3 class="text-center">Nenhum comentário encontrado patra este artigo!</h3>';
                } else {

                    foreach ($comentarios as $key => $value) {

                ?>
                        <div class="comentario-item-info border p-2 rounded-2 mb-2">
                            <div class="row">
                                <div class="col-7">
                                    <h4>
                                        <img src="<?php echo INCLUDE_PATH_PAINEL . $value['img'] ?>" alt="<?php echo $value['nome'] ?>" class="rounded-circle" width="28" height="28">
                                        <?php echo $value['nome'] ?>
                                    </h4>
                                </div>
                                <div class="col-5 text-end">
                                    <span><?php echo date('d M y', strtotime($value['data_criacao'])) ?></span>
                                </div>
                            </div>
                            <div class="comentario-item-conteudo">
                                <?php echo $value['comentario'] ?>
                            </div>
                        </div><!-- Comentário-item-info -->

                    <?php
                    } //fim foreach comentarios
                } //fim else comentarios
                if ($_SESSION) {
                    try {
                        if (isset($_POST['acao']) && $_POST['acao'] == 'comentar') {
                            $comentario = $_POST['comentar'];
                            $status = 1;
                            $data_criacao = date('Y-m-d H:i:s');
                            $usuario_id = $_SESSION['id'];
                            $artigo_id = $id;
                            Comentarios::enviarComentario($comentario, $status, $data_criacao, $usuario_id, $artigo_id);
                            Painel::alert('sucesso', 'Comentário enviado com sucesso!');
                        }
                    } catch (Exception $e) {
                        Painel::alert('erro', $e->getMessage());
                    }
                    ?>
                    <div class="comentar">
                        <form method="post" class="d-flex border rounded-2 p-2 mb-2">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="comentar" class="form-label">Faça um comentário sobre este artigo</label>
                                    <input type="text" name="comentar" id="comentar" class="form-control" placeholder="Digite seu comentário" />
                                    <input type="submit" name="acao" value="comentar" class="mt-2">
                                </div>
                            </div>
                        </form>
                    </div><!-- Comentar -->
                <?php
                }
                ?>

            </div><!-- Comentário-item-header -->
        </div><!-- Comentário item -->
    </div>
</section>