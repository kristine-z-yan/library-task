## Library App Project


This project uses Laravel, its models, migrations, factories, resource controller as an API.

Every book can have many authors and every author can have many books. I used Laravel Eloquent for making these relations.


After cloning, you should

- modify the ``.env`` file
- run ``php artisan migrate --seed ``

In welcome page you'll see a table with books where you can find theirs titles, descriptions, authors, date of creation and view button.

