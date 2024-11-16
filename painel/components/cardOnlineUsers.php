


<section class="online-users my-3 bg-body-tertiary shadow">
    <div class="p-2">
        <h6 class="d-flex justify-content-start align-items-center mt-4 mb-3 text-body-secondary border-bottom">
            <svg class="bi">
                <use xlink:href="#webcam" />
            </svg>
            <span class="mx-2 lead">Usuários Online no Site</span>
        </h6>
        <table class="table my-3">
            <thead>
                <tr class="table-success">
                    <th scope="col">IP</th>
                    <th scope="col" class="text-end">Últimas Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
            foreach ($usuariosOnline as $key => $value) {
            ?>
                <tr>
                    <th scope="row"><?php echo $value['ip'] ?></th>
                    <td class="text-end"><?php echo date('d/m/Y H:i:s', strtotime($value['ultima_acao'])) ?></td>
                </tr>
            <?php
            }
            ?>
                
            </tbody>
        </table>

    </div>
</section>