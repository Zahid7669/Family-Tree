CREATE DATABASE IF NOT EXISTS people_database;
USE people_database;

CREATE TABLE IF NOT EXISTS people_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gender CHAR(1),
    name VARCHAR(255),
    alter_name VARCHAR(255),
    surname1 VARCHAR(255),
    surname2 VARCHAR(255),
    birth VARCHAR(255),
    father_name VARCHAR(255),
    father_surname1 VARCHAR(255),
    father_surname2 VARCHAR(255),
    mother_name VARCHAR(255),
    mother_surname1 VARCHAR(255),
    mother_surname2 VARCHAR(255),
    father_grandfather_name VARCHAR(255),
    father_grandmother_name VARCHAR(255),
    mother_grandfather_name VARCHAR(255),
    mother_grandmother_name VARCHAR(255)
);
