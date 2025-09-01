1) сбилдим образ и запустим

```
cd docker && docker-compose build && docker-compose up -d
```

2) попадем в контейнер и установим зависимости, миграции

```
docker exec -it php-yii bash 
```

```
php composer.phar install
```

```
php init
```

```
php yii migrate
```

3) инициализируем RBAC, создадим юзера

```
php yii migrate --migrationPath=@yii/rbac/migrations/
```

```
php yii rbac/init
```

```
php yii user/create
```

4) Добавим роль юзеру (guest, user)

```
php yii user/assign-role
```

5) Добавим в /etc/hosts вашей тачки следующую запись

```
127.0.0.1 admin.yii.test
```

6) Приложение доступно по адресу http://admin.yii.test