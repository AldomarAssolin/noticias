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

    //var_dump($_SESSION['user']);
    $sql = MySql::connect()->prepare("SELECT id FROM `tb_admin.usuarios` WHERE user = ?");
    $sql->execute(array($_SESSION['user']));
    $value = $sql->fetch();

    if ($value) { // Verifica se um resultado foi encontrado
        //var_dump($_POST);
        //var_dump($value['id']);

        if (isset($_POST['acao'])) {
            $titulo = $_POST['titulo'];
            $subtitulo = $_POST['subtitulo'];
            $descricao = $_POST['descricao'];
            $categoria = $_POST['categoria'];
            $tipo = $_POST['tipo'];
            $conteudo = $_POST['conteudo'];
            $img = $_FILES['img'];
            $data_criacao = date('Y-m-d H:i:s');
            $usuario_id = $value['id'];

            $artigo = new Artigos();
            if ($img['name'] != '') {

                //Existe o upload de imagem.
                if (Painel::imagemValida($img)) {
                    $img = Painel::uploadFile($img);
                    if ($artigo->adicionarArtigo($titulo, $subtitulo, $descricao, $categoria, $tipo, $conteudo, $img, $usuario_id, $data_criacao)) {
                        //$value['img'] = $img;
                        Painel::alert('sucesso', 'Cadastro com sucesso junto com a imagem!');
                    } else {
                        var_dump($img);
                        Painel::alert('erro', 'Ocorreu um erro ao Cadastrar junto com a imagem');
                    }
                } else {
                    Painel::alert('erro', 'O formato da imagem não é válido');
                }
            } else {
                Painel::alert('erro', 'Alguma coisa deu errado');
            }
        }
    }



    ?>
    <form method="post" enctype="multipart/form-data" class="row g-3 border rounded-1 m-0 p-2">
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
                    echo '<option value="' . $key . '">' . $val . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-12">
            <label for="inputSelect" class="form-label">Tipo</label>
            <select class="form-select" name="tipo" aria-label="Default select example" id="inputSelect">
                <?php
                foreach (Painel::$tipos as $key => $val) {
                    echo '<option selected value="' . $key . '">' . $val . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-12">
            <label for="exampleFormControlTextarea1" class="form-label">Conteúdo</label>
            <textarea class="form-control" rows="6" name="conteudo" placeholder="Digite seu conteúdo"></textarea>
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" name="img">
        </div>
        <div class="col-12">
            <input type="submit" name="acao" class="btn btn-success" value="Cadastrar">
        </div>
    </form>
    </div>
    </div>
</section>