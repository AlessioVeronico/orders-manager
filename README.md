
# Order Manager

## Overview

Order Manager is a simple web application designed for managing orders and products. The application features a responsive frontend built with Vue.js and Vuetify, while the backend is powered by Laravel, providing a robust REST API service.

## Features

- **User-friendly Interface**: Intuitive design for easy navigation and management of orders and products.
- **Order Management**: Create, update, and delete orders efficiently.
- **Product Management**: Add, update, and remove products with ease.
- **REST API**: Built with Laravel, the backend offers a secure and efficient API for data management.
- **Responsive Design**: The application is fully responsive, ensuring a seamless experience across all devices.

## Technologies Used

- **Frontend**:
  - Vue.js: JavaScript framework for building user interfaces.
  - Vuetify: Material Design component framework for Vue.js.
- **Backend**:
  - Laravel: PHP framework for building web applications and APIs.
  - PostgreSQL: Relational database management system for data storage.
  - pgAdmin: Database management tool for PostgreSQL.

## Getting Started

### Prerequisites

- Node.js and npm (for the frontend)
- Composer (for the backend)
- Laravel
- PostgreSQL and pgAdmin

### Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/order-manager.git
   cd order-manager
   ```

2. **Create the Database**:
   - Open pgAdmin and create a new database called `laravel`.

3. **Frontend Setup**:
   - Navigate to the vue directory:
     ```bash
     cd vue
     ```
   - Install dependencies:
     ```bash
     npm install
     ```
   - Run the development server:
     ```bash
     npm run serve
     ```

4. **Backend Setup**:
   - Navigate to the laravel directory:
     ```bash
     cd laravel
     ```
   - Install dependencies using Composer:
     ```bash
     composer install
     ```
   - Set up your `.env` file with PostgreSQL credentials:
     ```
     DB_CONNECTION=pgsql
     DB_HOST=127.0.0.1
     DB_PORT=5432
     DB_DATABASE=laravel
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```
   - Run migrations to set up the database:
     ```bash
     php artisan migrate
     ```
   - Start the Laravel server:
     ```bash
     php artisan serve
     ```

### Usage

- Access the application in your web browser at `http://localhost:5173` (or the port specified by the Vue.js dev server).
- Use the application to manage orders and products.
