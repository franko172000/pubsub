# Simple publisher subscriber application
# One time startup
```bash
 bash server.sh
```
# Manual publisher setup
1. cd publisher to folder and run the following commands
Install dependencies
```bash
 Composer install
```
Generate Encryption key
```bash
 php artisan key:gen
```
Start Application
```bash
 php artisan serve
```
# Run unit test
```bash
 ./vendor/bin/phpunit
```
# Manual Subscriber setup
cd to subscriber1 and Install dependencies
```bash
 yarn install or npm install
```
start server
```bash
 yarn start or npm start
```
# Start Redis server
Fron root directory, run

```bash
 docker-compose up -d
```
# Publisher Endpoint
1. POST - http://localhost:8000/api/pulisher/{topic}
# Subscriber Endpoint
2. POST - http://localhost:3000/api/v1/subscriber/{topic}
# Author
Anyaso Franklin <br />
franko172000@gmail.com



