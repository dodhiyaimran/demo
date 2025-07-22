# Task Tracker OOP Version

This directory contains a simple object-oriented rewrite of the Task Tracker example. It uses Bootstrap 5 for styling and organizes core functionality in PHP classes. User accounts and tasks are managed through small PHP classes.

## Setup

1. Create a MySQL database `task_tracker` and import the schema from the original module (`task-tracker/schema.sql`).
2. Adjust credentials in `inc/Database.php` if necessary.
3. Place the folder on a PHP-enabled server and open `login.php` to log in via OTP.
   Admin users are redirected to the dashboard while normal users see their task list.
4. Once logged in as admin you can manage users from `users.php` (paginated list) and add/edit via `user_form.php`, categories from `categories.php` and tasks from `tasks.php`.

The MSG91 OTP integration is represented as a placeholder in `inc/Otp.php`.
