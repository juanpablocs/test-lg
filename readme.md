# Test Gorilla

## Create database

```
CREATE DATABASE `lgorilla`;
```

## Create table user

```
CREATE TABLE `lgorilla`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NULL,
  `password` VARCHAR(60) NULL,
  PRIMARY KEY (`id`));
```

## Populate User

```
php populate.php
```

## Run Application

```
php -S 0.0.0.0:8000 -t public
```