

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 - Página não encontrada</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .container {
                text-align: center;
                padding: 50px;
            }
            .error-code {
                font-size: 96px;
                font-weight: bold;
            }
            .error-message {
                font-size: 24px;
                margin-bottom: 20px;
            }
            .btn-primary {
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="error-code">404</div>
            <div class="error-message">Página não encontrada</div>
            <p>A página que você está procurando não existe.</p>
            <a href="<?php echo INCLUDE_PATH?>" class="btn btn-primary">Voltar para a Home</a>
        </div>
    </body>
    </html>
