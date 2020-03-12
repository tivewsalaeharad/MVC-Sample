<form id="newTaksForm" method="post" action="">
  <? if($params) {?><input type="hidden" name="id" value="<?=$params['id']?>"><?}?>
  <div class="form-group">
    <label for="userName">Имя пользователя</label>
    <input type="text" name="user_name" class="form-control" id="newTaskUserName" placeholder="Имя пользователя"
    <?=$params?'value = "'.$params['user_name'].'"':''?>>
  </div>
  <div class="form-group">
    <label for="eMail">Email address</label>
    <input type="text" name="email" class="form-control" id="newTaskEMail" placeholder="e-mail"
    <?=$params?'value = "'.$params['email'].'"':''?>>
  </div>
  <div class="form-group">
    <label for="taskDetails">Текст задачи</label>
    <input type="text" name="content" class="form-control" id="newTaskDetails" placeholder="Задача"
    <?=$params?'value = "'.$params['content'].'"':''?>>
  </div>
  <button type="submit" name="submit" class="btn btn-primary" id="newTaskAdd"><?=$params?'Сохранить изменения':'Добавить задачу'?></button>
</form>
