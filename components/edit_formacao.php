<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir esta formação?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="post">
                    <input type="hidden" name="excluir_formacao" id="formacaoIdToDelete">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Confirmação de Exclusão -->

<div class="card mb-3 p-2">
<div class="text-end py-2">
    <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=criar_formacao" class="btn btn-success btn-sm">Criar Nova</a>
</div><!--acao criar nova formacao-->

        <?php
        switch ($_GET['usuario_edit']) {
            case ($_GET['usuario_edit'] === 'editar_formacao'):
                include('components/atualizar_formacao.php');
                break;
            case ($_GET['usuario_edit'] === 'criar_formacao'):
                include('components/criar_formacao.php');
                break;
            default:
                include('components/lista_formacao.php');
        }
        
        ?>
</div><!--card-->