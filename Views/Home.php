<?php
if ($params == ['added']) {
    $column = 'user_name';
    $direction = 'ASC';
    $page = 1;
    $added = true;
} else {
    $column = array_shift($params);
    $column = $column ? $column : 'user_name';
    $direction = array_shift($params);
    $direction = $direction ? $direction : 'ASC';
    $page = array_shift($params);
    $page = $page ? $page : 1;
    $added = false;
}
App::$db->init();
$db_result = App::$db->execute("SELECT * FROM task ORDER BY $column $direction");
App::$db->close();

?>

<?php if ($added):?>
    <div class="alert alert-info" role="alert">Новая задача успешно добавлена</div>
<?php endif; ?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">
          Имя пользователя
          <button onclick="sortPaginationSwitch('user_name',
          '<?=$column=='user_name'&&$direction=='ASC'?'DESC':'ASC'?>', <?=$page?>);">
              <span>
                  <img src="/Images/<?=$column=='user_name'?$direction:'nosort'?>.svg">
              </span>
          </button>
      </th>
      <th scope="col">
          E-mail
          <button onclick="sortPaginationSwitch('email',
          '<?=$column=='email'&&$direction=='ASC'?'DESC':'ASC'?>', <?=$page?>);">
              <span>
                  <img src="/Images/<?=$column=='email'?$direction:'nosort'?>.svg">
              </span>
          </button>
      </th>
      <th scope="col">Текст задачи</th>
      <th scope="col">Изменено администратором</th>
      <th scope="col">
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
        <?php $row = $db_result[$n]; ?>
        <tr>
            <td><?=$row['user_name']?></td>
            <td><?=$row['email']?></td>
            <td><?=$row['content']?></td>
            <td><?=$row['edited']?'Да':'Нет'?></td>
            <td><?=$row['done']?'Выполнено':'Не выполнено'?></td>
        </tr>
    <?php endfor; ?>
  </tbody>
</table>
<? if (count ($db_result) > 3) :?>
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
