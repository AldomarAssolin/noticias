<?php
// OBjetivo: Atualizar Cargo do Usuário

    $avatar = URL_STATIC . 'uploads/avatar.jpg';




    ?>

<section class="cadastrar-usuario">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0">Atualizar Usuário</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>

    <form method="post" enctype="multipart/form-data" class="row g-3 border rounded-1 m-0 p-2">
        <div class="col-12">
            <label for="inputAddress" class="form-label">Nome</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Digite seu nome" name="nome" value="<?php echo $value['nome'] ?>">
        </div>
        <div class="col-12">
            <label for="inputSelect" class="form-label">Cargo</label>
            <select class="form-select" aria-label="Default select example" id="inputSelect" name="cargo">
                <?php
                foreach (Painel::$cargos as $key => $val) {
                    if ($key <= $value['cargo']) echo '<option selected value="' . $key . '">' . $val . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group mb-2">
            <div class="form-group mb-3">
                <label class="form-label w-25 file btn btn-outline-success" for="imagem">Imagem</label><br>
                <input type="file" class="btn btn-primary btn-sm" id="imagem" name="imagem" accept="image/*">
                <input type="hidden" id="imagem_atual" name="imagem_atual" value="<?php echo $value['avatar'] ?>">
            </div>
            <?php if (!empty($redes['imagem'])): ?>
                <div class="mb-3">
                    <img src="" alt="Imagem atual" class="img-thumbnail" style="max-width: 200px;">
                </div>
            <?php endif; ?>
        </div>
        <div class="col-12">
            <input type="submit" class="btn btn-success" name="acao" value="Atualizar">
        </div>
    </form>
    </div>
    </div>
</section>