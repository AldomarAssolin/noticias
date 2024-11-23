<?php
//Exibe alerta de sucesso ou erro ao excluir categoria 
if (isset($_POST['ativar_usuario'])) {
    $usuario_id = intval($_POST['ativar_usuario']); // Converte para inteiro para evitar injeção SQL
    $usuario = new Usuario();
    if ($usuario->ativarUsuario($usuario_id)) {
        echo Painel::alert('sucesso', 'Usuário excluído com sucesso!');
        // Atualiza a lista de usuários online
        $totalUsuariosCadastrados = Usuario::listarUsuariosCadastrados();
    } else {
        echo Painel::alert('erro', 'Erro ao excluir o usuário. Tente novamente.');
    }
}
?>

<section class="online-users my-3 bg-body-tertiary shadow">
    <div class="p-2">
        <h6 class="d-flex justify-content-start align-items-center mt-4 mb-3 text-body-secondary border-bottom">
            <svg class="bi">
                <use xlink:href="#people" />
            </svg>
            <span class="mx-2 lead">Usuários Desativados</span>
        </h6>
        <table class="table my-3">
            <thead>
                <tr class="table-success">
                    <th scope="col">Nome</th>
                    <th scope="col" class="text-end">Cargo</th>
                    <th scope="col" class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($usuariosDesativados as $key => $value) {

                ?>
                    <input type="hidden" name="id" value="<?php echo $value['id'] ?>">

                    <tr>
                        <th scope="row">
                            <?php echo $value['email'] ?>
                        </th>
                        <td class="text-end"><?php echo Painel::$cargos[$value['cargo']] ?></td>
                        <td class='text-end'>
                            <a title="Ver artigos do usuário" href="<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos_autor?id=<?php echo $value['id'] ?>" class='btn btn-primary btn-sm my-1 my-md-0  <?php echo $disable ?>'>
                                <svg class='bi'>
                                    <use xlink:href='#folder-symlink-fill' />
                                </svg>
                            </a>
                            <a title="Atualizar usuário" href="<?php echo INCLUDE_PATH_PAINEL ?>atualizar_usuario?id=<?php echo  $value['id'] ?>" class='btn btn-warning btn-sm my-1 my-md-0 mx-lg-2'>
                                <svg class='bi'>
                                    <use xlink:href='#pencil' />
                                </svg>
                            </a>
                            <!-- Botão para ativar usuario -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmActiveModal" data-id="<?php echo htmlspecialchars($value['id']); ?>">
                                <i class="bi bi-person-check-fill"></i>
                            </button>
                        </td><!--acoes-->
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Modal -->
<div class='modal fade' id='confirmActiveModal' tabindex='-1' aria-labelledby='confirmDeleteModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='confirmDeleteModalLabel'>Confirmar Ativação</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                Tem certeza que deseja excluir este usuário?
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                <form method='post'>
                    <input type='hidden' name='ativar_usuario' id="buttonIdToActive">
                    <button type='submit' class='btn btn-success'>Ativar</button>
                </form>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- Modal -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var confirmDeleteModal = document.getElementById('confirmActiveModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-id');
            var modalUserIdInput = document.getElementById('buttonIdToActive');
            modalUserIdInput.value = userId;
        });
    });
</script>