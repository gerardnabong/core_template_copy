## Requirements

-   MYSQL@^8.0
-   PHP@^7.4
-   Vue@^2.0
-   bootstrap4@^4.0.0
-   vue-bootstrap
-   npm@latest

## Installation

-   Clone repo
-   Go to your workspace and run the commands:

    -   `composer install` and `composer update`
    -   `npm install` and `npm update`
    -   `php artisan migrate --seed`
    -   `npm run watch-poll` or `php artisan run dev`

            NOTE: If you encounter `PDOException::("PDO::__construct(): Unexpected server response while doing caching_sha2 auth: 109")` while running the migration/seeder,
            run this in your mysql terminal or workbench

            ALTER USER 'root'@'localhost' IDENTIFIED WITH caching_sha2_password BY 'your password';
            ALTER USER 'root'@'%' IDENTIFIED WITH caching_sha2_password BY 'your password';

        FYI: Default authentication in MYSQL had changed in version 8
