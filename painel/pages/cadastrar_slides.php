<?php


if (isset($_POST['acao'])) {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $link = $_POST['link'];
    $imagem = $_FILES['imagem'];

    $slide = new Slides();
    try {
        $slide->cadastrarSlide($titulo, $descricao, $link, $imagem);
    } catch (Exception $e) {
        Painel::alert('erro', 'Ocorreu um erro ao cadastrar o slide!');
    }
}







?>

<div class="">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 mb-0">Cadastrar Slides</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                This week
            </button>
        </div>
    </div>
</div>

<div class="container mt-5 px-3 py-5 shadow">
    <nav class="navbar">
        <form class="container-fluid justify-content-end">
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>" class="btn btn-sm btn-outline-secondary mx-2" type="button">Voltar</a>
            <a href="<?php echo INCLUDE_PATH_PAINEL ?>lista_slides" class="btn btn-sm btn-outline-info" type="button">Ver todos</a>
        </form>
    </nav>
    <form method="post" enctype="multipart/form-data" class=" mt-2 mt-md-5">
        <div class="form-group mb-2">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group mb-2">
            <label for="descricao">Descrição</label>
            <textarea type="text" rows="4" class="form-control" id="descricao" name="descricao" required></textarea>
        </div>
        <div class="form-group mb-2">
            <label for="link">Link</label>
            <input type="text" class="form-control" id="link" name="link" required>
        </div>
        <div class="form-group mb-3">
            <label class="form-label file btn btn-outline-success" for="imagem">Escolha uma imagem:</label><br>
            <input type="file" class="btn btn-primary btn-sm" id="imagem" name="imagem">
        </div>
        <?php if (!empty($redes['imagem'])): ?>
            <div class="mb-3">
                <img src="" alt="Imagem atual" class="img-thumbnail" style="max-width: 200px;">
            </div>
        <?php endif; ?>
        <div class="mt-1">
            <input type="submit" class="btn btn-primary" name="acao" value="Cadastrar">
        </div>
    </form>
</div>