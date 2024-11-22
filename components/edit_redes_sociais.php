<?php
// Objetivo: Editar redes sociais do usuario

$id = $_GET['id'];

$mensagem = '';

//Busca Redes Sociais
$redes = Perfil::getRedesById($id);



//Padrao de imagem
$avatar = '';
$capa = '';
$redesImg = '';
if ($avatar == null || $avatar == '' || $capa == null || $capa == '' || $redes == null || $redes == '') {
    $avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
    $capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
    $redesImg = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';
};

if ($redes == false) {
    $mensagem .= '<h5 class="card-title">Você não possui redes sociais cadastradas</h5>';
}

//Atualiza Redes Sociais
if (isset($_POST['editar_rede'])) {
    
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
    $redes->updateRedeSocial($nome, $link, $nova_imagem, $cor, $id);
    echo Painel::alert('sucesso', 'Rede social cadastrada com sucesso!');
}

?>

<?php
echo $mensagem;
?>
    <div class="shadow p-2 mb-5">
        <div class="card-header mb-2">
            <h5 class="card-title text-<?php echo $redes['cor'] ?>"><?php echo ucfirst($redes['nome']) ?? $mensagem ?></h5>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3 form-control form-control-lg">
                <div class="form-group mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome_rede" aria-describedby="emailHelp" placeholder='<?php echo $redes['nome'] ?>' value="<?php echo $redes['nome'] ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="link" class="form-label">Link:</label>
                    <input type="text" class="form-control" id="link" name="link" placeholder='<?php echo $redes['link'] ?>' value="<?php echo $redes['nome'] ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="link" class="form-label">Escolha uma cor:</label>
                    <select class="form-select" name="cor" aria-label="Default select example" value="<?php echo $redes['nome'] ?>">
                        <option selected><?php echo $redes['cor'] ?></option>
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
                    <input type="hidden" class="form-input" id="imagem_atual" name="imagem_atual">
                </div>
            </div>
            <button type="submit" name="editar_rede" class="btn btn-success">Atualizar</button>
            <button type="submit" name="redes_acao_excluir" class="btn btn-danger">Excluir</button>
        </form><!--form-->
    </div><!--shadow-->
