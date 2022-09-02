CREATE TABLE `users` (`id` TEXT NOT NULL , `vorname` TEXT NOT NULL , `nachname` TEXT NOT NULL , `username` TEXT  not NULL , `admin` BOOLEAN NOT NULL , `ppurl` TEXT NOT NULL , `active` BOOLEAN NOT NULL DEFAULT (1) , UNIQUE (`id`)) ENGINE = InnoDB;
CREATE TABLE `items` (`id` TEXT NOT NULL , `name` TEXT NOT NULL , `status` TEXT NOT NULL , `category` TEXT NOT NULL , `owner` TEXT , UNIQUE (`id`)) ENGINE = InnoDB;
CREATE TABLE `categories` (`id` TEXT NOT NULL , `name` TEXT NOT NULL , UNIQUE (`id`)) ENGINE = InnoDB;
CREATE TABLE `log` (`timestamp` TEXT NOT NULL , `user` TEXT NOT NULL , `action` TEXT NOT NULL ) ENGINE = InnoDB;
