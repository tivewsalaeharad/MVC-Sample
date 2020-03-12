<?php
$column = $_SESSION['home_state']['column'];
$direction = $_SESSION['home_state']['direction'];
$page = $_SESSION['home_state']['page'];

$total_rows = count($params['data']);
$max_page = ceil($total_rows/3);
$admin = isset($_SESSION['logged_user']) && $_SESSION['logged_user']['login'] == 'admin';
?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col" style="width: 20%">
          Имя пользователя
          <button onclick="sortPaginationSwitch('user_name',
          '<?=$column=='user_name'&&$direction=='ASC'?'DESC':'ASC'?>', <?=$page?>);">
              <span>
                  <img src="/Images/<?=$column=='user_name'?$direction:'nosort'?>.svg">
              </span>
          </button>
      </th>
      <th scope="col" style="width: 15%">
          E-mail
          <button onclick="sortPaginationSwitch('email',
          '<?=$column=='email'&&$direction=='ASC'?'DESC':'ASC'?>', <?=$page?>);">
              <span>
                  <img src="/Images/<?=$column=='email'?$direction:'nosort'?>.svg">
              </span>
          </button>
      </th>
      <th scope="col" style="width: 25%">
          Текст задачи
          <button onclick="sortPaginationSwitch('content',
          '<?=$column=='content'&&$direction=='ASC'?'DESC':'ASC'?>', <?=$page?>);">
              <span>
                  <img src="/Images/<?=$column=='content'?$direction:'nosort'?>.svg">
              </span>
          </button>
      </th>
      <th scope="col" style="width: 15%">
          Изменено
          <button onclick="sortPaginationSwitch('edited',
          '<?=$column=='edited'&&$direction=='ASC'?'DESC':'ASC'?>', <?=$page?>);">
              <span>
                  <img src="/Images/<?=$column=='edited'?$direction:'nosort'?>.svg">
              </span>
          </button>
      </th>
      <th scope="col" style="width: 25%">
          Статус
          <button onclick="sortPaginationSwitch('done',
          '<?=$column=='done'&&$direction=='ASC'?'DESC':'ASC'?>', <?=$page?>);">
              <span>
                  <img src="/Images/<?=$column=='done'?$direction:'nosort'?>.svg">
              </span>
          </button>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php for ($n = 3*($page - 1); $n < 3 * $page && $n < $total_rows; $n++) : ?>
        <?php $row = $params['data'][$n]; ?>
        <tr>
            <td><?=$row['user_name']?></td>
            <td><?=$row['email']?></td>
            <td><?=$row['content']?></td>
            <td>
                <?=$row['edited']?'Да':'Нет'?>
                <?php if($admin) : ?>(<a href="/editTask/edit/<?=$row['id']?>">Править</a>)<?php endif; ?>
            </td>
            <td>
                <?=$row['done']?'Выполнено':'Не выполнено'?>
                <?php if($admin && !$row['done']) : ?>(<a href="/editTask/fulfil/<?=$row['id']?>">Выполнить</a>)<?php endif; ?>
            </td>
        </tr>
    <?php endfor; ?>
  </tbody>
</table>
<? if ($total_rows > 3) :?>
<nav aria-label="..." class="row d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item <?=$page == 1 ? 'disabled' : ''?>">
            <a class="page-link" href="/home/index/<?=$column?>/<?=$direction?>/1" tabindex="-1">&lt&lt</a>
        </li>
        <li class="page-item <?=$page == 1 ? 'disabled' : ''?>">
            <a class="page-link" href="/home/index/<?=$column?>/<?=$direction?>/<?=$page - 1?>" tabindex="-1">&lt</a>
        </li>
        <?php for ($n = 1; $n <= $max_page; $n++): ?>
            <li class="page-item <?=$n==$page?'active':''?>">
                <a class="page-link" href="/home/index/<?=$column?>/<?=$direction?>/<?=$n?>"><?=$n?>
                    <?php if ($n==$page) :?><span class="sr-only">(текущая)</span><?php endif; ?>
                </a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?=$page == $max_page ? 'disabled' : ''?>">
            <a class="page-link" href="/home/index/<?=$column?>/<?=$direction?>/<?=$page + 1?>">&gt</a>
        </li>
        <li class="page-item <?=$page == $max_page ? 'disabled' : ''?>">
            <a class="page-link" href="/home/index/<?=$column?>/<?=$direction?>/<?=$max_page?>">&gt&gt</a>
        </li>
    </ul>
</nav>
<? endif; ?>
<?php switch ($params['message']) {
    case 'added':
        echo '<div class="alert alert-info" role="alert">Новая задача успешно добавлена</div>';
        break;
    case 'login':
        echo '<div class="alert alert-info" role="alert">Вы успешно авторизовались</div>';
        break;
    case 'logout':
        echo '<div class="alert alert-info" role="alert">Вы вышли из аккаунта</div>';
        break;
    case 'denied':
        echo '<div class="alert alert-danger" role="alert">Доступ запрещён. Неверно введены логин и/или пароль</div>';
        break;
    case 'changed':
        echo '<div class="alert alert-info" role="alert">Данные успешно изменены</div>';
        break;
    case 'updated':
        echo '<div class="alert alert-info" role="alert">С возвращением! Внесённые изменения сохранены</div>';
        break;
}?>
