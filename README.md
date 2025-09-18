# Digital Library Management System

This project is a web application built with the CodeIgniter 4 framework for managing a digital library of manuscripts, rare books, catalogues, and periodicals. It provides a complete workflow for the submission, review, approval, and publication of digital assets.

## Core Features

- **Multi-step Document Workflow**: Documents go through a multi-stage review process involving different user roles.
- **User Role Management**: The system is designed with distinct user roles, each with specific permissions and responsibilities.
- **Public-Facing Portal**: Published documents are available for public viewing and searching.
- **Digital Asset Management**: Handles the upload and storage of digital files associated with each record.

## User Roles

The application workflow is managed by four distinct user roles:

1.  **AMR (Accessioning and Metadata Recording)**: This user is responsible for the initial data entry and submission of new documents (manuscripts, rare books, etc.) into the system.
2.  **Supervisor**: The supervisor reviews the documents submitted by the AMR user. They can approve or reject submissions, providing remarks as needed.
3.  **Cataloguer**: Once a document is approved by a supervisor, it is passed to the cataloguer. The cataloguer performs a second level of review and can approve or reject the document, adding their own remarks.
4.  **Registrar**: The registrar has access to the final, fully approved documents. They can view and download the published digital assets.

## Setup Instructions

Follow these steps to set up the project for local development.

### 1. Server Requirements

- PHP version 7.4 or higher
- The following PHP extensions installed and enabled:
    - `intl`
    - `mbstring`
    - `json`
    - `mysqlnd` (for MySQL)
    - `libcurl`

### 2. Installation

1.  **Clone the repository:**
    ```bash
    git clone <repository-url>
    cd <repository-directory>
    ```

2.  **Install dependencies:**
    This project uses Composer to manage its dependencies.
    ```bash
    composer install
    ```

### 3. Configuration

1.  **Database Setup:**
    - Create a MySQL database for the project. For example, `amar`.
    - Import the database schema and data from the provided SQL file (if available). The application expects tables like `users`, `manuscripts_m`, `rare_books1`, etc.
    - Configure the database connection in `app/Config/Database.php`. Update the `default` connection group with your database credentials:
      ```php
      public array $default = [
          'DSN'      => '',
          'hostname' => 'localhost',
          'username' => 'your_db_username',
          'password' => 'your_db_password',
          'database' => 'amar',
          // ...
      ];
      ```

2.  **Base URL:**
    - Open `app/Config/App.php`.
    - Set the `$baseURL` to your local development URL. Make sure it includes a trailing slash:
      ```php
      public string $baseURL = 'http://localhost/your-project-directory/';
      ```

### 4. Running the Application

You can run the application using CodeIgniter's built-in development server:

```bash
php spark serve
```

The application will be available at `http://localhost:8080`.

## Usage

1.  **Login**: Access the admin login page at `http://localhost:8080/admin/login`.
2.  **Credentials**: Use the credentials for one of the user roles (AMR, Supervisor, Cataloguer, Registrar) to log in.
3.  **Dashboard**: After logging in, you will be redirected to the appropriate dashboard for your user role, where you can perform your designated tasks in the document workflow.
4.  **Public Site**: The public-facing site can be accessed at the base URL, where you can search and view published documents.
