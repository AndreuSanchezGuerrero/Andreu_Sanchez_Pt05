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

<br>

## models directory 📂

Each file in this directory corresponds to a specific entity or table in the database, and the methods within each class handle database CRUD operations related to that entity.

At the moment we only handle data from Users and Books.

### Things to note about the User.php file 🐘

In the createUser method we return the id to be logged in as soon as the user registers.

TODO: Make it possible for the user to edit his profile or delete his account.

<br>

## views directory 📂



### 🐘 🎨