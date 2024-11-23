
<!--card sobre mim -->
<div class="px-4 border-bottom">
    <h1 class="display-6 fw-bold text-body-emphasis">Sobre mim</h1>
    <div class="mx-auto">
        <p class="lead mb-4 text-justify"><?php echo $perfil['sobre'] ?></p>
    </div>
    <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
            <img src="<?php echo $perfil['capa'] ?? $capa ?>" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
        </div>
    </div>
</div>
<!--card sobre mim -->