<section class="cadastrar-usuario">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0">Cadastrar Usuário</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['acao'])) {
        $user = $_POST['user'];
        $senha = $_POST['senha'];
        $nome = $_POST['nome'];
        $cargo = $_POST['cargo'];
        $img = $_FILES['img'];

        $usuario = new Usuario();
        if ($img['name'] != '') {

            //Existe o upload de imagem.
            if (Painel::imagemValida($img)) {
                $imagem = Painel::uploadFile($img);
                if ($usuario->cadastrarUsuario($user, $nome, $senha, $cargo, $imagem)) {
                } else {
                    Painel::alert('sucesso', 'Atualizado com sucesso junto com a imagem!');
                }
            } else {
                Painel::alert('erro', 'O formato da imagem não é válido');
            }
        } else {
            //$imagem = $imagem_atual;
            if ($usuario->cadastrarUsuario($user, $nome, $senha, $cargo, $imagem)) {
                Painel::alert('sucesso', 'Atualizado com sucesso!');
            } else {
                Painel::alert('erro', 'Ocorreu um erro ao atualizar...');
            }
        }

        // if ($user == '' || $senha == '' || $nome == '' || $cargo == '' || $img == '') {
        //     Painel::alert('erro', 'Campos vazios não são permitidos!');
        // } else {
        //     $sql = MySql::connect()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?)");
        //     $sql->execute(array($user, $nome, $senha, $cargo, $img));
        //     Painel::alert('sucesso', 'Usuário cadastrado com sucesso!');
        // }
    }

    ?>
    <div class="container">
        <form method="post" enctype="multipart/form-data" class="row g-3 mt-2 mt-md-5  px-3 py-5 shadow">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="inputEmail4" name="user">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Senha</label>
                <input type="password" class="form-control" id="inputPassword4" name="senha">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Nome</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Digite seu nome" name="nome">
            </div>
            <div class="col-12">
                <label for="inputSelect" class="form-label">Cargo</label>
                <select class="form-select" aria-label="Default select example" id="inputSelect" name="cargo">
                    <?php

                    foreach (Painel::$cargos as $key => $val) {
                        if ($key <= $_SESSION['cargo']) echo '<option value="' . $key . '">' . $val . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Imagem</label>
                <input type="file" class="form-control" name="img">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success" name="acao">Cadastrar</button>
            </div>
        </form>
    </div>

</section>