create table systemadb.actionlog
(
    id                        int auto_increment
        primary key,
    date                      datetime      not null,
    topic                     varchar(255)  not null,
    verb                      varchar(20)   not null,
    identity_type             varchar(20)   not null,
    identity_role             varchar(20)   not null,
    identity_id               int           not null,
    identity_token            varchar(255)  not null,
    client_ip                 varchar(100)  not null,
    client_ua                 text          null,
    response_http_status_code int default 0 not null
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


create table if not exists login
(
    login_id int auto_increment,
    email varchar(150) not null,
    password varchar(255) not null,
    enabled tinyint(1) default 0 not null,
    constraint login_pk
        primary key (login_id)
) ENGINE = InnoDB;

create unique index login_email_uindex
    on login (email);


create table role
(
    role_id int auto_increment,
    label varchar(50) not null,
    enabled tinyint(1) default 1 not null,
    constraint role_pk
        primary key (role_id)
) ENGINE = InnoDB;

create unique index role_label_uindex
    on role (label);

create table login_has_role
(
    login_has_role_id int auto_increment,
    login_id int not null,
    role_id int not null,
    constraint login_has_role_pk
        primary key (login_has_role_id),
    constraint login_fk
        foreign key (login_id) references login (login_id)
            on update cascade on delete cascade,
    constraint role_fk
        foreign key (role_id) references role (role_id)
            on update cascade on delete cascade
) ENGINE = InnoDB;

create index login_has_role_index
    on login_has_role (login_id, role_id);


create table resource
(
    resource_id int auto_increment,
    name varchar(50) not null,
    verb varchar(15) null,
    enabled tinyint(1) default 1 not null,
    constraint resource_pk
        primary key (resource_id)
) ENGINE = InnoDB;

create unique index resource_index
    on resource (name, verb);


create table resource_has_role
(
    resource_has_role_id int auto_increment,
    resource_id int not null,
    role_id int not null,
    constraint resource_has_role_pk
        primary key (resource_has_role_id),
    constraint rhr_resource_fk
        foreign key (resource_id) references resource (resource_id)
            on update cascade on delete cascade,
    constraint rhr_role_fk
        foreign key (role_id) references role (role_id)
            on update cascade on delete cascade
) ENGINE = InnoDB;


create table address
(
    address_id int auto_increment,
    login_id int not null,
    address varchar(255) not null,
    city varchar(50) not null,
    zipcode varchar(10) not null,
    province varchar(10) not null,
    country_code varchar(4) default 'IT' not null,
    constraint address_pk
        primary key (address_id),
    constraint address_login_fk
        foreign key (login_id) references login (login_id)
            on update cascade on delete cascade
) ENGINE = InnoDB;

create table token
(
    token_id varchar(255) not null,
    login_id int not null,
    creation_date datetime default now() not null,
    expire_date datetime null,
    data longtext not null,
    constraint token_pk
        primary key (token_id),
    constraint token_login_fk
            foreign key (login_id) references login (login_id)
            on update cascade on delete cascade
) ENGINE = InnoDB;


INSERT INTO systemadb.role (role_id, label, enabled) VALUES (1, 'superadmin', 1);
INSERT INTO systemadb.role (role_id, label, enabled) VALUES (2, 'admin', 1);
INSERT INTO systemadb.role (role_id, label, enabled) VALUES (3, 'user', 1);

