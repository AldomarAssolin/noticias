<?php
// Configurações padrão de imagem
$avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
$capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';

// Verificar e obter o ID do artigo
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!$id) {
    header('Location: ' . INCLUDE_PATH);
    exit;
}

// Obter dados do artigo e perfil do autor
$artigo = Artigos::pegarArtigo($id);
if (!$artigo) {
    header('Location: ' . INCLUDE_PATH);
    exit;
}
$perfil = Perfil::listarPerfilNomeAvatar($artigo['usuario_id']);

// Processar ações de comentários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = filter_input(INPUT_POST, 'acao', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $comentario_id = filter_input(INPUT_POST, 'comentario_id', FILTER_SANITIZE_NUMBER_INT);

    switch ($acao) {
        case 'comentar':
            $comentario = filter_input(INPUT_POST, 'comentar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($comentario) {
                $resultado = Comentarios::create($comentario, 1, date('Y-m-d H:i:s'), $_SESSION['id'], $id);
                if ($resultado) {
                    Painel::alert('sucesso', 'Comentário enviado com sucesso!');
                } else {
                    Painel::alert('erro', 'Erro ao enviar comentário.');
                }
            }
            break;
        case 'editar':
            $novo_comentario = filter_input(INPUT_POST, 'editar_comentario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($novo_comentario && $comentario_id) {
                $resultado = Comentarios::update($comentario_id, $novo_comentario);
                if ($resultado) {
                    Painel::alert('sucesso', 'Comentário atualizado com sucesso!');
                } else {
                    Painel::alert('erro', 'Erro ao atualizar comentário.');
                }
            }
            break;
        case 'excluir':
            if ($comentario_id) {
                $resultado = Comentarios::delete($comentario_id);
                if ($resultado) {
                    Painel::alert('sucesso', 'Comentário excluído com sucesso!');
                } else {
                    Painel::alert('erro', 'Erro ao excluir comentário.');
                }
            }
            break;
    }
}

// Obter comentários
$comentarios = Comentarios::getAll($id);
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
        <?php if ($comentarios): ?>
            <?php foreach ($comentarios as $comentario): ?>
                <div class="comentario-item-info border p-2 rounded-2 mb-2">
                    <div class="row">
                        <div class="col-7">
                            <h4>
                                <img src="<?php echo $comentario['avatar'] ?? $avatar ?>" alt="<?php echo htmlspecialchars($comentario['nome']) ?>" class="rounded-circle" width="28" height="28">
                                <?php echo htmlspecialchars($comentario['nome'] ?: $comentario['email']) ?>
                            </h4>
                        </div>
                        <div class="col-5 text-end">
                            <span><?php echo date('d M y', strtotime($comentario['data_criacao'])) ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <p id="comentario-<?php echo $comentario['id'] ?>"><?php echo $comentario['comentario'] ?></p>
                        </div>
                        <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $comentario['usuario_id']): ?>
                            <div class="col-2">
                                <button onclick="editarComentario(<?php echo $comentario['id'] ?>)" class="btn btn-sm btn-outline-warning mt-2">Editar</button>
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="comentario_id" value="<?php echo $comentario['id'] ?>">
                                    <input type="submit" name="acao" value="excluir" class="btn btn-sm btn-outline-danger mt-2">
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h3 class="text-center">Nenhum comentário encontrado para este artigo!</h3>
        <?php endif; ?>

        <?php if (isset($_SESSION['id'])): ?>
            <div class="comentar">
                <form method="post" class="d-flex border rounded-2 p-2 mb-2">
                    <div class="col">
                        <div class="mb-3">
                            <div class="text-start">
                                <label for="comentar" class="form-label">Faça um comentário sobre este artigo</label>
                                <input type="text" name="comentar" id="comentar" class="form-control" placeholder="Digite seu comentário" required />
                                <input type="submit" name="acao" value="comentar" class="btn btn-outline-success mt-2">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
function editarComentario(id) {
    var comentarioElement = document.getElementById('comentario-' + id);
    var comentarioTexto = comentarioElement.innerText;
    
    var form = document.createElement('form');
    form.method = 'post';
    form.innerHTML = `
        <input type="hidden" name="comentario_id" value="${id}">
        <input type="text" name="editar_comentario" value="${comentarioTexto}" class="form-control">
        <input type="submit" name="acao" value="editar" class="btn btn-sm btn-outline-primary mt-2">
    `;
    
    comentarioElement.parentNode.replaceChild(form, comentarioElement);
}
</script>
