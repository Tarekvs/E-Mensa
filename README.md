# E-Mensa

E-Mensa is a web application that provides an interactive platform for a virtual Cafeteria and its meals. This repository contains the source code and documentation for E-Mensa.

## Overview

E-Mensa was built using the Model-View-Controller (MVC) concept. The core routing script, `index.php`, was not written by me but serves as the foundational structure for the application. However, I have implemented all controllers, views, SQL database connections, database logic, and a logger to extend and enhance the functionality of the website.

## Features

E-Mensa offers a wide range of features, including:

- **Database Interaction**: The website is capable of creating a database connection, fetching data from the database, adding new records to the database, and deleting existing records.

- **Database Security**:To protect against SQL injection attacks, user inputs are sanitized before they are used in SQL queries. This is achieved using the mysqli_real_escape_string() function, which escapes special characters in a string for use in an SQL statement.

- **User Authentication**: Users can register and log in with a username, password, and email. The password is hashed before being saved in the Database. Furthermore admin privileges are available for users that register as admins.

- **Meal Reviews**: Logged-in users can review meals and share their opinions. Admins can delete reviews.

- **Profile Management**: Users have access to their profiles, where they can edit their information and view their activity.

- **Statistical Data**: The website provides statistical data regarding its usage and user interactions.

- **Meal Recommendations**: Users can recommend new meals for inclusion in the system, contributing to the variety of available options.

- **Newsletter Signup**: Users can subscribe to a newsletter.

- **User Reviews**: Users can read and engage with reviews submitted by other users.

- **Logging**: The website also contains a live logger to record important events and actions for debugging and monitoring purposes.

## Getting Started

To get started with E-Mensa, follow these steps:

1. Clone this repository to your local machine:
   ```bash
   git clone https://github.com/Tarekvs/E-Mensa_PHP_SQL.git



# Routingscript MVC

intended to run with only one dependency (bladeone).

## usage

* start this script by either executing `start_server.bat` or running `php -S 127.0.0.1:9000 -t public` in a shell from the project´s root directory.

* this web application relies on MariaDB

* please ensure your db.php file for connection with your local database is       correct.

* run the Load-Database.sql file before running the web application

* [open the website](http://127.0.0.1:9000/)

## folder overview

* `bin/` is only necessary if you need to use composer and dont have it installed already
* `config/` holds configuration files
* `controllers/` contains all Controller Classes
* `models/` contains the Model Classes
* `public/` is the web root for your http server and contains the routing script itself, next to resources that will be accessible by http clients (css, js, images, etc.)
* `storage/` is necessary to hold Blade Cache Files  
* `views/` holds all View Files
