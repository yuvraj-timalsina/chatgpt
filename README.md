
# ChatGPT Clone

 Laravel & AlpineJs ChatGPT Clone.

## Installation

Clone the project using SSH or HTTPS.

```bash
git@github.com:yuvraj-timalsina/chatgpt.git
```
    
## Run Locally

Go to the Project Directory

```bash
cd chatgpt
```

Create .env in root directory

```bash
cp .env.example .env
```

Add OPENAI_API_KEY in .env

```bash
OPENAI_API_KEY=sk-...
```

# Create and configure the Database

```bash
sudo mysql -u <username> -p
create database chatgpt;
```
Add Database Credentials in .env

```bash
DB_DATABASE=chatgpt
DB_USERNAME=<username>
DB_PASSWORD=<password>
```

# Install Dependencies

```bash
composer install
```

Generate Application Key

```bash
php artisan key:generate
```

Run the Database Migrations

```bash
php artisan migrate
```

# Run the Server

```bash
php artisan serve
  
http://127.0.0.1:8000
```

## Author

- [@yuvraj-timalsina](https://www.github.com/yuvraj-timalsina)
