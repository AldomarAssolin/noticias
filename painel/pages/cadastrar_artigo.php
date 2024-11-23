<section class="cadastrar-artigo ">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0">Cadastrar Artigo</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>

    <?php

    $id = $_SESSION['id'];
    $mensagem = '';

    if (isset($_POST['acao'])) {
        $titulo = $_POST['titulo'];
        $subtitulo = $_POST['subtitulo'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $conteudo = $_POST['conteudo'];
        $img = $_FILES['img'];
        $data_criacao = date('Y-m-d H:i:s');
        $usuario_id = $id;

        if ($titulo == '' || $subtitulo == '' || $descricao == '' || $conteudo == '') {
            $mensagem .= Painel::alert('erro', 'Campos vazios não são permitidos!');
        }

        if ($img['name'] != '') {

            //Existe o upload de imagem.
            if (Painel::imagemValida($img)) {
                $img = Painel::uploadFile($img);
                $artigo = new Artigos();
                if ($artigo->adicionarArtigo($titulo, $subtitulo, $descricao, $categoria, $conteudo, $img, $usuario_id, $data_criacao, null, 1)) {
                    $mensagem .= Painel::alert('sucesso', 'Cadastro com sucesso junto com a imagem!');
                } else {
                    $mensagem .= Painel::alert('sucesso', 'Cadastro efetuado com sucesso!');
                }
            } else {
                $mensagem .= Painel::alert('erro', 'O formato da imagem não é válido');
            }
        } else {
            $mensagem .= Painel::alert('erro', 'Por favor, insira uma imagem!');
        }
    }

    ?>
    <div class="container">
        <div class="alert">
            <?php echo $mensagem; ?>
        </div>
        <form method="post" enctype="multipart/form-data" class="row g-3 mt-2 mt-md-5 px-3 py-5 shadow">
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" placeholder="Digite o título do artigo">
            </div>
            <div class="col-md-12">
                <label for="inputPassword4" class="form-label">Subtítulo</label>
                <input type="text" class="form-control" name="subtitulo" placeholder="Digite o subtítulo do artigo">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Descrição</label>
                <input type="text" class="form-control" name="descricao" placeholder="Digite a descrição do artigo">
            </div>
            <div class="col-12">
                <label for="inputSelect" class="form-label">Categoria</label>
                <select class="form-select" name="categoria" aria-label="Default select example" id="inputSelect">
                    <?php
                    foreach (Painel::$categorias as $key => $val) {
                        echo '<option selected value="' . $key . '">' . $val . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-12">
                <label for="exampleFormControlTextarea1" class="form-label">Conteúdo</label>
                <textarea id="editor" class="form-control" rows="6" name="conteudo" placeholder="Digite seu conteúdo"></textarea>
            </div>
            <div class="form-group mb-2">
                <div class="form-group mb-3">
                    <label class="form-label w-25 file btn btn-outline-success" for="img">Imagem</label><br>
                    <input type="file" class="btn btn-primary btn-sm" id="img" name="img" accept="image/*">
                </div>
            </div>
            <div class="col-12">
                <input type="submit" name="acao" class="btn btn-success" value="Cadastrar">
            </div>
        </form>
    </div>
    </div>
</section>