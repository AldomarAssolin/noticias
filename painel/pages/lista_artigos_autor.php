<?php

// Pega o ID do autor através de $_GET
$id = $_GET['id'];  // Aqui o ID do autor é passado pela URL (lista de usuários)

// Chama a função listarArtigosAutor para pegar os artigos do autor selecionado
$artigos = Artigos::listarArtigosAutor($id);


$titulo = $artigos == false ? 'Nenhum artigo encontrado' : '<span class="lead fs-3 h2 ls-5">Lista de Artigos de</span> <b>' . $artigos[0]['nome'] . '</b>'; // Título da página

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

                //var_dump($artigos);
                // Itera sobre os artigos do autor
                foreach ($artigos as $key => $value) {

                ?>

                    <tr>
                        <td>
                        <img src="<?php echo htmlspecialchars($value['img']); ?>" alt="Imagem do perfil" width="24" height="24" class="rounded-circle mx-2">
                        </td> <!-- Nome do autor do artigo -->
                        <td><?php echo $value['titulo']; ?></td> <!-- Título do artigo -->
                        <td><?php echo date('d/m/Y', strtotime($value['data_criacao'])); ?></td> <!-- Data de criação formatada -->
                        <td class='text-end'>
                            <!-- Botão para editar artigo -->
                            <a href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_artigos?id=<?php echo $id; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                                <svg class='bi'>
                                    <use xlink:href='#pencil' />
                                </svg>
                            </a>
                            <!-- Botão para excluir artigo -->
                            <a href='<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos_autor?excluir=<?php echo $id; ?>' class="btn btn-danger btn-sm my-1 my-md-0">
                                <svg class='bi'>
                                    <use xlink:href='#trash' />
                                </svg>
                            </a>
                        </td>
                    </tr>

                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</section>