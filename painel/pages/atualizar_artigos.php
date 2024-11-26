<?php
// Atualizar artigos

$id = $_GET['id'];

$value = Artigos::pegarArtigo($id);
$mensagem = '';

if ($value) { // Verifica se um resultado foi encontrado

    if (isset($_POST['atualizar_artigo']) && $_POST['atualizar_artigo'] == 'Atualizar') {
        $titulo = $_POST['titulo'];
        $subtitulo = $_POST['subtitulo'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $conteudo = $_POST['conteudo'];
        $imagem = $_FILES['imagem'];
        $imagem_atual = $_POST['imagem_atual'];
        $usuario_id = $value['usuario_id'];
        $data_atualizacao = date('Y-m-d H:i:s');

        if ($imagem['name'] != '') {
            if (Painel::imagemValida($imagem)) {
                Painel::deleteFile($imagem_atual);
                $imagem = Painel::uploadFile($imagem);
                if ($titulo == '' || $subtitulo == '' || $descricao == '' || $categoria == '' || $conteudo == '') {
                    $mensagem .= Painel::alert('erro', 'Campos vazios não são permitidos!');
                } else {
                    Artigos::editarArtigo($titulo, $subtitulo, $descricao, $categoria, $conteudo, $imagem, $usuario_id, $data_atualizacao, $id);
                    Painel::alert('sucesso', 'Artigo atualizado com sucesso!');
                    $value = Artigos::findByAutorId($id);
                }
            } else {
                $mensagem .= Painel::alert('erro', 'O formato da imagem não é válido!');
            }
        } else {
            if ($titulo == '' || $subtitulo == '' || $descricao == '' || $categoria == '' || $conteudo == '') {
                $mensagem .= Painel::alert('erro', 'Campos vazios não são permitidos!');
            } else {
                $imagem = $imagem_atual;
                Artigos::editarArtigo($titulo, $subtitulo, $descricao, $categoria, $conteudo, $imagem, $usuario_id, $data_atualizacao, $id);
                Painel::alert('sucesso', 'Artigo atualizado com sucesso!');
                $value = Artigos::findByAutorId($id);
            }
        }
    }
}
echo $mensagem;
?>

<section class="cadastrar-artigo ">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0">Atualizar Artigo</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand">
        <ul class="w-100 navbar-nav justify-content-end px-2">
            <li class="nav-item">
                <?php 
                if($_SESSION['cargo'] == 2){
                    echo '<a class="btn btn-sm btn-secondary mx-2" aria-current="page" href="lista_artigos">Todos artigos</a>';
                    echo '<a class="btn btn-sm btn-secondary" aria-current="page" href="lista_artigos_autor?id='.$_SESSION['id'].'">Meus artigos</a>';
                }elseif($_SESSION['id'] == $value['usuario_id']){
                    echo '<a class="btn btn-sm btn-secondary" aria-current="page" href="lista_artigos_autor?id='.$_SESSION['id'].'">Meus artigos</a>';
                }
                ?>
            </li>
        </ul>
    </nav>
    <form method="post" enctype="multipart/form-data" class="row g-3 border rounded-1 m-0 p-2">
        <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Título</label>
            <input type="text" class="form-control" name="titulo" placeholder="Digite o título do artigo" value="<?php echo $value['titulo'] ?>">
        </div>
        <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Subtítulo</label>
            <input type="text" class="form-control" name="subtitulo" placeholder="Digite o subtítulo do artigo" value="<?php echo $value['subtitulo'] ?>">
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Descrição</label>
            <input type="text" class="form-control" name="descricao" placeholder="Digite a descrição do artigo" value="<?php echo $value['descricao'] ?>">
        </div>
        <div class="col-12">
            <label for="inputSelect" class="form-label">Categoria</label>
            <select class="form-select" name="categoria" aria-label="Default select example" id="inputSelect">


                <?php
                echo '<option selected value="' . $categoria . '">' . $categoria . '</option>';
                foreach (Painel::$categorias as $key => $val) {
                    echo '<option value="' . $key . '">' . $val . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-12">
            <label for="exampleFormControlTextarea1" class="form-label">Conteúdo</label>
            <textarea id="editor" class="form-control" rows="6" name="conteudo" placeholder="Digite seu conteúdo">
                <?php echo $value['conteudo'] ?>
            </textarea>
        </div>
        <div class="form-group mb-2">
            <div class="form-group mb-3">
                <label class="form-label w-25 file btn btn-outline-success" for="imagem">Imagem</label><br>
                <input type="file" class="btn btn-primary btn-sm" id="imagem" name="imagem" accept="image/*">
                <input type="hidden" id="imagem_atual" name="imagem_atual" value="<?php echo $value['img'] ?>">
            </div>
            <?php if (!empty($value['img'])): ?>
                <div class="mb-3">
                    <img src="<?php echo $value['img'] ?>" alt="Imagem atual" class="img-thumbnail" style="max-width: 200px;">
                </div>
            <?php endif; ?>
        </div>
        <div class="col-12">
            <input type="submit" name="atualizar_artigo" class="btn btn-success" value="Atualizar">
        </div>
    </form>
    </div>
    </div>
</section>