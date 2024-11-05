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
        <div class="form-group mb-2">
            <label for="imagem">Imagem</label>
            <div class=" border rounded-2">
                <input type="file" class="form-control-file" id="imagem" name="imagem" required>
            </div>
        </div>
        <div class="mt-1">
            <input type="submit" class="btn btn-primary" name="acao" value="Cadastrar">
        </div>
    </form>
</div>