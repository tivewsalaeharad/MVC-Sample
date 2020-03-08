<form id="newTaksForm" method="post" action="">
  <div class="form-group">
    <label for="userName">Имя пользователя</label>
    <input type="text" name="user_name" class="form-control" id="newTaskUserName" placeholder="Имя пользователя">
  </div>
  <div class="form-group">
    <label for="eMail">Email address</label>
    <input type="text" name="email" class="form-control" id="newTaskEMail" aria-describedby="emailHelp" placeholder="e-mail">
  </div>
  <div class="form-group">
    <label for="taskDetails">Текст задачи</label>
    <input type="text" name="content" class="form-control" id="newTaskDetails" placeholder="Задача">
  </div>
  <button type="submit" name="submit" class="btn btn-primary" id="newTaskAdd">Добавить задачу</button>
</form>
