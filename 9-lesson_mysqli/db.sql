CREATE DATABASE  `xmpl` ;

USE `xmpl`;

CREATE TABLE  `xmpl`.`users` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`username` VARCHAR( 255 ) NOT NULL ,
`password` VARCHAR( 255 ) NOT NULL
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `xmpl`.`users` (`id`, `username`, `password`) VALUES (NULL, 'guest', '123456');
INSERT INTO `xmpl`.`users` (`id`, `username`, `password`) VALUES (NULL, 'user', '654321');
INSERT INTO `xmpl`.`users` (`id`, `username`, `password`) VALUES (NULL, 'admin', '456123');