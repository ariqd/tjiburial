# Tjiburial

### How to Install
> Make sure you have [Composer](https://getcomposer.org) installed in your machine!
1. Download ZIP or clone the project
2. Go to the application folder
3. Start `cmd` or terminal, then run `composer install` or `php composer.phar install`
4. Copy `.env.example` file as `.env` in the root folder (the same folder).
5. Open your `.env` file and change the database name (`DB_DATABASE`) to whatever you have, username (`DB_USERNAME`) and password (`DB_PASSWORD`) field correspond to your configuration. 
   By default, the username is root and you can leave the password field empty. (for XAMPP)
6. In `cmd`, run `php artisan key:generate`
7. Run `php artisan migrate`
8. Go to `localhost/(Folder Name)/public` in your browser
