<div class="">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 mb-0">Editar Categoria</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                This week
            </button>
        </div>
    </div>
</div>

<?php

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $categoria = Categorias::selectCategoria($id);
}else{
    Painel::alert('erro','Você precisa passar o parametro ID.');
    die();
}

if(isset($_POST['acao'])){
    $nome = $_POST['nome'];
    $slug = Painel::generateSlug($nome);
    $arr = ['nome'=>$nome,'slug'=>$slug,'id'=>$id];
    Categorias::update($arr);
    Painel::alert('sucesso','Categoria editada com sucesso!');
    $categoria = Categorias::selectCategoria($id);
}

?>

<div class="container mt-5 px-3 py-5 shadow">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group mb-2">
            <label for="nome">Nome da Categoria</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $categoria['nome'] ?>" required>
        </div>
        <input type="submit" name="acao" class="btn btn-success" value="Editar">
        <a href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar_categorias" class="btn btn-primary">Voltar</a>
        <a href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar_categoria" class="btn btn-success">Cadastrar</a>
    </form>
</div>