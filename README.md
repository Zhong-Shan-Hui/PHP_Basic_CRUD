# PHP-MySQL-CRUD-WebApp

A basic web based application where we can perform Create, Read, Update, and Delete (C.R.U.D.) operations on automobiles information, in addition to search and also generate the automobiles table in PDF and Excel format which can then be downloaded and shared.

# Creating the Database Table

Execute the following SQL query to create a table named autos inside your MySQL database.
```
CREATE TABLE autos (
        autos_id INTEGER NOT NULL KEY AUTO_INCREMENT,
        make VARCHAR(255),
        model VARCHAR(255),
        year INTEGER,
        mileage INTEGER
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
This SQL script to create database table is also present in create_dB.sql file.
