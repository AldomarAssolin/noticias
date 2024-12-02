<div class="text-end py-2">
    <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=criar_redes_sociais" class="btn btn-success btn-sm">Criar Nova</a>
</div>
<?php
$redesImg = INCLUDE_PATH . 'static/uploads/redes_sociais.jpeg';

$redes = Perfil::getAllRedesSociais($id);

foreach ($redes as $key => $value) {
?>
    <!--Redes Sociais-->
        <div class="d-flex text-body-secondary pt-3 border-bottom">
        <div class="row w-100">
            <div class="col-3 col-lg-2 d-flex align-items-end pb-2">
                <img src="<?php echo htmlspecialchars($value['imagem']) ?>" class="card-img-top" alt="logo" width="80" height="60">
            </div><!--col-8-->
            <div class="col-9 col-lg-8 text-truncate d-flex flex-column align-items-start justify-content-end pb-2">
                <div class="col-12">
                    <p class="mb-0 small lh-sm">
                        <strong class="d-block text-gray-dark text-start mb-2"><?php echo htmlspecialchars(ucfirst($value['nome'])) ?></strong>
                        <span class="text-info fst-italic"><?php echo htmlspecialchars(ucfirst($value['link'])) ?></span>
                    </p>
                </div>
        
                <div class="col-12 d-flex mt-2 justify-content-around">
                    <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=editar_redes_sociais&id=<?php echo $value['id'] ?>" class="btn btn-outline-warning btn-sm me-2">Editar</a>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-rede-id="<?php echo $value['id'] ?>">
                        Excluir
                    </button>
                </div>
            </div>
        </div><!--row-->
    </div><!--d-flex-->
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
        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var redeId = button.getAttribute('data-rede-id');
            var modalRedeIdInput = document.getElementById('redeIdToDelete');
            modalRedeIdInput.value = redeId;
        });
    });
</script>