<header class="navbar shadow flex-md-nowrap px-3 py-3 " data-bs-theme="dark">

    <a class="fs-6 text-white" href="<?php echo INCLUDE_PATH_PAINEL ?>">
        <img src="<?php echo URL_STATIC ?>images/logo_black-recort.png" alt="Logomarca Aldomar Assolin" width="100">
    </a>


    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
                <svg class="bi">
                    <use xlink:href="#search" />
                </svg>
            </button>
        </li>
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <svg class="bi">
                    <use xlink:href="#list" />
                </svg>
            </button>
        </li>
    </ul>
    <div id="navbarSearch" class="navbar-search w-100 collapse">
        <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div>
    <div class="col-4 text-center">
        <a class="link-secondary text-decoration-none" href="<?php echo INCLUDE_PATH ?>">Blog</a>
    </div>

</header>