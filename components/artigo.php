<?php
//Padrao de imagem
$avatar = '';
$capa = '';
if ($avatar == null || $avatar == '' || $capa == null || $capa == '') {
    $avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
    $capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
};

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Chama a função pegarArtigo para pegar o artigo selecionado
    $artigo = Artigos::pegarArtigo($id);

    // Chama a função listarPerfilUsuario para pegar o perfil do usuário
    $perfil = Perfil::listarPerfilNomeAvatar($artigo['usuario_id']);
} else {
    header('Location: ' . INCLUDE_PATH);
    die();
}


?>

<section class="px-4 pt-2 my-5 border-bottom  bg-body-secondary">
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
                <img src="<?php echo $artigo['img'] ? $artigo['img'] : $capa ?>" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
            </div>
        </div>
        <div class="mx-auto mt-5">
            <p class="lead mb-4"><?php echo $artigo['subtitulo'] ?></p>
            <blockquote class="blockquote mb-0">
                <footer class="blockquote-footer">
                    <img src="<?php echo $perfil['avatar'] ?>" alt="" width="32" height="32" class="rounded-circle mx-2">
                    <cite title="Source Title">
                        <?php echo $perfil['nome'] ?? 'John Doe' ?> -
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

    <div class="conteudo my-5">
        <?php echo $artigo['conteudo'] ?>
    </div>

    <div class="comentario">
        <h3>Comentários</h3>
        <div class="comentario-item">
            <div class="comentario-item-header">
                <?php

                //Criar comentario 
                if (isset($_POST['acao']) && $_POST['acao'] == 'comentar') {
                    $comentario = $_POST['comentar'];
                    $status = 1;
                    $data_criacao = date('Y-m-d H:i:s');
                    $usuario_id = $_SESSION['id'];
                    $artigo_id = $id;
                    Comentarios::enviarComentario($comentario, $status, $data_criacao, $usuario_id, $artigo_id);
                    Painel::alert('sucesso', 'Comentário enviado com sucesso!');
                }
                Comentarios::listarComentarios($id);

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
                                        <img src="<?php echo $value['avatar'] ?? $avatar ?>" alt="<?php echo $value['nome'] ?>" class="rounded-circle" width="28" height="28">
                                        <?php echo $value['nome'] ? $value['nome'] : $value['email'] ?>
                                    </h4>
                                </div>
                                <div class="col-5 text-end">
                                    <span><?php echo date('d M y', strtotime($value['data_criacao'])) ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10">
                                    <p><?php echo $value['comentario'] ?></p>
                                </div>
                                <?php
                                if ($_SESSION) {
                                ?>
                                    <div class="col-2">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-12 text-end">
                                                    <input type="submit" name="acao" value="editar" class="btn btn-sm btn-outline-warning mt-2">
                                                    <input type="submit" name="acao" value="excluir" class="btn btn-sm btn-outline-danger mt-2">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php
                                }
                                ?>
                            </div><!-- rowo -->
                        </div><!-- Comentário-item-info -->

                    <?php
                    } //fim foreach comentarios
                } //fim else comentarios
                if ($_SESSION) {

                    ?>
                    <div class="comentar">
                        <form method="post" class="d-flex border rounded-2 p-2 mb-2">
                            <div class="col">
                                <div class="mb-3">
                                    <div class="text-start">
                                        <label for="comentar" class="form-label">Faça um comentário sobre este artigo</label>
                                        <input type="text" name="comentar" id="comentar" class="form-control" placeholder="Digite seu comentário" />
                                        <input type="submit" name="acao" value="comentar" class="btn btn-outline-success mt-2">
                                    </div>
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