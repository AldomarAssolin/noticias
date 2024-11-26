<?php
// Objetivo do componente: Listar os artigos do usuário logado
// Busca os artigos do usuário logado

$nome = Perfil::getFindById($_SESSION['id']);
$mensagem = '';

// Ativar artigo
if (isset($_POST['acao'])) {

    if ($_POST['acao'] == 'ativar') {
        if ($_POST['id'] == 0) {
            $mensagem .= Painel::alert('erro', 'Erro ao ativar o artigo. Tente novamente.');
        }
        $id = $_POST['id'];
        $artigo = new Artigos();
        if ($artigo->ativarArtigo($id)) {
            $mensagem .= Painel::alert('sucesso', 'Artigo ativado com sucesso!');
        } else {
            $mensagem .= Painel::alert('sucesso', 'Sucesso ao ativar o artigo!');
        }
    }
}

//Excluir artigo
//A exclusão consiste em atualizar o extatus do artigo.
if (isset($_POST['delete_artigo'])) {
    if ($_POST['delete_artigo'] == 0) {
        $mensagem .= Painel::alert('sucesso', 'Sucesso ao excluir o artigo. Tente novamente.');
    }
    $id_artigo = $_POST['delete_artigo'];
    $artigo = new Artigos();
    if ($artigo->deletarArtigo($id_artigo)) {
        $mensagem .= Painel::alert('sucesso', 'Artigo excluído com sucesso!');
        $artigo = Artigos::pegarArtigo($id_artigo);
    }
}

?>

<div class="container mt-5">
    <?php echo $mensagem; ?>
    <nav class="navbar navbar-expand">
        <div class="row w-100 alig-items-center">
            <div class="col-8">
                <h4>Lista de artigos</h4>
            </div><!-- col -->
            <div class="col-4">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item">
                        <a class="btn btn-sm btn-success" aria-current="page" href="cadastrar_artigo">Cadastrar</a>
                    </li>
                </ul>
            </div>
        </div><!-- row -->
    </nav>
    <?php
    $artigos = Artigos::findByAutorId($_SESSION['id']);
    //var_dump($artigos);
    // Se não houver artigos cadastrados, exibe mensagem
    if ($artigos == false) {
    ?>
        <div class="alert alert-warning">
            <h4 class="alert-heading">Olá <?php echo $nome ?? $_SESSION['user'] ?></h4>
            <p>Você ainda não tem artigos cadastrados.</p>
            <hr>
        </div>
    <?php
    } else {
    ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Data Criação</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count(array($artigos)) > 1) {
                    foreach ($artigos as $artigo) {

                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($artigo['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($artigo['data_criacao']); ?></td>
                            <td class="text-end">
                                <!-- Botão para editar artigo -->
                                <a href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_artigo?id=<?php echo $artigo['id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                                    <svg class='bi'>
                                        <use xlink:href='#pencil' />
                                    </svg>
                                </a>
                                <!-- Botão para excluir artigo -->
                                <button type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-artigo-id=<?php echo $artigos['id']; ?>>
                                    <svg class='bi'>
                                        <use xlink:href='#trash' />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($artigos['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($artigos['data_criacao']); ?></td>
                        <td class='d-flex justify-content-end'>
                            <!-- Botão para editar artigo -->
                            <a href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_artigos?id=<?php echo $artigos['id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                                <svg class='bi'>
                                    <use xlink:href='#pencil' />
                                </svg>
                            </a>
                            <?php
                            if ($artigos['status'] == 1) {
                            ?>
                                <!-- Botão para excluir artigo -->
                                <button title="Desativar artigo" type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-artigo-id=<?php echo $artigos['id']; ?>>
                                    <i class="bi-file-earmark-excel"></i>
                                </button>
                            <?php
                            } else {

                            ?>
                                <!-- Botão para ativar artigo -->
                                <form method="post">
                                    <input type="hidden" name="id" value="<?php echo $artigos['id']; ?>">
                                    <button title="Ativar artigo" type="submit" name="acao" value="ativar" class="btn btn-sm btn-success">
                                        <i class="bi bi-file-earmark-check"></i>
                                    </button>
                                </form>

                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div><!-- container -->

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