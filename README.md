# Task Manager

Task Manager is a Laravel-based application for managing tasks effectively.

## Installation

### Prerequisites

Make sure you have the following installed:

- PHP
- Composer
- MySQL (or any other supported database)
- Node.js and npm (if using front-end tooling)

### Steps

1. **Clone the Repository:**

`git clone https://github.com/MoatazAbdAlmageed/task-manager.git`

2. **Install Dependencies:**

   ```bash
   composer install
   ```

3. **Set Up Environment File:**

   Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key:**

   ```bash
   php artisan key:generate
   ```

5. **Configure Database:**

   Open the `.env` file and set your database credentials:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

6. **Run Migrations:**

   ```bash
   php artisan migrate
   ```

7. **Seed the Database:**

   ```bash
   php artisan db:seed
   ```

### Using Laradock

If you prefer to use Laradock for setting up your development environment, follow these steps:

1. **Clone Laradock:**

   ```bash
   git clone https://github.com/Laradock/laradock.git
   cd laradock
   ```

2. **Set Up Environment File:**

   Copy the `.env.example` file to `.env` in the Laradock directory:

   ```bash
   cp .env.example .env
   ```

3. **Configure Laradock:**

   Open the `.env` file in the Laradock directory and set the necessary configurations to match your project.

4. **Start Containers:**

   ```bash
   docker-compose up -d nginx mysql
   ```

5. **Workspace:**

   Access the workspace container:

   ```bash
   docker-compose exec workspace bash
   ```

6. **Run the Following Commands Inside the Workspace:**

    - Install Composer dependencies:

      ```bash
      composer install
      ```

    - Run migrations and seed the database:

      ```bash
      php artisan migrate --seed
      ```

For more detailed instructions and troubleshooting, refer to the [Laradock documentation](https://laradock.io/).

## Contributing

If you would like to contribute to this project, please fork the repository and submit a pull request.

## License

This project is licensed under the MIT License.
