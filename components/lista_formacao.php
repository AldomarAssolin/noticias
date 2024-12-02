<?php
$formacao = Perfil::getFormacao($id);
$mensagem = '';
// Lógica para exclusão
if (isset($_POST['excluir_formacao'])) {
    $id_formacao = $_POST['excluir_formacao'];
    $perfil = new Perfil();
    if ($perfil->deleteFormacao($id_formacao)) {
        $mensagem .= Painel::alert('sucesso', 'Formação excluída com sucesso.');
    } else {
        $mensagem .= Painel::alert('erro', 'Erro ao excluir formação.');
    }
}

$formacao = Perfil::getFormacao($id);

echo $mensagem;

foreach ($formacao as $key => $value) {
?>
    <div class="d-flex text-body-secondary pt-3 border-bottom">
        <div class="row w-100">
            <div class="col-2 d-flex align-items-end pb-2">
                <img src="<?php echo htmlspecialchars($value['logo']) ?>" class="card-img-top" alt="logo" width="80" height="80">
            </div><!--col-8-->
            <div class="col-8 d-flex flex-column align-items-start justify-content-end pb-2">
                <p class="mb-0 small lh-sm">
                    <strong class="d-block text-gray-dark text-start mb-2"><?php echo htmlspecialchars(ucfirst($value['nivel'])) ?></strong>
                    <?php echo htmlspecialchars($value['nome']) ?>
                    <span class="text-info fst-italic"><?php echo htmlspecialchars(ucfirst($value['instituicao'])) ?></span>
                </p>
                <small class="text-muted fst-italic">
                    <?php echo htmlspecialchars(strtoupper($value['cidade'])) ?> - <?php echo htmlspecialchars(strtoupper($value['uf'])) ?>
                    <?php echo date('d/m/Y', strtotime($value['data_inicio'])) ?> - <?php echo date('d/m/Y', strtotime($value['conclusao'])) ?>
                </small>
            </div>
            <div class="col-2 d-flex align-items-end justify-content-end pb-2">
                <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=editar_formacao&id=<?php echo $value['id'] ?>" class="btn btn-outline-warning btn-sm me-2">Editar</a>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-formacao-id="<?php echo $value['id'] ?>">
                    Excluir
                </button>
            </div><!--col-4-->
        </div><!--row-->
    </div><!--d-flex-->

<?php
}

?>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var formacaoId = button.getAttribute('data-formacao-id');
            var modalFormacaoIdInput = document.getElementById('formacaoIdToDelete');
            modalFormacaoIdInput.value = formacaoId;
        });
    });
</script>