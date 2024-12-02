<?php


// Pega o ID do autor através de $_GET
$id = $_GET['id'] ?? $_SESSION['id'];
// Chama a função listarArtigosAutor para pegar os artigos do autor selecionado
$artigos = Artigos::listarArtigosAutor($id);

$url = INCLUDE_PATH_PAINEL . 'lista_artigos_autor?id=' . $id;

// Ativar artigo
if (isset($_POST['acao'])) {

    if ($_POST['id'] == 0) {
        echo Painel::alert('erro', 'Erro ao ativar o artigo. Tente novamente.');
    }
    $id = $_POST['id'];
    $artigo = new Artigos();
    if ($artigo->ativarArtigo($id)) {
        echo Painel::alert('sucesso', 'Artigo ativado com sucesso!');
    } else {
        echo Painel::alert('sucesso', 'Sucesso ao ativar o artigo.');
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

$artigos = Artigos::listarArtigosAutor($_GET['id']);  // Chama a função para pegar os artigos


// Título da página
$titulo = $artigos == false ? 'Nenhum artigo encontrado' : '<span class="lead fs-3 h2 ls-5">Lista de Artigos de</span> <b>' . $artigos[0]['nome_completo'] . '</b>';

?>


<section class="list-user mx-md-3">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0"><?php echo $titulo ?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand">
        <ul class="w-100 navbar-nav justify-content-end px-2">
            <li class="nav-item">
                <a class="btn btn-sm btn-success" aria-current="page" href="cadastrar_artigo">Cadastrar</a>
            </li>
        </ul>
    </nav>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr class="table-success">
                    <td>Autor</td>
                    <td>Título</td>
                    <td>Data</td>
                    <td class='text-end'>Ações</td>
                </tr>
            </thead>
            <tbody>
                <?php

                // Itera sobre os artigos do autor
                foreach ($artigos as $key => $value) {
                    
                    if ($value['id'] == $_GET['id']) {
                ?>

                        <tr>
                            <td class='align-bottom'>
                                <img src="<?php echo htmlspecialchars($value['avatar']) ?? INCLUDE_PATH . 'static/uploads/avatar.jpg'; ?>" alt="Imagem do perfil" width="24" height="24" class="rounded-circle mx-2">
                                <span class="fs-6"><?php echo htmlspecialchars($value['nome_completo']); ?></span>
                            </td> <!-- Nome do autor do artigo -->
                            <td class='align-bottom'><?php echo $value['titulo']; ?></td> <!-- Título do artigo -->
                            <td class='align-bottom'><?php echo date('d/m/Y', strtotime($value['data_criacao'])); ?></td> <!-- Data de criação formatada -->
                            <td class='align-bottom'>
                                <!-- Botão para editar artigo -->
                                <a title="Atualizar artigo" href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_artigos?id=<?php echo $value['artigo_id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                                    <svg class='bi'>
                                        <use xlink:href='#pencil' />
                                    </svg>
                                </a>

                                <?php
                                if ($value['status'] == 1) {
                                ?>
                                    <!-- Botão para excluir artigo -->
                                    <button title="Desativar artigo" type='button' class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-artigo-id=<?php echo $value['artigo_id']; ?>>
                                        <i class="bi-file-earmark-excel"></i>
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <!-- Botão para ativar artigo -->
                                    <!-- Botão para ativar artigo -->
                                    <form method="post">
                                        <input type="hidden" name="id" value="<?php echo $value['artigo_id']; ?>">
                                        <button title="Ativar artigo" type="submit" name="acao" value="ativar" class="btn btn-sm btn-success">
                                            <i class="bi bi-file-earmark-check"></i>
                                        </button>
                                    </form>

                                <?php
                                }
                                ?>
                            </td>
                        </tr>

                <?php
                    }
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