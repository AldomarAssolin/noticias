<div class="container mt-5">
    <h2>Atualizar Interesse</h2>
    <?php
    $interesse = Interesses::getById($_GET['interesse_id']);
    if ($interesse):
    ?>
    <form action="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=atualizar_interesses&id=<?php echo $_SESSION['id'] ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $interesse['id'] ?>">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($interesse['nome']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"><?php echo htmlspecialchars($interesse['descricao']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="imagem" name="imagem">
            <?php if ($interesse['imagem']): ?>
                <img src="<?php echo $interesse['imagem'] ?>" alt="Imagem atual" class="mt-2" style="max-width: 200px;">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="area" class="form-label">Área</label>
            <input type="text" class="form-control" id="area" name="area" value="<?php echo htmlspecialchars($interesse['area']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Interesse</button>
    </form>
    <?php else: ?>
        <p>Interesse não encontrado.</p>
    <?php endif; ?>
</div>>