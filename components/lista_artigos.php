<?php

// Captura a busca do formulário
$busca = $_POST['buscar'] ?? '';

// Inicializa a variável para os artigos
$artigo = [];

// Lógica para buscar ou listar artigos
if (!empty($busca)) {
    $artigo = Artigos::buscarArtigos($busca);
    if (empty($artigo)) {
        echo Painel::alert('erro', 'Nenhum artigo encontrado com para a busca');
        $artigo = Artigos::listarArtigosComAutores();
    }
} else {
    // Verifica se há uma categoria específica na URL
    $url = $_GET['url'] ?? null;
    if ($url) {
        $artigo = Artigos::listarArtigosPorCategoria($url);
        if (empty($artigo)) {
            echo Painel::alert('erro', 'Nenhum artigo encontrado para esta categoria');;
            $artigo = Artigos::listarArtigosComAutores();
        }
    } else {
        $artigo = Artigos::listarArtigosComAutores();
    }
}

// Padrão de imagem
$capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
$avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';

?>

<!-- Navbar de categorias -->
<div id="nabar-category" class="nav-scroller p-3 shadow mt-3">
    <nav class="nav nav-underline">
        <a class="nav-item nav-link link-body-emphasis active" href="<?php echo INCLUDE_PATH ?>">Todos</a>
        <?php
        $categorias_artigo = Categorias::listarCategorias();
        foreach ($categorias_artigo as $categoria) {
            echo '<a id="nabar-category-item" class="nav-item nav-link link-body-emphasis text-capitalize" href="?url=' . htmlspecialchars($categoria['slug']) . '">' . htmlspecialchars($categoria['nome']) . '</a>';
        }
        ?>
    </nav>
</div>
<!-- Navbar de categorias -->

<div><!-- p-4 -->
    <!-- Lista de artigos -->
    <ul class="list-unstyled px-2">
        <?php foreach ($artigo as $value): ?>
            <?php if ($value['status'] == 1): ?>
                <li class="p-2 border-bottom">
                    <a class="py-3 mb-2 link-body-emphasis text-decoration-none" href="<?php echo INCLUDE_PATH ?>artigos?id=<?php echo urlencode($value['artigo_id'] ?? $value['id']) ?>">
                        <div class="card mb-2 border-0 d-flex flex-column flex-lg-row align-items-center">
                            <div class="col-lg-3 px-2 mb-2 mb-md-0">
                                <img src="<?php echo htmlspecialchars($value['capa'] ?? ($value['imagem_artigo'] ?? $capa)) ?>" alt="imagem descritiva" width="200" height="200">
                            </div>
                            <div class="col-lg-9">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6 class="mb-0"><?php echo htmlspecialchars($value['titulo']) ?></h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <span class="badge rounded-pill mb-2 text-bg-primary"><?php echo htmlspecialchars($value['categoria'] ?? 'mundo') ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-body-secondary mt-2"><?php echo htmlspecialchars($value['descricao']) ?></p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-end">
                                            <img src="<?php echo htmlspecialchars($value['avatar'] ?? $avatar) ?>" alt="imagem descritiva" class="rounded-circle border border-secondary-2 mx-2" width="32" height="32">
                                            <span class="fs-6 fst-italic"><?php echo htmlspecialchars($value['nome_completo'] ?? '') ?></span>
                                        </div>
                                        <div class="col-6 text-end">
                                            <small class="text-body-secondary"><?php echo date('M y', strtotime($value['data_criacao'])); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div><!--col-lg-9-->
                        </div><!--card-->
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <!-- Lista de artigos -->
</div><!-- p-4 -->