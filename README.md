# PHP-MySQL-CRUD-WebApp

A basic web based application where we can perform Create, Read, Update, and Delete (C.R.U.D.) operations on automobiles information, in addition to search and also generate the automobiles table in PDF and Excel format which can then be downloaded and shared.

# Creating the Database Table

Execute the following SQL query to create a table named employees inside your MySQL database.
```
CREATE TABLE users (
   user_id INTEGER NOT NULL
   AUTO_INCREMENT KEY,
   name VARCHAR(128),
   email VARCHAR(128),
   password VARCHAR(128),
   INDEX(email)
) ENGINE=InnoDB CHARSET=utf8;
```
This SQL script to create database table is also present in create_dB.sql file.
