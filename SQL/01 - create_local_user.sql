CREATE USER casa_dev@localhost identified with mysql_native_password by 'casa';

GRANT ALL PRIVILEGES ON * . * TO 'casa_dev'@'localhost';

FLUSH PRIVILEGES;