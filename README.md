
# CapBay Mamak Test
This is the step-by-step guide on how to setup this app on localhost.

## Prerequisites

Before you begin, ensure you have met the following requirements:
- PHP 8.0 or higher
- Composer
- Node.js and NPM
- MySQL


## Step-by-step guide on setting up this test

1. Clone the Repository to your local machine using the following command:
```bash
git clone https://github.com/nhilya/capbay_mamak.git.
```
2. Create your .env file and copy the .env.example as follows;
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=capbay_test
DB_USERNAME=root
DB_PASSWORD=your-password-here
```
3. Install all dependencies that stated in the prequisites.

4. Generate the application key by run the following command:
```bash
php artisan key:generate
```
5. Set up the database by run the following command:
```bash
php artisan migrate
```
6. Seed the database for the Food Menu items:
```bash
php artisan db:seed
```
7. Serve the project by run the following command:
```bash
npm run dev
```
8. If you have the Laravel Valet configured on your machine, you can run the following command and go to the link:
```bash
valet park
```

Then, open your browser and go to:
```bash
http://capbay_test.test
```
Feel free to replace http://capbay_test.test with the actual domain you have configured for your Laravel valet setup.
    