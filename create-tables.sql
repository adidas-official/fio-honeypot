-- Active: 1719315808655@@127.0.0.1@3306@fio
CREATE TABLE transaction(  
    `id_transaction` int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Transaction identification number',
    `date` DATETIME COMMENT 'date created',
    `amount` float not null,
    `counter_account_num` int not null,
    `counter_account_bank` int not null,
    `ks` int,
    `vs` int,
    `ss` int,
    `note` VARCHAR(255),
    `type_id` int not null,
    `account_id` int not null,
    constraint `fk_transaction_account`
        Foreign Key (`account_id`) REFERENCES `account`(`id_account`),
    constraint `fk_type`
        Foreign Key (`type_id`) REFERENCES `type`(`id_type`)
) COMMENT 'Transaction data';

CREATE TABLE `type` (
    `id_type` int not null PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(32) not null UNIQUE KEY
);

CREATE Table `card` (
    `id_card` int not null PRIMARY KEY,
    `account_id` int not null,
    `card_type_id` int not null,
    `card_title` VARCHAR(64) not null,
    `limit_max` int not null default 100000,
    `limit_daily` int not null default 20000,
    constraint `fk_card_account`
        Foreign Key (`account_id`) REFERENCES `account`(`id_account`)
);