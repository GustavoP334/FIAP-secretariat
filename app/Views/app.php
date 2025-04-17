<!DOCTYPE html>
<html lang="pt-br">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?? 'Sem título' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/public/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/main.css">
</head>
<body>
<header>
    <?php 
        require_once __DIR__ . '/nav/navbar.php';
    ?>
</header>

<main>
    <?php if (isset($_SESSION['response'])): ?>
        <?php $response = $_SESSION['response']; unset($_SESSION['response']); ?>
        <div class="position-fixed top-10 end-0 p-3" style="z-index: 1050;">
            <div class="alert alert-<?= $response['Status'] === 'Success' ? 'success' : 'danger' ?> alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($response['Message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="container-fluid px-3 py-4">
        <div class="bg-light shadow-sm rounded p-4">
            <?= $content ?>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<?= isset($script) ? '<script src="/public/js/' . $script . '"></script>' : '' ?>
<script src="/public/js/main.js"></script>
</body>
</html>
