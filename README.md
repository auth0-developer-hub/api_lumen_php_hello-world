# Hello World API: Lumen + PHP Sample

You can use this sample project to learn how to secure a simple API server using [Auth0](https://auth0.com/) and [Lumen](https://lumen.laravel.com/) framework.

The `starter` branch offers a working API server that exposes three public endpoints. Each endpoint returns a different type of message: public, protected, and admin.

The goal is to use Auth0 to only allow requests that contain a valid access token in their authorization header to access the protected and admin data. Additionally, only access tokens that contain a `read:admin-messages` permission should access the admin data, which is referred to as [Role-Based Access Control (RBAC)](https://auth0.com/docs/authorization/rbac/).

[Check out the `add-authorization` branch]() to see authorization in action using Auth0.

[Check out the `add-rbac` branch]() to see authorization and Role-Based Access Control (RBAC) in action using Auth0.

This project has the following dependencies, most of them are inherited from [Lumen's](https://lumen.laravel.com/docs/8.x):

- PHP 7.4+
- [DOM PHP Extension](https://www.php.net/manual/en/book.dom.php) (Required by Lumen's dependencies)
- [OpenSSL PHP Extension](https://www.php.net/manual/en/book.openssl.php) (Required by Lumen)
- [PDO PHP Extension](https://www.php.net/manual/en/book.pdo.php) (Required by Lumen)
- [Mbstring PHP Extension](https://www.php.net/manual/en/book.mbstring.php) (Required by Lumen)
- [Composer](Composer) (To install dependencies)
- [fruitcake/laravel-cors](https://github.com/fruitcake/laravel-cors) (Library that provides CORS features)


## Get Started


To get the project up and running, you'll need to:

1. Create a `.env` file with two required variables — `PORT` and `CLIENT_ORIGIN_URL`:

```bash
echo $'PORT=6060\nCLIENT_ORIGIN_URL=http://localhost:4040' > .env
```

We also provide an example on the `.env.example` file. If you want to use it instead, just make a copy of it:

```bash
cp .env.example .env
```

Feel free to change the default values to meet your needs.

2. Install the project dependencies:

```bash
composer install
```

3. Run the project:

```bash
php -S localhost:6060 -t public
```

Those commands should be executed from the project's root folder.

## API Endpoints

The API server defines the following endpoints:

### 🔓 Get public message

```bash
GET /api/messages/public
```

#### Response

```bash
Status: 200 OK
```

```json
{
  "text": "The API doesn't require an access token to share this message."
}
```

### 🔓 Get protected message

> You need to protect this endpoint using Auth0.

```bash
GET /api/messages/protected
```

#### Response

```bash
Status: 200 OK
```

```json
{
  "text": "The API successfully validated your access token."
}
```

### 🔓 Get admin message

> You need to protect this endpoint using Auth0 and Role-Based Access Control (RBAC).

```bash
GET /api/messages/admin
```

#### Response

```bash
Status: 200 OK
```

```json
{
  "text": "The API successfully recognized you as an admin."
}
```

## Error Handling

### 400s errors

#### Response

```bash
Status: Corresponding 400 status code
```

```json
{
  "message": "Message that describes the error that took place."
}
```

### 500s errors

#### Response

```bash
Status: 500 Internal Server Error
```

```json
{
  "message": "Message that describes the error that took place."
}
```

## Code Sample Specs
This code sample uses the following main tooling versions:

- Lumen v8.3.1
- PHP v7.4.25
- Auth0 PHP SDK v8.0.3

The Lumen project dependency installations were tested with Composer v2.1.14.
