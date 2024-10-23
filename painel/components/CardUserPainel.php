<section class="online-users my-3 bg-body-tertiary shadow">
    <div class="p-2">
        <h6 class="d-flex justify-content-start align-items-center mt-4 mb-3 text-body-secondary border-bottom">
            <svg class="bi">
                <use xlink:href="#people" />
            </svg>
            <span class="mx-2 lead">Usuários do Painel</span>
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

                foreach ($totalUsuariosCadastrados as $key => $value) {

                ?>
                <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                
                    <tr>
                        <th scope="row">
                            <img src="<?php echo $value['img'] ?>" alt="Imagem Perfil" width="24" height="24" class="rounded-circle img-thumbnail mx-2">
                            <?php echo $value['nome'] ?>
                        </th>
                        <td class="text-end"><?php echo $value['cargo'] ?></td>
                        <td class='text-end'>
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>lista_artigos_autor?id=<?php echo $value['id'] ?>" class='btn btn-primary btn-sm my-1 my-md-0'>
                                <svg class='bi'>
                                    <use xlink:href='#folder-symlink-fill' />
                                </svg>
                            </a>
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>atualizar_usuario?id=<?php echo  $value['id'] ?>" class='btn btn-warning btn-sm my-1 my-md-0 mx-lg-2'>
                                <svg class='bi'>
                                    <use xlink:href='#pencil' />
                                </svg>
                            </a>
                            <a href="<?php echo INCLUDE_PATH_PAINEL ?>" class='btn btn-danger btn-sm my-1 my-md-0'>
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