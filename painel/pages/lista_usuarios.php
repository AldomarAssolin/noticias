<!--

Lista de usuários com quantidade de artigos/noticias/posts escritos
botões para acessar lista de artigos do usuario, editar usuario e excluir usuario

-->

<?php

$mensagem = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    switch ($_POST) {
        case isset($_POST['usuario_delete']):
            $id = (int)$_POST['usuario_delete'];
            Usuario::desativarUsuario($id);
            $mensagem .= Painel::alert('sucesso', 'Usuário desativado com sucesso!');
            break;
        case isset($_POST['usuario_ativar']):
            $id = (int)$_POST['usuario_ativar'];
            Usuario::ativarUsuario($id);
            $mensagem .= Painel::alert('sucesso', 'Usuário reativado com sucesso!');
            break;
        case isset($_POST['usuario_cargo']):
            $id = (int)$_POST['usuario_cargo'];
            if(Usuario::atualizarCargo($_POST['cargo'], $id)){
                $mensagem .= Painel::alert('sucesso', 'Cargo do usuário atualizado com sucesso!');
            } else {
                $mensagem .= Painel::alert('erro', 'Erro ao atualizar cargo do usuário!');
            }
            break;
        default:
            $mensagem .= Painel::alert('erro', 'Erro ao executar ação!');
            break;
    }
    
}

$totalUsuariosCadastrados = Usuario::buscarTodosUsuarios();
?>

<section class="list-user mx-md-3">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 mb-0">Lista de Usuários</h1>
    </div>

    <?php echo $mensagem; ?>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Cargo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($totalUsuariosCadastrados as $usuario): ?>
                <tr>
                    <td class="align-bottom pb-2">
                        <div class="d-md-flex">
                            <div class="text-center"><img src="<?php echo htmlspecialchars($usuario['avatar']) ?>" class="rounded-circle me-2" alt="avatar" width="32" height="32"></div>
                            <div class="PT-2"><?php echo htmlspecialchars(ucfirst($usuario['nome_completo'] ?? $usuario['email'])) ?></div>
                        </div>
                    </td>
                    <td class="align-bottom pb-2">
                        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#confirmAtualizaCargoModal" data-cargo='<?php echo $usuario['cargo'] ?>' data-usuario-id="<?php echo $usuario['id'] ?>" title="Atualizar cargo do autor">
                            <span class="fst-italic"><?php echo htmlspecialchars(ucfirst(Painel::$cargos[$usuario['cargo']])) ?></span>
                            <i class="bi bi-person-rolodex"></i>
                        </button>
                    </td>
                    <td class="align-bottom pb-2">
                        <a href="<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos_autor?id=<?php echo $usuario['id']; ?>" class="btn btn-outline-primary btn-sm me-1" title="Ver artigos do autor">
                            <i class="bi bi-folder-symlink"></i>
                        </a>
                        <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=editar&id=<?php echo $usuario['id'] ?>" class="btn btn-outline-warning btn-sm me-1" title="Editar artigos do autor">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <?php if ($usuario['status'] == 1): ?>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-usuario-id="<?php echo $usuario['id'] ?>" title="Desativar usuário">
                            <i class="bi bi-file-earmark-excel"></i>
                        </button>
                        <?php else: ?>
                        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmAtiveModal" data-usuario-id="<?php echo $usuario['id'] ?>" title="Reativar usuário">
                            <i class="bi bi-file-earmark-check"></i>
                        </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


<!-- <section class="list-user mx-md-3">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0">Lista de Usuários</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>
    <div class="">
        <?php
        $totalUsuariosCadastrados = Usuario::buscarTodosUsuarios();
        echo $mensagem;
        foreach ($totalUsuariosCadastrados as $key => $value) {

        ?>


            <div class="d-flex text-body-secondary pt-3 border-bottom">
                <div class="row w-100">
                    <div class="col-md-6 d-flex align-items-end justify-content-between pb-2">
                        <div class="d-flex align-items-end">
                            <img src="<?php echo htmlspecialchars($value['avatar']) ?>" class="rounded-circle" alt="logo" width="32" height="32">
                            <strong class="d-block text-gray-dark text-start mx-2 "><?php echo htmlspecialchars(ucfirst($value['nome_completo'] ?? $value['email'])) ?></strong>
                        </div>
                        <p class="mb-0 small lh-sm">
                            <button type="button" class="btn btn-outline-info btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#confirmAtualizaCargoModal" data-cargo='<?php echo $value['cargo'] ?>' data-usuario-id="<?php echo $value['id'] ?>" title="Atualizar cargo do autor">
                                <span class="fst-italic"><?php echo htmlspecialchars(ucfirst(Painel::$cargos[$value['cargo']])) ?></span>
                                <i class="bi bi-person-rolodex"></i>
                            </button>
                        </p>
                    </div>
                    <div class="col-md-6 d-flex align-items-end justify-content-around justify-md-content-end p-2 pb-md-2 mt-2 mt-md-0">
                        <a href="<?php echo INCLUDE_PATH ?>artigos?usuario_id=<?php echo $value['id'] ?>" class="btn btn-outline-primary btn-sm me-1" title="Ver artigos do autor">
                            <i class="bi bi-folder-symlink"></i>
                        </a>
                        <a href="<?php echo INCLUDE_PATH ?>perfil?usuario_edit=editar&id=<?php echo $value['id'] ?>" class="btn btn-outline-warning btn-sm me-1" title="Editar artigos do autor">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <?php if ($value['status'] == 1) { ?>
                            <button type="button" class="btn btn-outline-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-usuario-id="<?php echo $value['id'] ?>" title="Excluir artigos do autor">
                                <i class="bi bi-file-earmark-excel"></i>
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-outline-success btn-sm me-1" data-bs-toggle="modal" data-bs-target="#confirmAtiveModal" data-usuario-id="<?php echo $value['id'] ?>" title="Excluir artigos do autor">
                                <i class="bi bi-file-earmark-check"></i>
                            </button>
                        <?php } ?>
                    </div>col-4
                </div>row
            </div>d-flex
        <?php } ?>

    </div>
</section> -->

<!-- Modal de desativar usuario -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja desativar este usuário?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="" method="post">
                    <input type="hidden" id="confirmDeleteBtn" name="usuario_delete">
                    <button class="btn btn-danger">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de reativação de usuário -->
<div class="modal fade" id="confirmAtiveModal" tabindex="-1" aria-labelledby="confirmAtiveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmAtiveModalLabel">Confirmar Reativação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja reativar este usuário?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="" method="post">
                    <input type="hidden" id="confirmAtiveBtn" name="usuario_ativar">
                    <button class="btn btn-success">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de edição do cargo -->
<div class="modal fade" id="confirmAtualizaCargoModal" tabindex="-1" aria-labelledby="confirmAtualizaCargoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmAtualizaCargoModalLabel">Confirmar Cargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo:</label>
                        <select class="form-select" id="cargo" name="cargo">
                            <?php
                            foreach (Painel::$cargos as $key => $value) {
                                echo "<option value='$key'>$value</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <input type="hidden" id="confirmAtualizaCargoBtn" name="usuario_cargo">
                    <button class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('confirmDeleteModal').addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var usuarioId = button.getAttribute('data-usuario-id');
        var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.value = usuarioId;
    });
    document.getElementById('confirmAtiveModal').addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var usuarioId = button.getAttribute('data-usuario-id');
        var confirmDeleteBtn = document.getElementById('confirmAtiveBtn');
        confirmDeleteBtn.value = usuarioId;
    });
    document.getElementById('confirmAtualizaCargoModal').addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var usuarioId = button.getAttribute('data-usuario-id');
        var cargo = button.getAttribute('data-cargo');
        console.log(cargo);
        var cargoSelect = document.getElementById('cargo');
        cargoSelect.value = cargo;
        var confirmDeleteBtn = document.getElementById('confirmAtualizaCargoBtn');
        confirmDeleteBtn.value = usuarioId;
    });
</script>
