CREATE TABLE `watcher`.`User` ( 
    `ID` INT NOT NULL AUTO_INCREMENT , 
    `Username` VARCHAR(50) NOT NULL , 
    `Firstname` VARCHAR(50) NOT NULL , 
    `Lastname` VARCHAR(50) NOT NULL , 
    `AddressLine` VARCHAR(100) DEFAULT NULL, 
    `PLZ` INT DEFAULT NULL, 
    `City` VARCHAR(50) DEFAULT NULL, 
    `Email` VARCHAR(250) DEFAULT NULL, 
    `Password` VARCHAR(255) NOT NULL, 
    `Activated` BOOLEAN NOT NULL DEFAULT 1, 
    `ActivationHash` VARCHAR(10), 
    `Salt` VARCHAR(10) NOT NULL,
    `CreationDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)) 
    ENGINE = InnoDB 
    CHARSET=utf8 COLLATE utf8_bin;

    