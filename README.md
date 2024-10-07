Laravel Blog Application
This is a simple blog application built with Laravel that allows users to create, manage, and view blog posts. It also includes an admin panel for managing users and posts.

Features
User registration and login.
Blog post creation with image uploads.
Search functionality for posts.
Role-based access control (Admin/User).
Admin panel for user and post management.
Pagination for posts and users.

Setup Steps

Here’s the Setup Steps section without commands:

Setup Steps
Clone the Repository:

Clone the project and navigate to the project directory.
Install Dependencies:

Install the PHP dependencies using Composer.
Install the front-end dependencies using npm.
Set Up Environment:

Copy the example environment configuration file and rename it to .env.
Update the .env file with your database credentials and other environment-specific details.
Generate Application Key:

Generate a unique application key for the project.
Migrate and Seed the Database:

Run the migrations to create the necessary tables in the database and seed the initial data.
Run the Application:

Start the development server to access the application locally.

Admin Panel
The admin panel is accessible only to users with admin privileges. It allows the admin to manage users and posts, including viewing, editing, and deleting users and their posts.

Admin route:

GET /admin: View and manage users.
DELETE /admin/users/{id}: Delete a user.
Additional Features
Role-Based Access Control: Only admins can access certain features (like the admin panel).
Post Management: Users can create, edit, and delete their own posts, while admins can manage all posts.
Search: Users can search for posts by title.
