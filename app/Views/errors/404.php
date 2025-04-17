<!DOCTYPE html>
<html lang="pt-br">
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Página Não encontrada</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="/public/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/public/css/main.css">
        <style>
            body {
                height: 100vh;
                background-color: #f8f9fa;
            }
            .error-container {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
                flex-direction: column;
                text-align: center;
            }
            .error-code {
                font-size: 8rem;
                font-weight: bold;
                color: #dc3545;
            }
            .error-message {
                font-size: 1.5rem;
                color: #6c757d;
            }
        </style>
    </head>
    <body>
        <header>
            <?php 
                require_once __DIR__ . '/../nav/navbar.php';
            ?>
        </header>
        <div class="container-fluid px-3 py-4">
            <div class="error-container">
                <div class="error-code">404</div>
                <div class="error-message mb-4">Oops! Página não encontrada.</div>
                <a href="/inicio" class="btn btn-primary">
                    Voltar para a página inicial
                </a>
            </div>
        </div>
    </body>
</html>