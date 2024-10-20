<div class="sidebar border border-right p-0 bg-body-tertiary">
  <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarMenuLabel">Aldomar Assolin</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>

    <section class="user shadow">
      <div class="d-flex flex-column align-items-center text-center p-3">
        <img class="rounded-circle" width="120" height="120" src="<?php echo URL_STATIC ?>/images/perfil.jpg" alt="Imagem do perfil">
        <div class="mt-3">
          <h4>Aldomar Assolin</h4>
          <p class="text-secondary mb-1">Administrador</p>
        </div>
      </div>
    </section>

    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
      <div class="nav-item px-3 py-2 shadow hover">
        <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="#">
          <svg class="bi">
            <use xlink:href="#house-fill" />
          </svg>
          Página Inicial
        </a>
      </div>

      <div class="accordion accordion-flush my-2" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>CADASTRO</span>
              </h6>
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body px-0">
              <ul class="nav flex-column">
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <svg class="bi">
                      <use xlink:href="#people" />
                    </svg>
                    Usuários
                  </a>
                </li>
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    Artigos
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>GESTÃO</span>
              </h6>
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body px-0">
              <ul class="nav flex-column">
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <svg class="bi">
                      <use xlink:href="#people" />
                    </svg>
                    Listar Usuários
                  </a>
                </li>
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    Listar Artigos
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>ADMINISTRAÇÃO</span>
              </h6>
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body px-0">
              <ul class="nav flex-column">
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <svg class="bi">
                      <use xlink:href="#people" />
                    </svg>
                    Editar Usuários
                  </a>
                </li>
                <li class="nav-item shadow">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <svg class="bi">
                      <use xlink:href="#file-earmark" />
                    </svg>
                    editar Artigos
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-3">

      <ul class="nav flex-column mb-auto">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi">
              <use xlink:href="#gear-wide-connected" />
            </svg>
            Settings
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi">
              <use xlink:href="#door-closed" />
            </svg>
            Sign out
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>