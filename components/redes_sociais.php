

<div class="text-end py-2">
    <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=criar_redes_sociais" class="btn btn-success btn-sm">Criar Nova</a>
</div>
<?php
$redesImg = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';

$redes = Perfil::getAllRedesSociais($id);

foreach ($redes as $key => $value) {
?>
    <!--Redes Sociais-->
    <div class="card mb-3" style="height:150px">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="card-body p-0">
                    <img src="<?php echo $value['imagem'] ?? $redesImg ?>" alt="Imagem de <?php echo htmlspecialchars($value['nome']) ?>" class="img-fluid rounded-start image" alt="<?php echo htmlspecialchars(ucfirst($value['nome'])) ?>">
                </div>
            </div><!--col-md-4-->
            <div class="col-md-8">
                <div class="card-body pb-0">
                    <h5 class="card-title"><?php echo htmlspecialchars(ucfirst($value['nome'])) ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($value['link']) ?></p>
                    <p class="card-text">
                        <small class="text-body-secondary">
                            <div class="card-footer w-100 pb-2 text-end d-flex align-items-center justify-content-end">
                                <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=editar_redes_sociais&id=<?php echo $value['id'] ?>" class="btn btn-outline-warning btn-sm me-2">Editar</a>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-rede-id="<?php echo $value['id'] ?>">
                                    Excluir
                                </button>
                            </div>
                        </small>
                    </p>
                </div><!--card-body-->
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--card-->
    <!--Redes Sociais-->
<?php
}

// Lógica para exclusão
if (isset($_POST['excluir_rede'])) {
    $id_rede = $_POST['excluir_rede'];
    $perfil = new Perfil();
    if ($perfil->deleteRedeSocial($id_rede)) {
        echo Painel::alert('sucesso', 'Rede social excluída com sucesso!');
        Painel::redirect(INCLUDE_PATH . 'perfil?usuario_edit=' . $id . '&status=sucesso');
    } else {
        echo Painel::alert('erro', 'Erro ao excluir a rede social. Tente novamente.');
    }
}
?>

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
                <form id="deleteForm" method="post">
                    <input type="hidden" name="excluir_rede" id="redeIdToDelete">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Confirmação de Exclusão -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var redeId = button.getAttribute('data-rede-id');
        var modalRedeIdInput = document.getElementById('redeIdToDelete');
        modalRedeIdInput.value = redeId;
    });
});
</script>