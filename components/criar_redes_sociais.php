<?php
// Objetivo: Criar nova rede social para o usuário

$id = $_SESSION['id'];
$mensagem = '';

if (isset($_POST['criar_rede'])) {
    $nome = trim($_POST['nome']);
    $link = trim($_POST['link']);
    $cor = $_POST['cor'];
    $nova_imagem = $_FILES['nova_imagem'];

    // Validação dos campos
    $erros = validate_form($nome, $link, $cor);

    if (empty($erros)) {
        // Processamento da imagem
        if (!empty($nova_imagem['name'])) {
            if (Painel::imagemValida($nova_imagem)) {
                $nova_imagem = Painel::uploadFile($nova_imagem);
                if ($nova_imagem === false) {
                    $erros[] = 'Erro ao fazer upload da imagem.';
                }
            } else {
                $erros[] = 'O formato da imagem não é válido.';
            }
        } else {
            $nova_imagem = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';
        }

        // Se não houver erros, criar a nova rede social
        if (empty($erros)) {
            $redes = new Perfil();
            if ($redes->createRedeSocial($nome, $link, $nova_imagem, $cor, $id)) {
                $mensagem = Painel::alert('sucesso', 'Rede social cadastrada com sucesso!');
                Painel::redirect(INCLUDE_PATH . 'perfil?usuario_edit=' . $id . '&status=sucesso');
            } else {
                $mensagem = Painel::alert('erro', 'Erro ao cadastrar rede social. Tente novamente.');
            }
        }
    }

    // Exibir erros, se houver
    if (!empty($erros)) {
        $mensagem = implode('<br>', array_map(function($erro) {
            return Painel::alert('erro', $erro);
        }, $erros));
    }
}

// Função de validação do formulário
function validate_form($nome, $link, $cor) {
    $errors = [];
    if (empty($nome) || empty($link) || empty($cor)) {
        $errors[] = 'Preencha todos os campos!';
    }
    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        $errors[] = 'O link fornecido não é válido.';
    }
    return $errors;
}
?>

<div class="shadow p-2 mb-5">
    <div class="card-header mb-2">
        <h5 class="card-title">Crie um novo link de rede social</h5>
    </div>
    <?php echo $mensagem; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3 form-control form-control-lg">
            <div class="form-group mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input required type="text" class="form-control" id="nome" name="nome" aria-describedby="nome" placeholder='Digite o nome da rede'>
            </div>
            <div class="form-group mb-3">
                <label for="link" class="form-label">Link:</label>
                <input required type="url" class="form-control" id="link" name="link" placeholder='Digite o link da rede'>
            </div>
            <div class="form-group mb-3">
                <label for="cor" class="form-label">Escolha uma cor:</label>
                <select required class="form-select" name="cor" id="cor">
                    <option value="">Escolha uma cor</option>
                    <?php
                    $cores = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
                    foreach ($cores as $cor) {
                        echo "<option value=\"$cor\">$cor</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label class="form-label file btn btn-outline-success" for="nova_imagem">Escolha uma imagem:</label><br>
                <input type="file" class="file btn btn-outline-success" id="nova_imagem" name="nova_imagem" accept="image/*">
            </div>
        </div>
        <input type="submit" name="criar_rede" class="btn btn-success" value="Criar rede">
        <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=<?php echo $_SESSION['id'] ?>" class="btn btn-secondary">Voltar</a>
    </form>
</div>