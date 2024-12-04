<?php
//Objetivo: Exibir os usuários cadastrados no painel
// Lógica para exclusão
if (isset($_POST['excluir_usuario'])) {
    $usuario_id = intval($_POST['excluir_usuario']); // Converte para inteiro para evitar injeção SQL
    $usuario = new Usuario();
    if ($usuario->desativarUsuario($usuario_id)) {
        echo Painel::alert('sucesso', 'Usuário excluído com sucesso!');
        // Atualiza a lista de usuários online
    } else {
        echo Painel::alert('sucesso', 'Sucesso ao excluir o usuário.');
    }
}
// Retorna lista usuários cadastrados após a exclusão
$totalUsuariosCadastrados = Usuario::listarUsuariosCadastrados(1);

?>

<section class="online-users my-3 bg-body-tertiary shadow">
    <div class="p-2">
        <h6 class="d-flex justify-content-start align-items-center mt-4 mb-3 text-body-secondary border-bottom">
            <svg class="bi">
                <use xlink:href="#people" />
            </svg>
            <span class="mx-2 lead">Usuários do Cadastrados no site</span>
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
                // Exibe os usuários cadastrados
                foreach ($totalUsuariosCadastrados as $value) {
                    // Verifica se o usuário possui artigos
                    $artigos = Artigos::listarArtigos();
                    foreach ($artigos as $artigo) {
                        if ($artigo['usuario_id'] == $value['id']) {
                            $artigos = $value['id'];
                            break;
                        } else {
                            $artigos = 0;
                        }
                    }
                    
                    
                    // Desativa botao de ver artigos caso o usuário não possua artigos
                    if($artigos == 0){
                        $disabled = 'disabled';
                    } else {
                        $disabled = '';
                    }

                    var_dump($value['avatar']);

                ?>
                    <tr>
                        <th scope="row">
                            <img src="<?php echo htmlspecialchars($value['avatar'] ?? BASE_DIR . 'static/uploads/avatar.jpg'); ?>" alt="Imagem do perfil" width="24" height="24" class="rounded-circle mx-2 <?php echo $value['logado'] == 1 ? 'border border-2 border-success' : '' ?>">
                            <?php echo htmlspecialchars($value['nome_completo'] ?? $value['email']); ?>
                        </th>
                        <td class="text-end"><?php echo htmlspecialchars(Painel::$cargos[$value['cargo']]); ?></td>
                        <td class='text-end'>
                            <!-- Botão para ver artigos do usuário -->
                            <a title="Ver artigos do usuário" href="<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos_autor?id=<?php echo urlencode($value['id']); ?>" class='btn btn-primary btn-sm my-1 my-md-0 <?php echo $disabled ?>'>
                                <svg class='bi'>
                                    <use xlink:href='#folder-symlink-fill' />
                                </svg>
                            </a>
                            <!-- Botão para atualizar usuario -->
                            <a title="Atualizar usuário" href="<?php echo INCLUDE_PATH_PAINEL ?>atualizar_usuario?id=<?php echo urlencode($value['id']); ?>" class='btn btn-warning btn-sm my-1 my-md-0 mx-lg-2'>
                                <svg class='bi'>
                                    <use xlink:href='#pencil' />
                                </svg>
                            </a>
                            <!-- Botão para excluir usuario -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo htmlspecialchars($value['id']); ?>">
                                <i class="bi bi-person-dash-fill"></i>
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
<div class='modal fade' id='confirmDeleteModal' tabindex='-1' aria-labelledby='confirmDeleteModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='confirmDeleteModalLabel'>Confirmar Exclusão</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                Tem certeza que deseja excluir este usuário?
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                <form method='post'>
                    <input type='hidden' name='excluir_usuario' id="buttonIdToDelete">
                    <button type='submit' class='btn btn-danger'>Excluir</button>
                </form>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- Modal -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-id');
            var modalUserIdInput = document.getElementById('buttonIdToDelete');
            modalUserIdInput.value = userId;
        });
    });
</script>