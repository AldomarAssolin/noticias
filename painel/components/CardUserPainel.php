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
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach($totalUsuariosCadastrados as $key => $value) {
                
                ?>
                <tr>
                    <th scope="row"><?php echo $value['nome']?></th>
                    <td class="text-end"><?php echo $value['cargo']?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>