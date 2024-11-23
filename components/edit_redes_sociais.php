<?php
// Objetivo: Editar redes sociais do usuário

$id = $_GET['id'];
$mensagem = '';

// Busca Redes Sociais
$redes = Perfil::getRedesById($id);

// Padrão de imagem
$avatar = INCLUDE_PATH . 'static/uploads/avatar.jpg';
$capa = INCLUDE_PATH . 'static/uploads/capa.jpeg';
$redesImg = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';

if ($redes === false) {
    $mensagem = '<h5 class="card-title">Você não possui redes sociais cadastradas</h5>';
}

// Processar formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['editar_redes_sociais'])) {
        // Processar edição
        if (isset($_POST['editar_redes_sociais']) && $_POST['editar_redes_sociais'] === 'Atualizar') {
            $nome = $_POST['nome'];
            $link = $_POST['link'];
            $cor = $_POST['cor'];
            $imagem_atual = $_POST['imagem_atual'];

            // Validação dos campos
            $erros = [];
            if (empty($nome) || empty($link)) {
                $erros[] = "Todos os campos obrigatórios devem ser preenchidos.";
            }

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

            var_dump($nome, $link, $cor, $imagem, $id);
            var_dump($_SESSION);

            // Se não houver erros, atualizar a rede social
            if (empty($erros)) {
                $id = $_GET['id'];
                $redes = new Perfil();
                if ($redes->updateRedeSocial($nome, $link, $imagem, $cor, $id)) {
                    $mensagem = Painel::alert('sucesso', 'Rede atualizada com sucesso!');
                    // Redirecionar para a página de listagem de redes sociais
                    Painel::redirect(INCLUDE_PATH . 'perfil?usuario_edit=' . $id . '&status=sucesso');

                    // Recarregar os dados atualizados
                    $redes = Perfil::getRedesById($id);
                } else {
                    $mensagem = Painel::alert('erro', 'Erro ao atualizar a rede. Tente novamente.');
                }
            } else {
                $mensagem = implode('<br>', array_map(function ($erro) {
                    return Painel::alert('erro', $erro);
                }, $erros));
            }
        }
    } elseif (isset($_POST['redes_acao_excluir'])) {
        // Processar exclusão
        // Excluir Rede Social
        if (isset($_POST['redes_acao_excluir']) && $_POST['redes_acao_excluir'] == 'Excluir') {
            $perfil = new Perfil();
            if ($perfil->deleteRedeSocial($id)) {
                $mensagem = Painel::alert('sucesso', 'Rede social excluída com sucesso!');
                // Redirecionar para a página de listagem de redes sociais
                Painel::redirect(INCLUDE_PATH . 'perfil?usuario_edit=' . $id . '&status=sucesso');
                exit;
            } else {
                $mensagem = Painel::alert('erro', 'Erro ao excluir a rede social. Tente novamente.');
            }
        }
    }
}




?>

<?php if ($redes !== false): ?>
    <div class="shadow p-2 mb-5">
        <div class="card-header mb-2">
            <h5 class="card-title text-<?php echo htmlspecialchars($redes['cor']) ?>"><?php echo htmlspecialchars(ucfirst($redes['nome'])) ?></h5>
        </div>
        <?php if (!empty($mensagem)): ?>
            <div class="alert alert-info"><?php echo $mensagem; ?></div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3 form-control form-control-lg">
                <div class="form-group mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required value="<?php echo htmlspecialchars($redes['nome']) ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="link" class="form-label">Link:</label>
                    <input type="url" class="form-control" id="link" name="link" required value="<?php echo htmlspecialchars($redes['link']) ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="cor" class="form-label">Escolha uma cor:</label>
                    <select class="form-select" name="cor" id="cor" required>
                        <?php
                        $cores = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
                        foreach ($cores as $cor) {
                            $selected = ($cor == $redes['cor']) ? 'selected' : '';
                            echo "<option value=\"$cor\" $selected>$cor</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label file btn btn-outline-success" for="nova_imagem">Escolha uma nova imagem:</label><br>
                    <input type="file" class="btn btn-primary btn-sm" id="nova_imagem" name="nova_imagem" accept="image/*">
                    <input type="hidden" id="imagem_atual" name="imagem_atual" value="<?php echo htmlspecialchars($redes['imagem']) ?>">
                </div>
                <?php if (!empty($redes['imagem'])): ?>
                    <div class="mb-3">
                        <img src="<?php echo htmlspecialchars($redes['imagem']) ?>" alt="Imagem atual" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
            </div>
            <input type="submit" name="editar_redes_sociais" class="btn btn-success" value="Atualizar">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                Excluir
            </button>
            <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=<?php echo $_SESSION['id'] ?>" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir esta rede social?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form method="post">
                        <input type="submit" name="redes_acao_excluir" class="btn btn-danger" value="Excluir">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>