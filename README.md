SF3
===

A Symfony project created on January 28, 2017, 12:34 pm.

Project Setup

0. Database and mysql user creation

```mysql
CREATE USER 'user'@'%' IDENTIFIED WITH mysql_native_password AS 'password';
GRANT USAGE ON *.* TO 'user'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS `sf3`;GRANT ALL PRIVILEGES ON `sf3`.* TO 'user'@'%';
GRANT ALL PRIVILEGES ON `sf3\_%`.* TO 'user'@'%';
```
1. Composer
```shell
composer install 
```

2. Load Schema
```shell
./mia doctrine:schema:create
```

3. Load Fixtures
```shell
./mia doctrine:fixtures:load
```

4. Login data

* Login: admin
* Password: s3cret


5. Frontend assets

* In root folder
```shell
npm install
```

* If You don't have gulp installed, install it globally.
 If You do not want to do that skip this and the next point
```shell
npm install gulp -g
```

* Than run
```shell
gulp
```

* (!) If You skipped global installation just run this: 
```shell
./node_modules/gulp/bin/gulp.js
```

as it is installed with other packages in the project root folder
