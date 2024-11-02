-- run the following command to create the database in your XAMP, LAMP etc


-- Create the database.
CREATE DATABASE usersdb;

-- Use the created database
USE usersdb;

-- Create the fields
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(25),
    password CHAR(255),
    registrationdate DATETIME DEFAULT CURRENT_TIMESTAMP
);