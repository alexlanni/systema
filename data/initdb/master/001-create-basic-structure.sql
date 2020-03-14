create table systemadb.actionlog
(
    id int auto_increment primary key,
    date datetime not null,
    topic varchar(255) not null,
    data longtext null
) ENGINE=InnoDB;
