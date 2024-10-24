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

    $value = Artigos::pegarArtigo($_GET['id']);
    $categoria = Painel::$categorias[$value['categoria']]; // Pega a categoria do artigo
    $tipo = $value['tipo']; // Pega a tipo do artigo
    if ($value) { // Verifica se um resultado foi encontrado

        if (isset($_POST['acao'])) {
            $titulo = $_POST['titulo'];
            $subtitulo = $_POST['subtitulo'];
            $descricao = $_POST['descricao'];
            $categoria = $_POST['categoria'];
            $tipo = $_POST['tipo'];
            $conteudo = $_POST['conteudo'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $data_atualizacao = date('Y-m-d H:i:s');


            $artigo = new Artigos();
            if ($imagem['name'] != '') {

                //Existe o upload de imagem.
            if (Painel::imagemValida($imagem)) {
                Painel::deleteFile($imagem_atual);
                $imagem = Painel::uploadFile($imagem);
                $img = $imagem;
                if ($artigo->editarArtigo($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $data_atualizacao, $_GET['id'])) {
                    $value['img'] = $imagem;
                    Painel::alert('sucesso', 'Atualizado com sucesso junto com a imagem!');
                } else {
                    Painel::alert('erro', 'Ocorreu um erro ao atualizar junto com a imagem');
                }
            } else {
                Painel::alert('erro', 'O formato da imagem não é válido');
            }
            } else {
                Painel::alert('erro', 'Erro ao atualizar...');
            }
        }
    }



    ?>
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
                <option value="<?php echo $value['categoria'] ?>" selected></option>

                <?php
                echo '<option selected value="' . $categoria . '">' . $categoria . '</option>';
                foreach (Painel::$categorias as $key => $val) {
                    echo '<option value="' . $key . '">' . $val . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-12">
            <label for="inputSelect" class="form-label">Tipo</label>
            <select class="form-select" name="tipo" aria-label="Default select example" id="inputSelect">
                <?php
                echo '<option selected value="' . $tipo . '">' . $tipo . '</option>';
                foreach (Painel::$tipos as $key => $val) {
                    echo '<option value="' . $key . '">' . $val . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-12">
            <label for="exampleFormControlTextarea1" class="form-label">Conteúdo</label>
            <textarea class="form-control" rows="6" name="conteudo" placeholder="Digite seu conteúdo">
                <?php echo $value['conteudo'] ?>
            </textarea>
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $value['img'] != '' ? $value['img'] : $avatar ?>">
        </div>
        <div class="col-12">
            <input type="submit" name="acao" class="btn btn-success" value="Atualizar">
        </div>
    </form>
    </div>
    </div>
</section>