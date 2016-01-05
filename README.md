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

##### Test Data

Test data can be found in `db/test_data.sql`. Run this script after the schema script, in the same fashion, if you wish to initialize the database with initial data.

The test data comes with 2 writer accounts:

```
user:		admin
password:	admin
```

```
user:		editor
password:	writer
```

#### Server

Copy the contents of `src/` to your server root and start the server. Make sure the requirements are statisfied.

In an UNIX environment, you can also use `mount --bind` to quickly and temporarily set-up the server. For example: 

```bash
#For an apache server
mount --bind src/ /var/www/html/
```

## Structure

The app is based on the MINI PHP framework, and follows a MVC structure roughly. You may want to check out MINI's [documentation](https://www.dev-metal.com/mini-extremely-simple-barebone-php-application/).

#### public/

The `src/public/` folder contains the index page which is the entry point for the app. It also contains the neccessary resourses such as Javascript and CSS files that the app depends on.

The Bootstrap CSS framework is included.

#### model/

The `src/application/model` folder contains the models. Each model corresponds to a resource in the database, and provides methods to create, edit, delete and query them.

SQL code is directly coded into the models, and are used together with PDO to access the database.

#### controller/

The 'src/application/controller' folder contains the controllers, obtaining data from the models and setting them up for the views.

Each method in a controller corresponds to an URL, as explained in the MINI documentation. Just allowing for a quick API to be set-up.

#### view/

The 'src/application/view' folder contains the views for the app. `_templates` contains reusable HTML which can be set-up either in the controllers or within the view itself. The rest of the views corresponds to features of the app.

## License

This app is released under the MIT license, refer to the LICENSE file for details.
