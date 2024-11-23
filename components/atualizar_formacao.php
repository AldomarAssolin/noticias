<?php
// Obter os dados atuais da formação
//$formacao = Perfil::getFormacao($_GET['id']);

?>



<div class="container">

    <!--form-->
    <form action="" method="post" enctype="multipart/form-data" class='container shadow p-3'>

        <div class='mb-3'>
            <label for='nome' class='form-label'>Curso:</label>
            <input type='text' id='nome' name='nome' class='form-control' value="" required>
        </div>

        <div class='mb-3'>
            <label for='instituicao' class='form-label'>Instituicao:</label>
            <input type='text' id='instituicao' name='instituicao' class='form-control' value="" required>
        </div>

        <div class='mb-3'>
            <label for='nivel' class='form-label'>Nível:</label>
            <input type='text' id='nivel' name='nivel' class='form-control' value="" required>
        </div>

        <div class='mb-3'>
            <label for='data_inicio' class='form-label'>Data de início:</label>
            <input type='date' id='data_inicio' name='data_inicio' class='form-control' value="" required>
        </div>

        <div class='mb-3'>
            <label for='conclusao' class='form-label'>Curso:</label>
            <input type='date' id='conclusao' name='conclusao' class='form-control' value="" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label file btn btn-outline-success" for="nova_imagem">Escolha uma nova imagem:</label><br>
            <input type="file" class="btn btn-primary btn-sm" id="nova_imagem" name="nova_imagem" accept="image/*">
            <input type="hidden" id="imagem_atual" name="imagem_atual" value="">
        </div>
        <?php if (!empty($redes['imagem'])): ?>
            <div class="mb-3">
                <img src="" alt="Imagem atual" class="img-thumbnail" style="max-width: 200px;">
            </div>
        <?php endif; ?>

        <div class='d-flex justify-content-between'>
            <button type='submit' name='submit' class='btn btn-primary'>Atualizar</button>
            <a href='<?php echo INCLUDE_PATH ?>perfil?usuario_edit=formacao&id=<?php echo $_SESSION['id'] ?>' class='btn btn-secondary'>Voltar</a>
            <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal'>Excluir</button>
        </div>
    </form>
    <!--form-->

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
                    <form action='delete_formacao.php' method='post'>
                        <input type='hidden' name='id' value="<?php echo $formacao['id']; ?>">
                        <button type='submit' name='delete' class='btn btn-danger'>Excluir</button>
                    </form>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- Modal -->
    <!-- Modal -->
</div><!--container-->