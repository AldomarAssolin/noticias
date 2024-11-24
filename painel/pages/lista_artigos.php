<?php

// Ativar artigo
if (isset($_POST['acao'])) {

    if ($_POST['acao'] == 'ativar') {
        if ($_POST['id'] == 0) {
            echo Painel::alert('erro', 'Erro ao ativar o artigo. Tente novamente.');
        }
        $id = $_POST['id'];
        $artigo = new Artigos();
        if ($artigo->ativarArtigo($id)) {
            echo Painel::alert('sucesso', 'Artigo ativado com sucesso!');
        } else {
            echo Painel::alert('sucesso', 'Sucesso ao ativar o artigo. Tente novamente.');
        }
    }
}

//Excluir artigo
//A exclusão consiste em atualizar o extatus do artigo.
if (isset($_POST['delete_artigo'])) {
    if ($_POST['delete_artigo'] == 0) {
        echo Painel::alert('sucesso', 'Sucesso ao excluir o artigo. Tente novamente.');
    }
    $id_artigo = $_POST['delete_artigo'];
    $artigo = new Artigos();
    if ($artigo->deletarArtigo($id_artigo)) {
        echo Painel::alert('sucesso', 'Artigo excluído com sucesso!');
        $artigo = Artigos::pegarArtigo($id_artigo);
    }
}

$artigos = Artigos::listarArtigosComAutores();  // Chama a função para pegar os artigos

?>

<section class="list-user mx-md-3">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0"><span class="lead fs-3 h2 ls-5">Lista de Artigos</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr class="table-success">
                    <td>Autor</td>
                    <td>Título</td>
                    <td>Data</td>
                    <td class="text-end">Ações</td>
                </tr>
            </thead>
            <tbody>

                <?php



                if ($artigos) {  // Verifica se há artigos

                    foreach ($artigos as $artigo) {
                        if ($artigo['artigo_id']) {
                ?>
                            <tr>
                                <td>
                                    <img src="<?php echo htmlspecialchars($artigo['avatar']); ?>" alt="Imagem do perfil" width="24" height="24" class="rounded-circle mx-2">
                                    <span class="fs-6"><?php echo htmlspecialchars($artigo['nome_completo']); ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($artigo['titulo']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($artigo['data_criacao'])); ?></td>
                                <td class='d-flex justify-content-end'>
                                    <!-- Botão para editar artigo -->
                                    <a href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_artigos?id=<?php echo $artigo['artigo_id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                                        <svg class='bi'>
                                            <use xlink:href='#pencil' />
                                        </svg>
                                    </a>
                                    <?php
                                    if ($artigo['status'] == 1) {
                                    ?>
                                        <!-- Botão para excluir artigo -->
                                        <button title="Desativar artigo" type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-artigo-id=<?php echo $artigo['artigo_id']; ?>>
                                            <i class="bi-file-earmark-excel"></i>
                                        </button>
                                    <?php
                                    } else {

                                    ?>
                                    <!-- Botão para ativar artigo -->
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?php echo $artigo['artigo_id']; ?>">
                                            <button title="Ativar artigo" type="submit" name="acao" value="ativar" class="btn btn-sm btn-success">
                                                <i class="bi bi-file-earmark-check"></i>
                                            </button>
                                        </form>

                        <?php
                                    }
                                }
                            }
                        }

                        ?>
                                </td>
                            </tr>
            </tbody>
        </table>
    </div>


</section>

<!-- Modal -->
<div class='modal fade' id='confirmDeleteModal' tabindex='-1' aria-labelledby='confirmDeleteModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='confirmDeleteModalLabel'>Confirmar Exclusão</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                Tem certeza que deseja excluir esta formação?
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                <form method='post'>
                    <input type="hidden" name="delete_artigo" id="artigoIdToDelete">
                    <button type='submit' class='btn btn-danger'>Excluir</button>
                </form>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- Modal -->
<!-- Modal -->
</div><!--container-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var redeId = button.getAttribute('data-artigo-id');
            var modalRedeIdInput = document.getElementById('artigoIdToDelete');
            modalRedeIdInput.value = redeId;
        });
    });
</script>