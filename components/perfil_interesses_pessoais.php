<!--Interesses Pessoais-->
<div class="mt-3">
        <div class="card">
                <div class="card-header">
                        <h2 class="card-title py-2">Interesses Pessoais</h2>
                </div>
        </div>
        <div class="container px-4 py-5" id="custom-cards">
                <?php

                $imagem = INCLUDE_PATH . 'static/uploads/astronomia.jpeg';

                $interesses = Perfil::getInteresses($id);
                $areaInteresse = [];

                foreach ($interesses as $interesse) {
                        $area = $interesse['area'];
                        $nome = $interesse['nome'];
                        $descricao = $interesse['descricao'];
                        $imagem = $interesse['imagem'];

                        if (!isset($areaInteresse[$area])) {
                                $areaInteresse[$area] = [];
                        }

                        $areaInteresse[$area][] = [
                                'nome' => $nome,
                                'descricao' => $descricao,
                                'imagem' => $imagem
                        ];
                }

                foreach ($areaInteresse as $area => $interesses) {

                ?>
                        <h2 class="py-2 border-bottom"><?php echo htmlspecialchars($area) ?></h2>
                        <ul class="">
                                <?php foreach ($interesses as $interesse) { ?>
                                        <li class="d-flex text-body-secondary pt-3 border-bottom">
                                                <div class="row w-100">
                                                        <div class="col-12 d-flex alisn-items-end pb-2">
                                                                <img src="<?php echo htmlspecialchars($interesse['imagem']) ?? $imagem ?>" alt="<?php echo htmlspecialchars($interesse['nome']) ?>" width="48" height="48">
                                                                <p class="mb-0 small lh-sm px-3 d-flex flex-column align-items-start justify-content-end ">
                                                                        <strong class="d-block text-gray-dark text-start"><?php echo htmlspecialchars($interesse['nome']) ?></strong>
                                                                        <?php echo htmlspecialchars($interesse['descricao']) ?>
                                                                </p>
                                                        </div><!--col-8-->
                                                </div><!--row-->
                                </li><!--d-flex-->
                                <?php } ?>
                                </ul><!--row-->
                        <!--cards-->
                <?php

                }
                ?>
        </div><!--container-->
</div><!--page-->
<!--Interesses Pessoais-->