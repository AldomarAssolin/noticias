<?php
$id = $_GET['id'] ?? $_SESSION['id'];
$artigos = Artigos::listarArtigosAutor($id);
$url = INCLUDE_PATH_PAINEL . 'lista_artigos_autor?id=' . $id;

if (isset($_POST['acao'])) {
    $artigo = new Artigos();
    $id_artigo = $_POST['id'];

    switch ($_POST['acao']) {
        case 'ativar':
            $mensagem .= $artigo->ativarArtigo($id_artigo) ??
                Painel::alert('sucesso', 'Artigo ativado com sucesso!');
            break;
        case 'desativar':
            $mensagem .= $artigo->desativarArtigo($id_artigo) ?? 
                Painel::alert('sucesso', 'Artigo desativado com sucesso!');
            break;
        case 'excluir_permanentemente':
            $mensagem .= $artigo->excluirPermanentemente($id_artigo) ?? 
                Painel::alert('sucesso', 'Artigo excluído permanentemente com sucesso!');
            break;
    }

    echo $mensagem;
    $artigos = Artigos::listarArtigosAutor($_SESSION['id']);
}

$titulo = $artigos ? '<span class="lead fs-3 h2 ls-5">Lista de Artigos de</span> <b>' . $artigos[0]['nome_completo'] . '</b>' : 'Nenhum artigo encontrado';
?>

<section class="list-user mx-md-3">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 mb-0"><?php echo $titulo ?></h1>
    </div>

    <nav class="navbar navbar-expand">
        <ul class="w-100 navbar-nav justify-content-end px-2">
            <li class="nav-item">
                <a class="btn btn-sm btn-success" href="cadastrar_artigo">Cadastrar</a>
            </li>
        </ul>
    </nav>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr class="table-success">
                    <th>Autor</th>
                    <th>Título</th>
                    <th>Data</th>
                    <th class='text-end'>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artigos as $artigo): ?>
                    <?php if ($artigo['id'] == $_SESSION['id']): ?>
                        <tr>
                            <td class='align-bottom'>
                                <img src="<?php echo htmlspecialchars($artigo['avatar'] ?? INCLUDE_PATH . 'static/uploads/avatar.jpg'); ?>" alt="Imagem do perfil" width="24" height="24" class="rounded-circle mx-2">
                                <span class="fs-6"><?php echo htmlspecialchars($artigo['nome_completo']); ?></span>
                            </td>
                            <td class='align-bottom'><?php echo htmlspecialchars($artigo['titulo']); ?></td>
                            <td class='align-bottom'><?php echo date('d/m/Y', strtotime($artigo['data_criacao'])); ?></td>
                            <td class='align-bottom d-flex justify-content-end'>
                                <a href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_artigos?id=<?php echo $artigo['artigo_id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2" title="Atualizar artigo">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php if ($artigo['status'] == 1): ?>
                                    <button type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDesativarModal' data-artigo-id="<?php echo $artigo['artigo_id']; ?>" title="Desativar artigo">
                                        <i class="bi bi-file-earmark-excel"></i>
                                    </button>
                                <?php else: ?>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $artigo['artigo_id']; ?>">
                                        <button type="submit" name="acao" value="ativar" class="btn btn-sm btn-success" title="Ativar artigo">
                                            <i class="bi bi-file-earmark-check"></i>
                                        </button>
                                    </form>
                                    <button type='button' class='btn btn-sm btn-danger ms-2' data-bs-toggle='modal' data-bs-target='#confirmExcluirPermanenteModal' data-artigo-id="<?php echo $artigo['artigo_id']; ?>" title="Excluir permanentemente">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Modal Desativar Artigo -->
<div class='modal fade' id='confirmDesativarModal' tabindex='-1' aria-labelledby='confirmDesativarModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='confirmDesativarModalLabel'>Confirmar Desativação</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                Tem certeza que deseja desativar este artigo?
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                <form method='post'>
                    <input type="hidden" name="id" id="artigoIdToDesativar">
                    <button type='submit' name="acao" value="desativar" class='btn btn-warning'>Desativar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Excluir Permanentemente -->
<div class='modal fade' id='confirmExcluirPermanenteModal' tabindex='-1' aria-labelledby='confirmExcluirPermanenteModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='confirmExcluirPermanenteModalLabel'>Confirmar Exclusão Permanente</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                Tem certeza que deseja excluir permanentemente este artigo? Esta ação não pode ser desfeita.
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                <form method='post'>
                    <input type="hidden" name="id" id="artigoIdToExcluir">
                    <button type='submit' name="acao" value="excluir_permanentemente" class='btn btn-danger'>Excluir Permanentemente</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    ['confirmDesativarModal', 'confirmExcluirPermanenteModal'].forEach(function(modalId) {
        var modal = document.getElementById(modalId);
        modal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var artigoId = button.getAttribute('data-artigo-id');
            var input = this.querySelector('input[type="hidden"]');
            input.value = artigoId;
        });
    });
});
</script>