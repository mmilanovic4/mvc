# Overview

 PHP MVC boilerplate with user authentication, basic security and MySQL CRUD operations.
 Framework was developed during the final year of university. It was used for some private projects, however I highly suggest you to use Laravel or some other popular framework for your work.

## Requirements

- **Web server:** Apache with mod_rewrite enabled
- **Database server:** MySQL
- PHP 7.x

## Login operation

If you imported database data from `sys/db_dump.sql`, you could authenticate with following credentials:
- john.doe@example.com / admin
- jane.doe@example.com / admin

If you're manually adding user to `users` table, don't forget to append salt from `sys/Config.php` before hashing with SHA-512 algorithm.

![Login form](https://i.imgur.com/tpyxPA5.png)

## CRUD operations

Each database table should have appropriate model file. For example, table `tasks` have `app/models/TaskModel.php`. There you need to hardcode table name in protected `$tableName` variable and eventually add new functions. Provided functions with basic model are:
- read
- readAll
- create
- update
- delete

![CRUD operations](https://i.imgur.com/rMfTktP.png)

## Router

All routes should be placed inside `routes.php`. Each route must have following properties:
- Name of the controller where route belongs to
- Name of the controller's method (route callback)
- Request URI, represented via PCRE
For example, if we have following code:
```
...
new Route('Home', 'index', '|^/?$|'),
...
```
it means that when user visit URI which matched RegEx `|^/?$|`, `index.php` will instantiate `HomeController.php` and call his `index` method.
