Список всех новостей выводится на главной<br>
Доступ к редактированию новостей и категорий новостей в пунктах меню<br><br>

REST API<br>
Получение списка новостных категорий /api/news-category<br>
Получение списка новостей /api/news<br>
Получение новостей по ветке категорий (включая подкатегории) /api/news/list-by-category-id?id=10<br>
Получение отдельной новости /api/news/view?id=1<br>
Методы update, delete и create отключены, все остальные стандартные запросы работают<br>
Проверка доступа к API через токен в get запросе<br>
Ограничение на число запросов RateLimitInterface<br>

Поднятие проекта через docker-compose<br>
Запуск миграций создаст таблицы и заполнит демо данными<br>