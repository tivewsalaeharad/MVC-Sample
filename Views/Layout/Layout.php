<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Обо мне</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="/Css/style_layout.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Тестовое задание</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="/home">Обо мне</a>
                <a class="p-2 text-dark" href="/portfolio">Портфолио</a>
                <a class="p-2 text-dark" href="/blog">Блог</a>
                <a class="p-2 text-dark" href="/task">Задача</a>
            </nav>
        </header>
        <main class="container">
            <?= $body ?>
        </main>
    </body>
</html>
