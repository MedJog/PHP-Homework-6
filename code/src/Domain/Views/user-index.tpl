<div class="users">
<h2 class="users-title">Список пользователей в хранилище</h2>
<ul class="users-list" id="navigation">
    {% for user in users %}
        <li class="users-li"> {{ user.getUserName() }} {{ user.getUserLastName() }}. День рождения: {{ user.getUserBirthday() | date('d.m.Y') }}
        <div class="buttons">
         <!-- Кнопка обновления -->
            <a href="/user/update/?id={{ user.getUserId() }}" class="btn update-btn">Обновить</a>

        <!-- Форма для удаления -->
            <form action="/user/delete/" method="post">
            <input type="hidden" name="id" value="{{ user.getUserId() }}">
            <button type="submit" class="btn delete-btn">Удалить</button>
            </form>
        </div>
        </li>
    {% endfor %}
</ul>
</div>