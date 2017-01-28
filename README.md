mia
===

A Symfony project created on January 28, 2017, 12:34 pm.

Project Setup

1. Database creation

```mysql
CREATE USER 'mia'@'%' IDENTIFIED WITH mysql_native_password AS '***';GRANT USAGE ON *.* TO 'mia'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `mia`;GRANT ALL PRIVILEGES ON `mia`.* TO 'mia'@'%';GRANT ALL PRIVILEGES ON `mia\_%`.* TO 'mia'@'%';
```

2. Create database command


3. Fixtures load

