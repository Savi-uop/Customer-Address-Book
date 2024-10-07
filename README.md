# Customer Address Book

A Laravel-based application for managing customer information, projects, and their associated addresses. The application allows users to register, log in, and manage customers and projects using an intuitive interface and API integration.

## Features

- User registration and login with authentication using Laravel Passport (API tokens).
- CRUD operations for managing customers, projects, and addresses.
- Multi-address support for customers with the ability to add, edit, and remove addresses.
- Secure authentication flow with CSRF protection for API requests.
- Dynamic frontend using AJAX and Bootstrap for smooth user interactions.
- Pagination support for listing customers and projects.

## Technologies Used

- **Backend**: Laravel 8
- **Frontend**: Bootstrap 5, jQuery
- **Authentication**: Laravel Passport for API tokens
- **Database**: MySQL
- **Other Tools**: jQuery, AJAX

## Prerequisites

Ensure you have the following installed:

- PHP >= 7.4
- Composer
- MySQL
- Node.js & npm
- Laravel CLI

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/customer-address-book.git
   cd customer-address-book
   
2. Install Dependencies:
   composer install
    npm install

3. Update the .env file with your database credentials and other necessary configurations:
   DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=customer_address_book
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    
    # Passport settings
    PASSPORT_CLIENT_ID=your_client_id
    PASSPORT_CLIENT_SECRET=your_client_secret
