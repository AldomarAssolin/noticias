<?php
//Objetivo: Listar os slides cadastrados no banco de dados

// Verifica se o usuário está logado
$slides = Slides::listarSlides();

// Lógica para exclusão
if (isset($_POST['delete_slide'])) {
    if($_POST['delete_slide'] == 0){
        echo Painel::alert('erro', 'Erro ao excluir o slide. Tente novamente.');
    }
    $id_slide = $_POST['delete_slide'];
    $slide = new Slides();
    if ($slide->deleteSlide($id_slide)) {
        echo Painel::alert('sucesso', 'Slide excluído com sucesso!');
        $slides = Slides::listarSlides();
    } else {
        echo Painel::alert('erro', 'Erro ao excluir o slide. Tente novamente.');
    }
}

?>

<div class="">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 mb-0"><span class="lead fs-3 h2 ls-5">Lista de Slides</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                This week
            </button>
        </div>
    </div>
</div>

<div class="container mt-5">
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagem</th>
                <th class='text-end'>Ações</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($slides as $key => $value) {
            ?>
                <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['titulo'] ?></td>
                    <td><img src='<?php echo $value['imagem'] ?>' alt='<?php echo $value['titulo'] ?>' width='100'></td>
                    <td class='text-end'>
                        <!-- Botão para editar artigo -->
                        <a href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_slide?id=<?php echo $value['id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                            <svg class='bi'>
                                <use xlink:href='#pencil' />
                            </svg>
                        </a>
                        <!-- Botão para excluir artigo -->
                        <button type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-rede-id=<?php echo $value['id']; ?>>
                            <svg class='bi'>
                                <use xlink:href='#trash' />
                            </svg>
                        </button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

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
                    <input type="hidden" name="delete_slide" id="redeIdToDelete">
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
            var redeId = button.getAttribute('data-rede-id');
            var modalRedeIdInput = document.getElementById('redeIdToDelete');
            modalRedeIdInput.value = redeId;
        });
    });
</script>