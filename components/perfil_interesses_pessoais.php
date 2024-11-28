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
                        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
                                <?php foreach ($interesses as $interesse) { ?>
                                <div class="col h-25">
                                                <!--cards-->
                                                <div class="card mb-2 card-cover overflow-hidden text-bg-dark rounded-4 shadow-lg" style="height: 260px;background-image: url('<?php echo htmlspecialchars($interesse['imagem']) ?? $imagem ?>');">
                                                        <div class="d-flex flex-column align-items-start justify-content-center h-100 p-3 text-white text-shadow-1">
                                                                <h3 class="mb-4 display-6 lh-1 fw-bold"><?php echo htmlspecialchars($interesse['nome']) ?></h3>
                                                                <p><?php echo htmlspecialchars($interesse['descricao']) ?></p>
                                                        </div><!--card-body-->
                                                </div><!--card-->
                                        </div><!--col-->
                                        <?php } ?>
                        </div><!--row-->
                        <!--cards-->
                <?php

                }
                ?>
        </div><!--container-->
</div><!--page-->
<!--Interesses Pessoais-->