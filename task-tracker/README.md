# Task Tracker Module (Core PHP)

This directory contains a minimal implementation of the Task Tracker System described in the functional specification. It is designed for a simple LAMP stack and includes:

- Basic admin login with session authentication
- CRUD pages for Users, Categories and Tasks
- Task comments
- Mobile friendly OTP login using MSG91 (requires real credentials)
- SQL schema file (`schema.sql`)

To set up:

1. Create a MySQL database named `task_tracker` and import `schema.sql`.
2. Update the database credentials in `config.php`.
3. Place this folder on a PHP-enabled server and browse to `login.php` for admin access or `mobile_login.html` for front-end OTP login.

This module is intentionally simple and omits advanced error handling and styling but provides a starting point for customization.
