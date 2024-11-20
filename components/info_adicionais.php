<!--nav-tabs-->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Sobre Mim</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Formação</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Interesses Pessoais</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" aria-disabled="true">Disabled</a>
    </li>
</ul>
<!--nav-tabs-->

<!--card sobre mim -->
<div class="card page mb-3">
    <div class="card-body">
        <div class="card-body">
            <h5 class="card-title">Sobre Mim</h5>
            <p class="card-text">
                <?php echo $perfil['sobre'] ?>
            </p>
        </div><!--sobre-mim-->
    </div><!--card-body-->
</div><!--card-->
<!--card sobre mim -->

<!--card formacao-->
<div class="card page mb-3">
    <div class="card-body">
        <h5 class="card-title">Formação</h5>

        <?php
        foreach ($formacao as $key => $value) {
        ?>
            <div class="card mb-3">
                <div class="row">
                    <div class="col-8">
                        <div class="card-header fs-6 fst-italic">
                            <?php echo $value['nivel'] ?>
                        </div>
                        <div class="card-body">
                            <p>
                                <?php echo $value['nome'] ?> -
                                <span class="text-info"><?php echo $value['instituicao'] ?></span>
                            </p>
                            <p>
                                <?php echo $value['cidade'] ?> - <?php echo $value['uf'] ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted fst-italic"><?php echo date('d/m/y', strtotime($value['data_inicio'])) ?> - <?php echo date('d/m/y', strtotime($value['conclusao'])) ?></small>
                        </div>
                    </div>
                    <div class="col-4">
                        <img src="<?php echo $value['logo'] ?>" class="card-img-top" alt="logo">
                    </div>
                </div><!--row-->
            </div><!--card-->

        <?php
        }
        ?>
    </div><!--formacao-->
</div><!--card-->
<!--card formacao-->

<!--Interesses Pessoais-->
<div class="card page mt-3">
    <div class="card-header">
        Interesses Pessoais
    </div><!--card-header-->
    <div class="card-body">
        <?php
        
        foreach ($interesses as $key => $value) {
            
        ?>
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="area"><?php echo $value['area'] ?></h4>
                </div>
                <div class="card-body mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $value['imagem'] ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $value['nome'] ?></h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div><!--card-body-->
</div><!--card-->
<!--Interesses Pessoais-->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-link');
        const pages = document.querySelectorAll('.page');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', function(event) {
                event.preventDefault();

                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                pages.forEach(page => page.style.display = 'none');
                pages[index].style.display = 'block';
            });
        });

        // Initialize the first tab and page as active
        tabs[0].classList.add('active');
        pages[0].style.display = 'block';
    });
</script>