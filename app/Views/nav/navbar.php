<nav class="navbar navbar-expand-lg bg-black" style="z-index: 100;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/inicio">
            <img src="/storage/img/logo.jpg" width="100" height="54" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php
                $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= $path == '/alunos' ? 'active' : '' ?>" aria-current="page" href="/alunos">Alunos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path == '/turmas' ? 'active' : '' ?>"" aria-current="page" href="/turmas">Turmas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $path == '/matriculas' ? 'active' : '' ?>"" href="/matriculas">Matrículas</a>
                </li>
            </ul>
        </div>
    </div>
</nav>