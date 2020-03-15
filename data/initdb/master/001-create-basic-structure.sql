create table IF NOT EXISTS systemadb.actionlog
(
    id int auto_increment primary key,
    date datetime not null,
    topic varchar(255) not null,
    data longtext null
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `systemadb`.`place_type` (
                                                        `place_type` INT NOT NULL AUTO_INCREMENT,
                                                        `label` VARCHAR(105) NOT NULL,
                                                        PRIMARY KEY (`place_type`))
    ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `systemadb`.`place` (
                                                   `place_id` INT NOT NULL AUTO_INCREMENT,
                                                   `place_type_id` INT NOT NULL,
                                                   `name` VARCHAR(45) NOT NULL,
                                                   `creation_date` DATETIME NOT NULL,
                                                   `lat` FLOAT NOT NULL,
                                                   `long` FLOAT NOT NULL,
                                                   `extension` FLOAT NOT NULL DEFAULT 10,
                                                   PRIMARY KEY (`place_id`),
                                                   FOREIGN KEY (`place_type_id`)
                                                       REFERENCES `systemadb`.`place_type` (`place_type`)
                                                       ON DELETE CASCADE
                                                       ON UPDATE CASCADE)
    ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `systemadb`.`local_type` (
                                                        `local_type_id` INT NOT NULL AUTO_INCREMENT,
                                                        `label` VARCHAR(45) NOT NULL,
                                                        PRIMARY KEY (`local_type_id`))
    ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `systemadb`.`local` (
                                                   `local_id` INT NOT NULL AUTO_INCREMENT,
                                                   `local_type_id` INT NOT NULL,
                                                   `label` VARCHAR(255) NOT NULL,
                                                   `description` TEXT NOT NULL,
                                                   PRIMARY KEY (`local_id`),
                                                   FOREIGN KEY (`local_type_id`)
                                                       REFERENCES `systemadb`.`local_type` (`local_type_id`)
                                                       ON DELETE CASCADE
                                                       ON UPDATE CASCADE)
    ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `systemadb`.`local_store` (
                                                         `local_store_id` INT NOT NULL AUTO_INCREMENT,
                                                         `local_id` INT NOT NULL,
                                                         `place_id` INT NOT NULL,
                                                         `label` VARCHAR(255) NOT NULL,
                                                         `description` TEXT NOT NULL,
                                                         `address` VARCHAR(105) NULL,
                                                         `lat` FLOAT NULL,
                                                         `long` FLOAT NULL,
                                                         PRIMARY KEY (`local_store_id`),
                                                         FOREIGN KEY (`local_id`)
                                                             REFERENCES `systemadb`.`local` (`local_id`)
                                                             ON DELETE NO ACTION
                                                             ON UPDATE NO ACTION,
                                                         FOREIGN KEY (`place_id`)
                                                             REFERENCES `systemadb`.`place` (`place_id`)
                                                             ON DELETE NO ACTION
                                                             ON UPDATE NO ACTION)
    ENGINE = InnoDB;