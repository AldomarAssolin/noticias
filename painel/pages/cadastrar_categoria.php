
<?php

if (isset($_POST['acao'])) {
    $nome = $_POST['nome'];
    $slug = Painel::generateSlug($nome);
    $arr = ['nome' => $nome, 'slug' => $slug, 'order_id' => '0', 'nome_tabela' => 'tb_site.categorias'];
    Categorias::insert($arr);
    Painel::alert('sucesso', 'Categoria cadastrada com sucesso!');
}


?>


<div class="">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 mb-0">Cadastrar Categorias</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                This week
            </button>
        </div>
    </div>
</div>

<div class="container mt-5 px-3 py-5 shadow">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group mb-2">
            <label for="nome">Nome da Categoria</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <input type="submit" name="acao" class="btn btn-success" value="Cadastrar">
    </form>
</div>