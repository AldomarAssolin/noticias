<?php

$imagem = INCLUDE_PATH . 'static/uploads/avatar.jpg';
$capa_ficticia = INCLUDE_PATH . 'static/uploads/capa.jpeg';

$email = $_SESSION['user'];
$id = $_SESSION['id'];

$perfil = Perfil::listarPerfilUsuario($id);

$nome = $perfil['nome'] ?? $email;
$sobrenome = $perfil['sobrenome'] ?? 'Sobrenome';
$bio = $perfil['bio'] ?? 'Resuma aqui sua biografia.';
$img = $perfil['avatar'] ?? $imagem;
$cidade = $perfil['cidade'] ?? 'Cidade';
$data_nasc = $perfil['data_nasc'] ?? '10/10/2000';
$uf = $perfil['uf'] ?? 'UF';
$avatar = $perfil['avatar'] ?? $imagem;
$capa = $perfil['capa'] ?? $capa_ficticia;


if (isset($_GET['usuario_edit'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = trim($_POST['nome']);
        $sobrenome = trim($_POST['sobrenome']);
        $data_nasc = $_POST['data_nasc'];
        $bio = $_POST['bio'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $usuario_id = $_SESSION['id'];
        $imagen_atual = $_POST['imagem_atual'];
        $capa_atual = $_POST['capa_atual'];

        //var_dump($_POST);
        //var_dump($_FILES);

        //Verifica o erro do arquivo antes de acessar
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
            $avatar = $_FILES['avatar'];
        } else {
            echo Painel::alert('Erro', 'Erro no upload da nova imagem ou arquivo não enviado.');
        }

        if (isset($_FILES['capa']) && $_FILES['capa']['error'] == UPLOAD_ERR_OK) {
            $capa = $_FILES['capa'];
        } else {
            echo Painel::alert('Erro', 'Erro no upload da capa ou arquivo não enviado.');
        }

        if($avatar['name'] != '' || $avatar['name'] != null){
            Painel::deleteFile($imagen_atual);
            $avatar = Painel::uploadFile($avatar);
            echo Painel::alert('sucesso', 'Imagem de perfil atualizada com sucesso!');
        }else{
            $avatar = $imagen_atual;
            echo Painel::alert('sucesso', 'Imagem de perfil mantida!');
        }

        if($capa['name'] != ''){
            $capa_atual = Painel::deleteFile($capa_atual);
            $capa = Painel::uploadFile($capa);
        }else{
            $capa = $capa_atual;
        }

        if ($nome == '' || $sobrenome == '' || $data_nasc == '' || $bio == '') {
            echo Painel::alert('erro', 'Preencha todos os campos!');
        }

        if (strlen($nome) < 3 || strlen($sobrenome) < 3) {
            echo Painel::alert('erro', 'Nome e sobrenome devem ter no mínimo 3 caracteres!');
            return;
        }

        if (str_contains($nome, ' ') || str_contains($sobrenome, ' ')) {
            echo Painel::alert('erro', 'Nome e sobrenome não podem conter espaços!');
            return;
        }


        //var_dump($nome, $sobrenome, $data_nasc, $bio, $avatar, $capa, $cidade, $uf, $usuario_id);

        $perfil = new Perfil();
        $perfil->atualizarPerfil($nome, $sobrenome, $data_nasc, $bio, $avatar, $capa, $cidade, $uf, $id);
        echo Painel::alert('sucesso', 'Perfil atualizado com sucesso!');
    }
}

?>

<form method="post" enctype="multipart/form-data">
    <div class="card">
        <div class="card-header">
            <img src="<?php echo $img ?>" class="card-img-top" alt="User Image">
            <div class="d-flex align-items-center my-2" title="editar imagem de perfil">
                <input id="avatar" type="file" name="avatar">
                <input type="hidden" name="imagem_atual" value="<?php echo $avatar ?? $imagem ?>">
            </div><!--avatar-->
        </div>
        <div class="card-body">
            <label for="nome" class="form-label">Nome:</label>
            <h5 class="card-title"><input type="text" id="nome" class="form-control" name="nome" value="<?php echo $nome ?>"></h5>
            <label for="sobrenome" class="form-label">Sobrenome:</label>
            <h5 class="card-title"><input type="text" class="form-control" name="sobrenome" value="<?php echo $sobrenome ?>"></h5>
            <label for="data_nasc" class="form-label">Data Nascimento:</label>
            <h5 class="card-title"><input type="date" class="form-control" name="data_nasc" value="<?php echo $data_nasc ?? '10/10/2000' ?>"></h5>
            <label for="bio" class="form-label">Bio:</label>
            <p class="card-text"><textarea type="text" rows="5" class="form-control" name="bio" placeholder="<?php echo $bio ?>"></textarea></p>
            <div class="card-header"><!-- Imagem de Capa do Usuario -->
                <img src="<?php echo $capa ?? $imagem ?>" class="card-img-top" alt="User Image">
                <div class="d-flex align-items-center my-2" title="editar imagem de perfil">
                    <input id="capa" type="file" name="capa" value="<?php echo $capa ?? $imagem ?>">
                    <input type="hidden" name="capa_atual" value="<?php echo $_SESSION['capa'] ?? $imagem ?>">
                </div><!--nova_imagem-->
            </div>
            <label for="cidade" class="form-label">Cidade:</label>
            <h5 class="card-title"><input type="text" class="form-control" name="cidade" value="<?php echo $cidade ?>"></h5>
            <label for="uf" class="form-label">UF:</label>
            <h5 class="card-title"><input type="text" class="form-control" name="uf" value="<?php echo $uf ?>"></h5>
        </div><!--card-body-->
        <div class="card-footer">
            <?php
            if ($_SESSION) {
            ?>
                <input type="submit" class="btn btn-success" name="acao" value="Salvar">
                <a href="<?php echo INCLUDE_PATH ?>perfil?usuario=<?php echo $_SESSION['user'] ?>" class="btn btn-secondary">Cancelar</a>
            <?php
            }
            ?>
        </div><!--card-footer-->
    </div><!--card-->
</form>