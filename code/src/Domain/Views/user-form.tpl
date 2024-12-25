<form action="/user/save/" method="post">
  <input id="user-id" type="hidden" name="id" value="{{ user.getUserId() }}">
  <p>
    <label for="user-name">Имя:</label>
    <input id="user-name" type="text" name="name">
  </p>
  <p>
    <label for="user-lastname">Фамилия:</label>
    <input id="user-lastname" type="text" name="lastname">
  </p>
  <p>
    <label for="user-birthday">День рождения:</label>
    <input id="user-birthday" type="text" name="birthday" placeholder="ДД-ММ-ГГГГ">
  </p>
  <p><input type="submit" value="Сохранить"></p>
</form>