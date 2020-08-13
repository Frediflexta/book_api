# Book_Api

To Setup the project, please follow these steps:

 - clone repo`git clone <repo address>`
 - set up DB by configuring your  `.env` I used PostgreSQL
 - run `composer install` 
 - run `php artisan migrate:refresh --seed` . This runs migrations and seeds DB
 - run `php artisan fetch:data` this command calls the *Ice and Fire Api* and processes the data to be stored a DB.(I did this for performance issues, I am happy to answer any questions regarding this) 
 - run `php artisan serve`
- Use an Api client of your choice, I use Insomnia to visit the routes.



## Testing Apis

|Method                |URI                        
|----------------|-------------------------------|
|GET|`localhost:8000/api/external-books?name=:nameOfBook`|
|POST          |`localhost:8000/api/v1/books`            |
|GET          |`localhost:8000/api/v1/books`|
|PUT         | `localhost:8000/api/v1/books/{book}`|
| DELETE      | `localhost:8000/api/v1/books/{book}`|
| GET         | `localhost:8000/api/v1/books/{book}`|
|-------------|-------------------------------------|
