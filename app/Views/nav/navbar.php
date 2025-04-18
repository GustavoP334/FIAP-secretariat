<nav class="navbar navbar-expand-lg bg-black" style="z-index: 100;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/inicio">
            <img src="/storage/img/logo.jpg" width="100" height="54" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $path == '/alunos' ? 'active' : '' ?>" href="/alunos">Alunos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path == '/turmas' ? 'active' : '' ?>" href="/turmas">Turmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path == '/matriculas' ? 'active' : '' ?>" href="/matriculas">Matrículas</a>
                </li>
            </ul>
            <?php if (isset($_SESSION['user'])): ?>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-center">
                        <li class="dropdown-item text-truncate" style="max-width: 200px;">
                            <?= htmlspecialchars($_SESSION['user']['name']) ?>
                        </li>
                        <li>
                            <form action="/logout" method="POST" class="m-0">
                                <button type="submit" class="dropdown-item d-flex justify-content-center align-items-center gap-2 text-danger">
                                    <i class="fa-solid fa-right-from-bracket"></i> Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>
