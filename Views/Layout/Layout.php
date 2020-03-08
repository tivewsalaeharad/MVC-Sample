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
        <div id="incorrectEMailModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: red;">Ошибка</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id = "errorText" style="color: red;"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="successfullyAdded" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Новая задача</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Новая задача успешно добавлена</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Тестовое задание</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="/">Перечень задач</a>
                <a class="p-2 text-dark" href="/newTask">Новая задача</a>
                <?php if (isset($_SESSION['logged_user'])) : ?>
                    <a class="p-2 text-dark" href="/logout">Выйти</a>
                <?php else : ?>
                    <a class="p-2 text-dark" href="/login">Войти</a>
                <?php endif; ?>
                <a class="p-2 text-dark" href="/task">Задача</a>
            </nav>
        </header>
        <main class="container">
            <?= $body ?>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#newTaksForm').submit(function (e) {
                    var errors = '';
                    if ($('#newTaskUserName').val() == '') {
                        errors += 'Заполните имя пользователя<br>';
                    }
                    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#newTaskEMail').val())) {
                        errors += 'Введите правильный адрес электронной почты<br>';
                    }
                    if ($('#newTaskDetails').val() == '') {
                        errors += 'Заполните текст задачи<br>';
                    }
                    if (errors == '') return true;
                    $('#errorText').html(errors);
                    $('#incorrectEMailModal').modal({show: true});
                    e.preventDefault();
                });
            });

            function sortPaginationSwitch(column, direction, page) {
                window.location.href = `/home/index/${column}/${direction}/${page}`;
            }
        </script>
    </body>
</html>
