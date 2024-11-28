<?php
// Atualizar artigos

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$artigo = Artigos::pegarArtigo($id);

if (!$artigo) {
    Painel::alert('erro', 'Artigo não encontrado.');
    exit;
}

$usuario_id = $artigo['usuario_id'];
$mensagem = '';

if (isset($_POST['atualizar_artigo']) && $_POST['atualizar_artigo'] == 'Atualizar') {
    $dados = [
        'titulo' => filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS),
        'subtitulo' => filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_SPECIAL_CHARS),
        'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS),
        'categoria' => filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS),
        'conteudo' => $_POST['conteudo'], // Não sanitize o conteúdo do editor
        'imagem' => $_FILES['imagem'],
        'imagem_atual' => filter_input(INPUT_POST, 'imagem_atual', FILTER_SANITIZE_URL),
        'usuario_id' => $usuario_id,
        'data_atualizacao' => date('Y-m-d H:i:s')
    ];

    if (empty($dados['titulo']) || empty($dados['subtitulo']) || empty($dados['descricao']) || empty($dados['categoria']) || empty($dados['conteudo'])) {
        $mensagem = Painel::alert('erro', 'Campos vazios não são permitidos!');
    } else {
        if (!empty($dados['imagem']['name'])) {
            if (Painel::imagemValida($dados['imagem'])) {
                Painel::deleteFile($dados['imagem_atual']);
                $dados['imagem'] = Painel::uploadFile($dados['imagem']);
            } else {
                $mensagem = Painel::alert('erro', 'O formato da imagem não é válido!');
                $dados['imagem'] = $dados['imagem_atual'];
            }
        } else {
            $dados['imagem'] = $dados['imagem_atual'];
        }

        if (empty($mensagem)) {
            if (Artigos::editarArtigo($dados, $id)) {
                $mensagem = Painel::alert('sucesso', 'Artigo atualizado com sucesso!');
                $artigo = Artigos::pegarArtigo($id);
            } else {
                $mensagem = Painel::alert('erro', 'Erro ao atualizar o artigo.');
            }
        }
    }
}

echo $mensagem;
?>

<section class="cadastrar-artigo">
    <div class="container">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0">Atualizar Artigo</h1>
        </div>

        <nav class="navbar navbar-expand">
            <ul class="w-100 navbar-nav justify-content-end px-2">
                <li class="nav-item">
                    <?php if ($_SESSION['cargo'] == 2): ?>
                        <a class="btn btn-sm btn-secondary mx-2" href="lista_artigos">Todos artigos</a>
                        <a class="btn btn-sm btn-secondary" href="lista_artigos_autor?id=<?php echo $_SESSION['id']; ?>">Meus artigos</a>
                    <?php elseif ($_SESSION['id'] == $artigo['usuario_id']): ?>
                        <a class="btn btn-sm btn-secondary" href="lista_artigos_autor?id=<?php echo $_SESSION['id']; ?>">Meus artigos</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>

        <form method="post" enctype="multipart/form-data" class="row g-3 border rounded-1 m-0 p-2">
            <div class="col-md-12">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título do artigo" value="<?php echo htmlspecialchars($artigo['titulo']); ?>">
            </div>
            <div class="col-md-12">
                <label for="subtitulo" class="form-label">Subtítulo</label>
                <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Digite o subtítulo do artigo" value="<?php echo htmlspecialchars($artigo['subtitulo']); ?>">
            </div>
            <div class="col-12">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição do artigo" value="<?php echo htmlspecialchars($artigo['descricao']); ?>">
            </div>
            <div class="col-12">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-select" id="categoria" name="categoria">
                    <?php
                    $categorias = Categorias::listarCategorias();
                    foreach ($categorias as $cat) {
                        $selected = ($cat['nome'] == $artigo['categoria']) ? 'selected' : '';
                        echo "<option value=\"" . htmlspecialchars($cat['nome']) . "\" $selected>" . htmlspecialchars($cat['nome']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-12">
                <label for="editor" class="form-label">Conteúdo</label>
                <textarea id="editor" class="form-control" rows="6" name="conteudo" placeholder="Digite seu conteúdo"><?php echo htmlspecialchars($artigo['conteudo']); ?></textarea>
            </div>
            <div class="form-group mb-2">
                <div class="form-group mb-3">
                    <label class="form-label w-25 file btn btn-outline-success" for="imagem">Imagem</label><br>
                    <input type="file" class="btn btn-primary btn-sm" id="imagem" name="imagem" accept="image/*">
                    <input type="hidden" id="imagem_atual" name="imagem_atual" value="<?php echo htmlspecialchars($artigo['img']); ?>">
                </div>
                <?php if (!empty($artigo['img'])): ?>
                    <div class="mb-3">
                        <img src="<?php echo htmlspecialchars($artigo['img']); ?>" alt="Imagem atual" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12">
                <input type="submit" name="atualizar_artigo" class="btn btn-success" value="Atualizar">
            </div>
        </form>
    </div>
</section>