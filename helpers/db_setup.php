
<?php

//commands used to initialize the database

"CREATE DATABASE your_db; CREATE USER 'your_user'@'localhost' IDENTIFIED BY 'your_password'; GRANT ALL PRIVILEGES ON your_db.* TO 'your_user'@'localhost'; FLUSH PRIVILEGES;";

"CREATE TABLE `mzansi`.`users` (`userID` INT NOT NULL AUTO_INCREMENT , `fullName` VARCHAR(50) NOT NULL , `email` VARCHAR(100) NOT NULL , `phoneNumber` VARCHAR(10) NOT NULL , `password` VARCHAR(255) NOT NULL , `dateJoined` DATETIME NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`userID`)) ENGINE = InnoDB;";

"CREATE TABLE `mzansi`.`products` (`title` VARCHAR(200) NOT NULL , `userID` INT(11) NOT NULL , `description` TEXT NOT NULL , `price` INT(7) NOT NULL , `rating` INT(1) NULL DEFAULT NULL , `productID` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`productID`)) ENGINE = InnoDB;";

"CREATE TABLE `mzansi`.`cart` (`cartID` INT NOT NULL AUTO_INCREMENT , `userID` INT NOT NULL , `productID` INT NOT NULL , `quantity` INT NOT NULL DEFAULT '1' , PRIMARY KEY (`cartID`)) ENGINE = InnoDB;";

"CREATE TABLE `mzansi`.`orders` (`orderID` INT NOT NULL AUTO_INCREMENT , `userID` INT NOT NULL , `orderTotal` DOUBLE NOT NULL , `orderDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`orderID`)) ENGINE = InnoDB;";

?>