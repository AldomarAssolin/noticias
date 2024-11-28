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
<div class="card mb-3">
        <div class="row">
            <div class="col-8">
                <div class="card-header fs-6 fst-italic">
                    <?php echo htmlspecialchars($value['nivel']) ?>
                </div>
                <div class="card-body">
                    <p>
                        <?php echo htmlspecialchars($value['nome']) ?> -
                        <span class="text-info"><?php echo htmlspecialchars($value['instituicao']) ?></span>
                    </p>
                    <p>
                        <?php echo htmlspecialchars($value['cidade']) ?> - <?php echo htmlspecialchars($value['uf']) ?>
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted fst-italic">
                        <?php echo date('d/m/Y', strtotime($value['data_inicio'])) ?> - <?php echo date('d/m/Y', strtotime($value['conclusao'])) ?>
                    </small>
                </div>
            </div><!--col-8-->
            <div class="col-4">
                <img src="<?php echo htmlspecialchars($value['logo']) ?>" class="card-img-top" alt="logo">
            </div>
        </div><!--row-->
        <div class="card-footer">
            <div class="d-flex justify-content-end">
                <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=editar_formacao&id=<?php echo $value['id'] ?>" class="btn btn-outline-warning btn-sm me-2">Editar</a>
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-formacao-id="<?php echo $value['id'] ?>">
                    Excluir
                </button>
            </div>
        </div><!--card-footer-->
    </div><!--card-->

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