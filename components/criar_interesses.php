<?php

// Criar novo interesse
if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $area = $_POST['area'];
    $usuario_id = $_POST['usuario_id'];

    // Processamento de upload de imagens
    if (!empty($_FILES['imagem']['name'])) {
        $upload_result = Painel::uploadFile($_FILES['imagem']);
        if ($upload_result !== false) {
            $imagem = $upload_result;
        } else {
            $mensagem = Painel::alert('erro', 'Erro no upload da imagem.');
        }
    }

    // verificar campos obrigatórios
    if (empty($nome) || empty($descricao) || empty($area)) {
        $mensagem = Painel::alert('erro', 'Preencha todos os campos obrigatórios.');
    }

    // Se não houver erros, criar o interesse
    $interesse = new Interesses();
    if ($interesse->create($nome, $descricao, $imagem, $area, $usuario_id)) {
        $mensagem = Painel::alert('sucesso', 'Interesse criado com sucesso!');
        Painel::redirect(INCLUDE_PATH . 'perfil?usuario_edit=interesses&id=' . $_SESSION['id'] . '&status=sucesso');
    } else {
        $mensagem = Painel::alert('erro', 'Erro ao criar o interesse. Tente novamente.');
    }
}

?>

<div class="container mt-5">
    <h2>Criar Novo Interesse</h2>
    <form action="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=criar_interesses&id=<?php echo $_SESSION['id'] ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="area" class="form-label">Área</label>
            <input type="text" class="form-control" id="area" name="area">
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label file btn btn-outline-success">Imagem</label>
            <input type="file" class="form-control" id="imagem" name="imagem">
        </div>
        <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id'] ?>">
        <button type="submit" class="btn btn-primary">Criar Interesse</button>
    </form>
</div>
