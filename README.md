## Requirements

*   PHP >= 8.2
*   Composer


1.  **Clone the repository (or extract the ZIP file).**
  cd movie-library
  
2.  **Install PHP Dependencies.**
    composer install
    
3.  **Configure Environment.**
    php artisan key:generate
    
4.  **Create Database File and Run Migrations.**
    php artisan migrate
    
6.  **Run the Application.**
    php artisan serve
  The application will be available at `http://127.0.0.1:8000`.
  
## Usage
*   **Public Catalog:** Access the home page (`/`) to view the movie catalog.
*   **Admin Panel:** Access the admin interface at `/movies` to manage movies.
*   **Import:** Use the "Import from OMDb" option in the admin panel to search and import movies.
