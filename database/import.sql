CREATE DATABASE code_ju1;

USE code_ju1;

CREATE TABLE code (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    creator varchar(255),
	title varchar(255) NOT NULL,
    code TEXT NOT NULL,
    uploaddate DATE,
    codeid varchar(255),
    language varchar(255),
    description varchar(100)
);