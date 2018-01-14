CREATE TABLE `watcher`.`Watch` ( 
    `ID` INT NOT NULL AUTO_INCREMENT,
    `Name` Varchar(50) NOT NULL,
    `CreationDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)) 
    ENGINE = InnoDB 
    CHARSET=utf8 COLLATE utf8_bin;

CREATE TABLE `watcher`.`Watch_en` ( 
    `ID` INT NOT NULL,
    `Description` VARCHAR (250) NOT NULL,
    PRIMARY KEY (`ID`))
    FOREIGN KEY (`ID`) REFERENCES `Watch` (`ID`) 
        ON DELETE CASCADE  
    ENGINE = InnoDB 
    CHARSET=utf8 COLLATE utf8_bin;

    