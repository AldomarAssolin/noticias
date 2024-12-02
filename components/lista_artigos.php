<?php
// Configuração da paginação
$itens_por_pagina = 5;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// Captura a busca do formulário
$busca = $_POST['buscar'] ?? '';

// Inicializa as variáveis para os artigos e total
$artigo = [];
$total_artigos = 0;

// Lógica para buscar ou listar artigos com paginação
if (!empty($busca)) {
    $total_artigos = Artigos::listarArtigosBusca($busca);
    $artigo = Artigos::buscarArtigosPaginados($busca, $offset, $itens_por_pagina);
    if (empty($artigo)) {
        echo Painel::alert('erro', 'Nenhum artigo encontrado para a busca');
        $total_artigos = Artigos::contarTotalArtigos();
        $artigo = Artigos::listarArtigosComAutoresPaginados($offset, $itens_por_pagina);
    }
} else {
    $url = $_GET['categoria'] ?? null;
    if ($url) {
        $total_artigos = Artigos::contarArtigosCategoria($url);
        $artigo = Artigos::listarArtigosPorCategoriaPaginados($url, $offset, $itens_por_pagina);
        if (empty($artigo)) {
            echo Painel::alert('erro', 'Nenhum artigo encontrado para esta categoria');
            $total_artigos = Artigos::contarTotalArtigos();
            $artigo = Artigos::listarArtigosComAutoresPaginados($offset, $itens_por_pagina);
        }
    } else {
        $total_artigos = Artigos::contarTotalArtigos();
        $artigo = Artigos::listarArtigosComAutoresPaginados($offset, $itens_por_pagina);
    }
}

$total_paginas = ceil($total_artigos / $itens_por_pagina);

// Padrão de imagem
$capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
$avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';

?>

<!-- Navbar de categorias -->
<section id="nabar-category" class="nav-scroller py-3 shadow mt-3">
    <nav class="nav nav-underline px-2">
        <a class="nav-item nav-link link-body-emphasis active" href="<?php echo INCLUDE_PATH ?>">Todos</a>
        <?php
        $categorias_artigo = Categorias::listarCategorias();
        foreach ($categorias_artigo as $categoria) {
            echo '<a id="nabar-category-item" class="nav-item nav-link link-body-emphasis text-capitalize" href="?categoria=' . htmlspecialchars($categoria['slug']) . '">' . htmlspecialchars($categoria['nome']) . '</a>';
        }
        ?>
    </nav>
</section>
<!-- Navbar de categorias -->


<!-- Lista de artigos -->
<article class="p-4">
    <ul class="list-unstyled mt-3">
        <?php foreach ($artigo as $value): ?>
            <?php if ($value['status'] == 1):

            $countComentaries = Comentarios::countComentarios($value['id']);
            if ($countComentaries == null) {
                $countComentaries = 0;
            } else {
                $countComentaries = $countComentaries['total'];
            }

            ?>
                <li>
                    <div class="position-relative text-center text-muted rounded-top-4 border border-dark shadow mb-3">
                        <a href="<?php echo INCLUDE_PATH ?>artigos?id=<?php echo urlencode($value['artigo_id'] ?? $value['id']) ?>" class="text-decoration-none text-muted">
                            <div class="">
                                <img src="<?php echo htmlspecialchars($value['capa'] ?? ($value['img'] ?? $capa)) ?>" class="rounded-top-4" alt="imagem descritiva" style="width:100%; height:350px">
                                <div class="pt-3 px-2 pb-1 text-start border-bottom">
                                    <div class="row">
                                        <div class="col-12 col-md-8">
                                            <img src="<?php echo htmlspecialchars($value['avatar'] ?? $avatar) ?>" alt="imagem descritiva" class="rounded-circle border border-secondary-2 mx-2" width="24" height="24">
                                            <span class="fs-6 fst-italic"><?php echo htmlspecialchars(ucfirst($value['nome_completo']) ?? '') ?> - </span>
                                            <small class="text-body-secondary"><?php echo date('F j, Y', strtotime($value['data_criacao'])); ?></small>
                                        </div>
                                        <div class="col-12 col-md-4 text-md-end mt-md-1"><span class="badge text-bg-info"><?php echo htmlspecialchars(ucfirst($value['categoria']) ?? '') ?></span></div>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h1 class="text-body-emphasis mt-2"><?php echo htmlspecialchars($value['titulo']) ?></h1>
                                    <p class="col-lg-6 mx-auto mb-4">
                                        <?php echo htmlspecialchars($value['descricao']) ?>
                                    </p>
                                </div>
                                <div class="text-end p-3 shadow bg-gradient">
                                    <small class="text-body-secondary"><?php echo $countComentaries ?>
                                        <i class="bi bi-chat-left-dots-fill"></i>
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</article>
<!-- Lista de artigos -->

<!-- Paginação -->
<nav aria-label="Navegação de páginas" class="my-4">
    <ul class="pagination justify-content-center">
        <?php if ($pagina_atual > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?pagina=<?php echo ($pagina_atual - 1) . ($url ? '&url=' . $url : ''); ?>" aria-label="Anterior">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <li class="page-item <?php echo $i == $pagina_atual ? 'active' : ''; ?>">
                <a class="page-link" href="?pagina=<?php echo $i . ($url ? '&url=' . $url : ''); ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <?php if ($pagina_atual < $total_paginas): ?>
            <li class="page-item">
                <a class="page-link" href="?pagina=<?php echo ($pagina_atual + 1) . ($url ? '&url=' . $url : ''); ?>" aria-label="Próximo">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>