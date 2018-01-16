CREATE TABLE `blog_samples`.`User` ( 
    `ID` INT NOT NULL AUTO_INCREMENT ,
    `Firstname` VARCHAR(50) NOT NULL , 
    `Lastname` VARCHAR(50) NOT NULL , 
    `AddressLine` VARCHAR(100) DEFAULT NULL, 
    `PLZ` INT DEFAULT NULL, 
    `City` VARCHAR(50) DEFAULT NULL, 
    `Email` VARCHAR(250) DEFAULT NULL, 
    `Password` VARCHAR(255) NOT NULL, 
    `Activated` BOOLEAN NOT NULL DEFAULT 1, 
    `ActivationHash` VARCHAR(100),
    `IsAdmin` BOOLEAN NOT NULL DEFAULT 0,
    `CreationDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)) 
    ENGINE = InnoDB 
    CHARSET=utf8 COLLATE utf8_bin;

    