<?php
// Obter os dados atuais da formação

$id = $_GET['id'];

//var_dump($_POST);
// Atualizar formação
if (isset($_POST['atualizar'])) {
    $nome = $_POST['nome'];
    $instituicao = $_POST['instituicao'];
    $nivel = $_POST['nivel'];
    $data_inicio = $_POST['data_inicio'];
    $conclusao = $_POST['conclusao'];
    $imagem_atual = $_POST['imagem_atual'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];

    // Processamento de upload de imagens
    $imagem = $imagem_atual;
    if (!empty($_FILES['nova_imagem']['name'])) {
        $upload_result = Painel::uploadFile($_FILES['nova_imagem']);
        if ($upload_result !== false) {
            $imagem = $upload_result;
        } else {
            $erros[] = "Erro no upload da imagem.";
        }
    }

    // Verificar se todos os campos foram preenchidos
    if(!empty($nome) && !empty($instituicao) && !empty($nivel) && !empty($data_inicio) && !empty($conclusao) && !empty($cidade) && !empty($uf)){
        
        // Se não houver erros, atualizar a formação
        if (empty($erros)) {
            $id = $_GET['id'];
            var_dump($id);
            $formacao = new Perfil();
            if ($formacao->updateFormacao($nome, $instituicao, $nivel, $data_inicio, $conclusao, $imagem, $cidade, $uf, $id)) {
                $mensagem = Painel::alert('sucesso', 'Formação atualizada com sucesso!');
                // Redirecionar para a página de listagem de formações
                Painel::redirect(INCLUDE_PATH . 'perfil?usuario_edit=formacao&id=' . $id . '&status=sucesso');
    
                // Recarregar os dados atualizados
                $formacao = Perfil::getFormacaoById($id);
            } else {
                $mensagem = Painel::alert('erro', 'Erro ao atualizar a formação. Tente novamente.');
            }
        } else {
            $mensagem = implode('<br>', array_map(function ($erro) {
                return Painel::alert('erro', $erro);
            }, $erros));
        }
    }else{
        $erros[] = "Preencha todos os campos.";
    }
}

$formacao = Perfil::getFormacaoById($_GET['id']);

?>



<div class="container">

    <!--form-->
    <form action="" method="post" enctype="multipart/form-data" class='container shadow p-3'>

        <div class='mb-3'>
            <label for='nome' class='form-label'>Curso:</label>
            <input type='text' id='nome' name='nome' class='form-control' value="<?php echo $formacao['nome'] ?>" required>
        </div>

        <div class='mb-3'>
            <label for='instituicao' class='form-label'>Instituicao:</label>
            <input type='text' id='instituicao' name='instituicao' class='form-control' value="<?php echo $formacao['instituicao'] ?>" required>
        </div>

        <div class='mb-3'>
            <label for='nivel' class='form-label'>Nível:</label>
            <input type='text' id='nivel' name='nivel' class='form-control' value="<?php echo $formacao['nivel'] ?>" required>
        </div>

        <div class='mb-3'>
            <label for='data_inicio' class='form-label'>Data de início:</label>
            <input type='date' id='data_inicio' name='data_inicio' class='form-control' value="<?php echo $formacao['data_inicio'] ?>" required>
        </div>

        <div class='mb-3'>
            <label for='conclusao' class='form-label'>Conclusão:</label>
            <input type='date' id='conclusao' name='conclusao' class='form-control' value="<?php echo $formacao['conclusao'] ?>" required>
        </div>
        <div class='mb-3'>
            <label for='cidade' class='form-label'>Cidade:</label>
            <input type='text' id='cidade' name='cidade' class='form-control' value="<?php echo $formacao['cidade'] ?>" required>
        </div>

        <div class='mb-3'>
            <label for='uf' class='form-label'>UF:</label>
            <input type='text' id='uf' name='uf' class='form-control' value="<?php echo $formacao['uf'] ?>" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label file btn btn-outline-success" for="nova_imagem">Escolha uma nova imagem:</label><br>
            <input type="file" class="btn btn-primary btn-sm" id="nova_imagem" name="nova_imagem" accept="image/*">
            <input type="hidden" id="imagem_atual" name="imagem_atual" value="<?php echo $formacao['logo'] ?>">
        </div>
        <?php if (!empty($formacao['imagem'])): ?>
            <div class="mb-3">
                <img src="" alt="Imagem atual" class="img-thumbnail" style="max-width: 200px;">
            </div>
        <?php endif; ?>

        <!-- Acoes -->
        <div class='d-flex justify-content-start'>
            <input type="submit" name="atualizar" value="Atualizar" class="btn btn-success">
            <a href='<?php echo INCLUDE_PATH ?>perfil?usuario_edit=formacao&id=<?php echo $_SESSION['id'] ?>' class='btn btn-secondary mx-2'>Voltar</a>
        </div>
        <!-- Acoes -->
    </form>
    <!--form-->
