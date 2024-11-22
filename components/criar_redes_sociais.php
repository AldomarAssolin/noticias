<?php
// Objetivo: Editar redes sociais do usuario

$id = $_SESSION['id'];

$mensagem = '';

if (isset($_POST['criar_rede'])) {
    
    $nome = trim($_POST['nome']);
    $link = trim($_POST['link']);
    $cor = $_POST['cor'];
    $nova_imagem = $_FILES['nova_imagem'];

    if ($nome == '' || $link == '' || $cor == '') {
        $mensagem .= Painel::alert('erro', 'Preencha todos os campos!');
    }

    if ($nova_imagem['name'] != '') {
        if(Painel::imagemValida($nova_imagem)){
            $nova_imagem = Painel::uploadFile($nova_imagem);
        }else{
            echo Painel::alert('erro', 'O formato da imagem não é válido');
        }
    } else {
        $nova_imagem = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';
    }

    $redes = new Perfil();
    $redes->createRedeSocial($nome, $link, $nova_imagem, $cor, $id);
    echo Painel::alert('sucesso', 'Rede social cadastrada com sucesso!');
}

?>

<div class="shadow p-2 mb-5">
    <div class="card-header mb-2">
        <h5 class="card-title text-">Crie um novo link de rede social</h5>
    </div>
    <form method="post" enctype="multipart/form-data">
        <div id="validationServerUsernameFeedback" class="invalid-feedback">
            <?php echo $mensagem ?>
        </div>
        <div class="mb-3 form-control form-control-lg">
            <div class="form-group mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input required type="text" class="form-control" id="nome" name="nome" aria-describedby="nome" placeholder='Digite o nome da rede'>
            </div>
            <div class="form-group mb-3">
                <label for="link" class="form-label">Link:</label>
                <input required type="text" class="form-control" id="link" name="link" placeholder='Digite o link da rede'>
            </div>
            <div class="form-group mb-3">
                <label for="link" class="form-label">Escolha uma cor:</label>
                <select required class="form-select" name="cor" aria-label="Default select example">
                    <option selected>Escolha uma cor</option>
                    <option value="primary">primary</option>
                    <option value="secondary">secondary</option>
                    <option value="success">success</option>
                    <option value="danger">danger</option>
                    <option value="warning">warning</option>
                    <option value="info">info</option>
                    <option value="light">light</option>
                    <option value="dark">dark</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="nova_imagem">Escolha uma imagem:</label><br>
                <input type="file" class="btn btn-primary btn-sm" id="nova_imagem" name="nova_imagem">
            </div>
        </div>
        <input type="submit" name="criar_rede" class="btn btn-success" value="Criar rede">
        <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=<?php echo $_SESSION['id'] ?>" type="submit" name="redes_acao_excluir" class="btn btn-secondary">Voltar</a>
    </form><!--form-->
</div><!--shadow-->