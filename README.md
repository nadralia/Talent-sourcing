# Talent Sourcing - Laravel Backend

The core and admin backend of Talent Sourcing was built using Laravel.


## Project Requirements

-   Apache web server
-   MySQL database
-   PHP 8.0 or higher
-   Redis

## Project Setup

#### Database Setup

-   Create a new MySQL database called `talentsourcing`
-   Create a new MySQL database user with username = `talentsourcing` and password = `talentsourcing`
-   Grant the new MySQL database user (`talentsourcing`) full privileges to the `talentsourcing` database

#### Project Initialization and Configuration

-   In your localhost root folder, launch a new terminal window and run the following commands:
-   `git clone https://github.com/nadralia/Talent-sourcing.git`
-   `cd Talent-sourcing`
-   `cp .env.example .env`
-   `composer install`
-   `php artisan key:gen`
-   `php artisan migrate --seed`
-   `php artisan passport:install`
-   `php artisan passport:keys`
-   `php artisan passport:client --personal` *- Select Talent as default*
-   `npm install`
-   `npm run dev`
-   Finally, from the terminal window start the development server with the command `php artisan serve`
