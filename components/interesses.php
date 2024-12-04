<?php

// Salvar Alterações
if (isset($_POST['salvar_alteracoes'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $area = $_POST['area'];
    $imagem_atual = $_POST['imagem_atual'];

    $imagem = $imagem_atual;
    if (!empty($_FILES['nova_imagem']['name'])) {
        $upload_result = Painel::uploadFile($_FILES['nova_imagem']);
        if ($upload_result !== false) {
            $imagem = $upload_result;
        } else {
            $mensagem = Painel::alert('erro', 'Erro no upload da imagem.');
        }
    }

    if (Interesses::update($nome, $descricao, $imagem, $area, $id)) {
        $mensagem = Painel::alert('sucesso', 'Interesse atualizado com sucesso!');
    } else {
        $mensagem = Painel::alert('erro', 'Erro ao atualizar o interesse.');
    }
}


// Excluir Interesse
if (isset($_POST['excluir_interesse'])) {
    $id = $_POST['id'];
    $imagem_atual = $_POST['imagem_atual'];

    if (Interesses::delete($id)) {
        Painel::deleteFile($_POST['imagem_atual']);
        $mensagem = Painel::alert('sucesso', 'Interesse excluído com sucesso!');
    } else {
        $mensagem = Painel::alert('erro', 'Erro ao excluir o interesse.');
    }
}

$interesses = Interesses::getAllByUser($_SESSION['id']);

$mensagem = '';
if(!$interesses){
    $mensagem .= '<h2>Você ainda não possui interesses cadastrados.</h2>';
}

?>

<section class="interesses my-5">
    <div class="container">
        
        <!-- Botão para adicionar novo interesse -->
        <div class="d-flex align-items-end justify-content-between">
            <h2 class="mb-4">Meus Interesses</h2>
            <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=criar_interesses&id=<?php echo $_SESSION['id'] ?>" class="btn btn-success mb-3">
                Adicionar Novo Interesse
            </a>
        </div>

        <div class="list-group">
            <?php 
            echo $mensagem; 
            if($interesses):
            foreach ($interesses as $interesse): 
                
            ?>
                <div class="d-flex text-body-secondary pt-3 border-bottom">
                    <div class="row w-100">
                        <div class="col-8 d-flex alisn-items-end pb-2">
                            <img src="<?php echo htmlspecialchars($interesse['imagem']) ?? $imagem ?>" alt="<?php echo htmlspecialchars($interesse['nome']) ?>" width="48" height="48">
                            <p class="mb-0 small lh-sm px-3 d-flex flex-column align-items-start justify-content-end ">
                                <strong class="d-block text-gray-dark text-start"><?php echo htmlspecialchars($interesse['nome']) ?></strong>
                                <?php echo htmlspecialchars($interesse['descricao']) ?>
                            </p>
                        </div><!--col-8-->
                        <div class="col-4 d-flex align-items-end justify-content-end pb-2">
                            <button type="button" class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#editarInteresse<?php echo $interesse['id']; ?>">
                                Editar
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#excluirInteresse<?php echo $interesse['id']; ?>">
                                Excluir
                            </button>
                        </div><!--col-4-->
                    </div><!--row-->
                </div><!--d-flex-->

                <!-- Modal de Edição -->
                <div class="modal fade" id="editarInteresse<?php echo $interesse['id']; ?>" tabindex="-1" aria-labelledby="editarInteresseLabel<?php echo $interesse['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarInteresseLabel<?php echo $interesse['id']; ?>">Editar Interesse</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $interesse['id']; ?>">
                                    <div class="mb-3">
                                        <label for="nome<?php echo $interesse['id']; ?>" class="form-label">Nome do Interesse</label>
                                        <input type="text" class="form-control" id="nome<?php echo $interesse['id']; ?>" name="nome" value="<?php echo htmlspecialchars($interesse['nome']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descricao<?php echo $interesse['id']; ?>" class="form-label">Descrição</label>
                                        <textarea class="form-control" id="descricao<?php echo $interesse['id']; ?>" name="descricao" required><?php echo htmlspecialchars($interesse['descricao']); ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="area<?php echo $interesse['id']; ?>" class="form-label">Área</label>
                                        <input type="text" class="form-control" id="area<?php echo $interesse['id']; ?>" name="area" value="<?php echo htmlspecialchars($interesse['area']); ?>" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label file btn btn-outline-success" for="nova_imagem<?php echo $interesse['id']; ?>">Escolha uma nova imagem:</label><br>
                                        <input type="file" class="btn btn-primary btn-sm" id="nova_imagem<?php echo $interesse['id']; ?>" name="nova_imagem" accept="image/*">
                                        <input type="hidden" name="imagem_atual" value="<?php echo $interesse['imagem'] ?>">
                                    </div>
                                    <?php if (!empty($interesse['imagem'])): ?>
                                        <div class="mb-3">
                                            <img src="<?php echo $interesse['imagem'] ?>" alt="Imagem atual" class="img-thumbnail" style="max-width: 200px;" accept="image/*">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="salvar_alteracoes" class="btn btn-primary">Salvar Alterações</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal de Exclusão -->
                <div class="modal fade" id="excluirInteresse<?php echo $interesse['id']; ?>" tabindex="-1" aria-labelledby="excluirInteresseLabel<?php echo $interesse['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="excluirInteresseLabel<?php echo $interesse['id']; ?>">Confirmar Exclusão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                Tem certeza que deseja excluir o interesse "<?php echo htmlspecialchars($interesse['nome']); ?>"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?php echo $interesse['id']; ?>">
                                    <input type="hidden" name="imagem_atual" value="<?php echo $interesse['imagem']; ?>">
                                    <button type="submit" name="excluir_interesse" class="btn btn-danger">Confirmar Exclusão</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
            endforeach;
            endif; 
            ?>
        </div>
    </div>
</section>