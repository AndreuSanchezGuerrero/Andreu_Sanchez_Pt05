# Project structure ✍️

## config directory 📂

The config directory stores environment and database configuration files for the project.

### Things to note about the connection

The PDO was implemented using the singleton pattern. This ensures that only one instance of the database connection is created and shared throughout the application.

- The PDO instance is initialized once and passed to the models (such as Books.php and User.php) that require database access.

- By using this approach, the code avoids the overhead of creating multiple database connections, making the application more efficient and scalable.

The singleton pattern allows for:

- Consistency in the database connection.
- Efficiency, as the connection is reused across the application.

### Things to note about the env.php file 🐘

Diferences between BASE_PATH and BASE_URL:

- BASE_PATH: Refers to the file path on the server for backend code execution (e.g., including PHP files).

- BASE_URL: Refers to the URL path for serving content to the client-side/browser (e.g., linking styles, scripts, and assets).

You will also need to modify the BASE_URL to reflect the path of your project in your local XAMPP server.

```php
define('DB_VAR', [
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'pt04_andreu_sanchez',
    'DB_USER' => 'root',
    'DB_PASSWORD' => '',
]);

define('BASE_PATH', dirname(__DIR__) . '/');
define('BASE_URL', '/Backend/Andreu_Sanchez_Pt04/');
```

<br>

## models directory 📂

Each file in this directory corresponds to a specific entity or table in the database, and the methods within each class handle database CRUD operations related to that entity.

At the moment we only handle data from Users and Books.

### Things to note about the User.php file 🐘

In the createUser method we return the id to be logged in as soon as the user registers.

TODO: Make it possible for the user to edit his profile or delete his account.

<br>


## Index file 📝

This file is the root file that the host server will look for when you first log in. 

This is where the basic variables are declared and checked if the user is logged in.

If the user is logged in, a session timeout is activated.

index.php calls layout.php

<br>

## views directory 📂

The Views directory contains the components that can be viewed by the client. All these components are included in the layout.

**Auth 📂**

Auth directory contains the typical auth components: 

- login

- logout

- register

These components have a nice but simple html and css structure. Where the real difficulty lies is in their own controllers.

**Components 📂**

Components directory contains a list of web components.

### Things to note about the alert.php file 🐘

alert.php calls all session variables.
It checks if these variables contain any strings.
If there are, it throws a message using a toaster style thanks to alert.js.

### Things to note about the header.php file 🐘

If you are logged in, you will see a different icon on the header

If you click on the icon of the little person and you are not logged in, a menu with the options to go to home or to go to login view will be displayed. But if you are logged in, you can only see the home option.

### Things to note about the form and boks components 🐘

The form.php file can only be used if the user is logged in. It contains the view for adding or editing books. However, to edit a book, it also relies on books.php, which displays the list of books specific to that user. From this view, the user can choose to edit or delete a book. If the user is not logged in, the application simply displays all the books that have been added by any user.

Although these functionalities are split across different components, they are all integrated into a single view, managed by layout.php.

### Things to note about the pagination component 🐘

The pagination component consists of two specific files. The first is pagination-option.php, which contains the view where the user can choose how many books to display per page. The second is pagination.php, which shows the total number of pages, based on the selection made in pagination-option.php. The total number of pages is calculated according to the number of books selected to display.

By default, 5 books are shown per page.

### Things to note about shared folder 📂

In the share folder, we have the JavaScript files for two functionalities: the AJAX for session timeout and the toggle menu for the user icon.

### controllers directory 📂

The controllers directory is made up of various controllers that handle all the error validation logic and session variable management before interacting with the model. All controllers follow the same structure:

- Validation of variables.
- Depending on whether the validation is successful or not, a message is stored in the session variable.
- If the validation is successful, the controller calls the model and either retrieves or executes the necessary request for the specific action.

The most notable controller is the registration controller, which includes regex for validation. The rest of the controllers have code that is straightforward enough to understand without much explanation. However, if you have any questions, feel free to ask.