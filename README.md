# OSN Web Project

A PHP/MySQL-based web application featuring user authentication, role management, and a content publishing system.

## Features
- **User Authentication:** Secure registration and login functionality.
- **Role-Based Access Control (RBAC):** Distinct roles for regular users, editors (`redaktor`), and administrators (`admin`).
- **Content Management:** Authorized users can create and view public posts.
- **Admin Dashboard:** Administrators can manage registered users.
- **Responsive UI:** Clean, custom CSS layout designed for both desktop and mobile devices.

## Setup Instructions

1. **Environment Setup:** Place the project folder into your local web server's document root (e.g., `htdocs` for XAMPP).
2. **Database Configuration:**
   - Create a new MySQL database.
   - Import the provided `databaze.sql` file to set up the necessary tables.
3. **Connection Settings:**
   - Open `includes/database.php` (or `includes/config.php`).
   - Update the PDO connection details (DB name, username, password) to match your local database environment.
4. **Launch:** Access the application through your web browser (e.g., `http://localhost/OSN_Web/`).
