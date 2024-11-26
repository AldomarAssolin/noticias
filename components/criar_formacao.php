<?php
// Obter os dados atuais da formação

$id = $_SESSION['id'];

//Criar formação
if (isset($_POST['submit'])) {
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

    // Se não houver erros, criar a formação
    if (empty($erros)) {
        $formacao = new Perfil();
        if ($formacao->createFormacao($nome, $instituicao, $nivel, $data_inicio, $conclusao, $imagem, $cidade, $uf, $id)) {
            $mensagem = Painel::alert('sucesso', 'Formação criada com sucesso!');
            // Redirecionar para a página de listagem de formações
            Painel::redirect(INCLUDE_PATH . 'perfil?usuario_edit=formacao&id=' . $_SESSION['id'] . '&status=sucesso');
        } else {
            $mensagem = Painel::alert('erro', 'Erro ao criar a formação. Tente novamente.');
        }
    } else {
        $mensagem = implode('<br>', array_map(function ($erro) {
            return Painel::alert('erro', $erro);
        }, $erros));
    }
}
?>



<div class="container">

    <!--Alerta-->
    <div>
        <?php
        if (isset($mensagem)) {
            echo $mensagem;
        }
        ?>
    </div>
    <!--form-->
    <form action="" method="post" enctype="multipart/form-data" class='container shadow p-3'>

        <div class='mb-3'>
            <label for='nome' class='form-label'>Curso:</label>
            <input type='text' id='nome' name='nome' class='form-control' required>
        </div>

        <div class='mb-3'>
            <label for='instituicao' class='form-label'>Instituicao:</label>
            <input type='text' id='instituicao' name='instituicao' class='form-control' value="" required>
        </div>

        <div class='mb-3'>
            <label for='nivel' class='form-label'>Nível:</label>
            <input type='text' id='nivel' name='nivel' class='form-control' required>
        </div>

        <div class='mb-3'>
            <label for='data_inicio' class='form-label'>Data de início:</label>
            <input type='date' id='data_inicio' name='data_inicio' class='form-control' required>
        </div>

        <div class='mb-3'>
            <label for='conclusao' class='form-label'>Conclusão:</label>
            <input type='date' id='conclusao' name='conclusao' class='form-control' required>
        </div>

        <div class='mb-3'>
            <label for='cidade' class='form-label'>Cidade:</label>
            <input type='text' id='cidade' name='cidade' class='form-control' required>
        </div>

        <div class='mb-3'>
            <label for='uf' class='form-label'>UF:</label>
            <input type='text' id='uf' name='uf' class='form-control' required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label file btn btn-outline-success" for="nova_imagem">Escolha uma nova imagem:</label><br>
            <input type="file" class="btn btn-primary btn-sm" id="nova_imagem" name="nova_imagem" accept="image/*">
        </div>

        <div class='d-flex justify-content-start'>
            <button type='submit' name='submit' class='btn btn-success'>Salvar</button>
            <a href='<?php echo INCLUDE_PATH ?>perfil?usuario_edit=formacao&id=<?php echo $_SESSION['id'] ?>' class='btn btn-secondary mx-2'>Voltar</a>
        </div>
    </form>
    <!--form-->