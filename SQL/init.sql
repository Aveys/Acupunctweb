CREATE TABLE articles
(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    author VARCHAR(50) NOT NULL,
    title VARCHAR(200) NOT NULL,
    Content VARCHAR(5000) NOT NULL,
    datePub DATETIME NOT NULL
);
CREATE TABLE keySympt
(
    idK INT NOT NULL,
    idS INT NOT NULL,
    PRIMARY KEY (idK, idS)
);
CREATE TABLE keywords
(
    idK INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(40)
);
CREATE TABLE meridien
(
    code VARCHAR(5) PRIMARY KEY NOT NULL,
    nom VARCHAR(20) NOT NULL,
    element VARCHAR(1) NOT NULL,
    yin TINYINT NOT NULL
);
CREATE TABLE patho
(
    idP INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    mer VARCHAR(5) NOT NULL,
    type VARCHAR(10) NOT NULL,
    `desc` VARCHAR(50) NOT NULL
);
CREATE TABLE symptPatho
(
    idS INT NOT NULL,
    idP INT NOT NULL,
    aggr TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (idS, idP)
);
CREATE TABLE symptome
(
    idS INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `desc` LONGTEXT NOT NULL
);
CREATE TABLE users
(
    id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    admin TINYINT NOT NULL
);
CREATE UNIQUE INDEX unique_datePub ON articles (datePub);
CREATE UNIQUE INDEX unique_id ON articles (id);
CREATE INDEX element ON meridien (element);
CREATE INDEX code ON patho (mer);
CREATE UNIQUE INDEX id ON users (id);
