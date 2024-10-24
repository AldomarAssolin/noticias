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
                    <td >Ações</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $artigos = Artigos::listarArtigosComAutores();  // Chama a função para pegar os artigos

                if ($artigos) {  // Verifica se há artigos
                   
                ?>

                    <?php foreach ($artigos as $artigo) { ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($artigo['img']); ?>" alt="Imagem do perfil" width="24" height="24" class="rounded-circle mx-2">
                                <?php echo htmlspecialchars($artigo['autor']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($artigo['titulo']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($artigo['data_criacao'])); ?></td>
                            <td  class='text-end'>
                            <!-- Botão para editar artigo -->
                            <a href='<?php echo INCLUDE_PATH_PAINEL ?>atualizar_artigos?id=<?php echo $artigo['id']; ?>' class="btn btn-warning btn-sm my-1 my-md-0 mx-lg-2">
                                <svg class='bi'>
                                    <use xlink:href='#pencil' />
                                </svg>
                            </a>
                            <!-- Botão para excluir artigo -->
                            <a href='<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos_autor?excluir=<?php echo $artigo['id']; ?>' class="btn btn-danger btn-sm my-1 my-md-0">
                                <svg class='bi'>
                                    <use xlink:href='#trash' />
                                </svg>
                            </a>
                        </td>
                        </tr>
                    <?php } ?>

                <?php
                } else {
                    echo "Nenhum artigo encontrado.";
                }
                ?>

            </tbody>
        </table>
    </div>


</section>