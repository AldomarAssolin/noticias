<section class="cadastrar-usuario">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0">Atualizar Usuário</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>

    <?php

    $avatar = URL_STATIC . 'uploads/avatar.jpg';

    $sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute(array($_GET['id']));
    $value = $sql->fetch();


    if (isset($_POST['acao'])) {
        $id = $_GET['id'];
        $user = $_POST['user'];
        $nome = $_POST['nome'];
        $cargo = $_POST['cargo'];
        $imagem = $_FILES['imagem'];
        $imagem_atual = $_POST['imagem_atual'];
        
        $usuario = new Usuario();
        if ($imagem['name'] != '') {

            //Existe o upload de imagem.
            if (Painel::imagemValida($imagem)) {
                Painel::deleteFile($imagem_atual);
                $imagem = Painel::uploadFile($imagem);
                if ($usuario->atualizarUsuarioOutro($user, $nome, $cargo, $imagem, $id)) {
                    $value['img'] = $imagem;
                    Painel::alert('sucesso', 'Atualizado com sucesso junto com a imagem!');
                } else {
                    Painel::alert('erro', 'Ocorreu um erro ao atualizar junto com a imagem');
                }
            } else {
                Painel::alert('erro', 'O formato da imagem não é válido');
            }
        } else {
            $imagem = $imagem_atual;
            if ($usuario->atualizarUsuarioOutro($user, $nome, $cargo, $imagem, $id)) {
                Painel::alert('sucesso', 'Atualizado com sucesso!');
            } else {
                Painel::alert('erro', 'Ocorreu um erro ao atualizar...');
            }
        }
    }

    ?>

    <form method="post" enctype="multipart/form-data" class="row g-3 border rounded-1 m-0 p-2">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Login</label>
            <input type="text" class="form-control" id="inputEmail4" name="user" value="<?php echo $value['user'] ?>">
        </div>
        <!-- <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Senha</label>
            <input type="password" class="form-control" id="inputPassword4" name="senha">
        </div> -->
        <div class="col-12">
            <label for="inputAddress" class="form-label">Nome</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Digite seu nome" name="nome" value="<?php echo $value['nome'] ?>">
        </div>
        <div class="col-12">
            <label for="inputSelect" class="form-label">Cargo</label>
            <select class="form-select" aria-label="Default select example" id="inputSelect" name="cargo">
                <?php
                foreach (Painel::$cargos as $key => $val) {
                    if ($key <= $value['cargo']) echo '<option selected value="' . $key . '">' . $val . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-12">
            <?php

            ?>
            <label for="inputAddress" class="form-label">Imagem</label>
            <input type="file" class="form-control" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $value['img'] != '' ? $value['img'] : $avatar ?>">
        </div>
        <div class="col-12">
            <input type="submit" class="btn btn-success" name="acao" value="Atualizar">
        </div>
    </form>
    </div>
    </div>
</section>