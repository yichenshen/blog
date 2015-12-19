# blog

CVWO Assignmment 1: A simple blog app

This repository contains a very basic blogging app, which allows multiple writers to login, thereby to create and manage content. The app also allows for public comments on each blog post.	

## Author

Shen Yichen (A0091173J)

## Requirements
 - PHP 5.6
  - `mod_rewrite` needs to be activated
 - MySQL 5.6

## Frameworks

This app is based on the [MINI](https://github.com/panique/mini) PHP framework, and adopts MVC principles approximately.

## Setup

#### MySQL

##### Schema

Install the schema by running `db/schema_install.sql`. 

```bash
# From system terminal 
mysql -u root -p < db/schema_install.sql

# OR

# From MySQL terminal
source db/schema_install.sql
```

This scripts creates the __blog__ schema in MySQL and sets up the tables accordingly. No data will be loaded.

##### Connector

MySQL user configs are located in `src/application/config/config.php`. Edit them accordingly to connect to your MySQL database.

Alternatively, for a local MySQL server, create a user with the following credentials, which will allow connection with default settings.

```
user: 		blog
password: 	cvwoblog
```
