# Hello World API: Lumen + PHP Sample

This sample uses [Auth0 PHP SDK](https://github.com/auth0/auth0-php) to implement the following security task:

The `add-rbac` branch offers a working API server that exposes a public endpoint along with two protected endpoints. Each endpoint returns a different type of message: public, protected, and admin.

The `GET /api/messages/protected` and `GET /api/messages/admin` endpoints are protected against unauthorized access. Any requests that contain a valid access token in their authorization header can access the protected and admin data.

Additionally, the `GET /api/messages/admin` endpoint requires the access tokens to contain a `read:admin-messages` permission in order to access the admin data, which is referred to as [Role-Based Access Control (RBAC)](https://auth0.com/docs/authorization/rbac/).

## Quick Auth0 Set Up

### Set up the project

Install the project dependencies:

```bash
composer install
```

Create `.env` file under the project directory:

```bash
touch .env
```

Populate `.env` as follows:

```bash
API_SERVER_PORT=6060
CLIENT_ORIGIN_URL=http://localhost:4040
AUTH0_AUDIENCE=
AUTH0_DOMAIN=
```

You can alternatively use the provided sample `.env.example` file as base:

```bash
cp .env.example .env
```


PS: The values needed for `AUTH0_AUDIENCE` and `AUTH0_DOMAIN` are described in the section "[Connect Lumen with Auth0](README.md#user-content-connect-lumen-with-auth0)".


### Register a Lumen API with Auth0

- Open the [APIs](https://manage.auth0.com/#/apis) section of the Auth0 Dashboard.

- Click on the **Create API** button.

- Provide a **Name** value such as _Hello World API Server_.

- Set its **Identifier** to `https://api.example.com` or any other value of your liking.

- Leave the signing algorithm as `RS256` as it's the best option from a security standpoint.

- Click on the **Create** button.

> View ["Register APIs" document](https://auth0.com/docs/get-started/set-up-apis) for more details.

### Connect Lumen with Auth0

Get the values for `AUTH0_AUDIENCE` and `AUTH0_DOMAIN` in `.env` from your Auth0 API in the Dashboard.

Head back to your Auth0 API page, and **follow these steps to get the Auth0 Audience**:

![Get the Auth0 Audience to configure an API](https://cdn.auth0.com/blog/complete-guide-to-user-authentication/get-the-auth0-audience.png)

1. Click on the **"Settings"** tab.

2. Locate the **"Identifier"** field and copy its value.

3. Paste the "Identifier" value as the value of `AUTH0_AUDIENCE` in `.env`.

Now, **follow these steps to get the Auth0 Domain value**:

![Get the Auth0 Domain to configure an API](https://cdn.auth0.com/blog/complete-guide-to-user-authentication/get-the-auth0-domain.png)

1. Click on the **"Test"** tab.
2. Locate the section called **"Asking Auth0 for tokens from my application"**.
3. Click on the **cURL** tab to show a mock `POST` request.
4. Copy your Auth0 domain, which is _part_ of the `--url` parameter value: `tenant-name.region.auth0.com`.
5. Paste the Auth0 domain value as the value of `AUTH0_DOMAIN` in `.env`.

**Tips to get the Auth0 Domain**

- The Auth0 Domain is the substring between the protocol, `https://` and the path `/oauth/token`.

- The Auth0 Domain follows this pattern: `tenant-name.region.auth0.com`.

- The `region` subdomain (`au`, `us`, or `eu`) is optional. Some Auth0 Domains don't have it.

### Run the project

With the `.env` configuration values set, run the API server by issuing the following command:

```bash
php -S localhost:6060 -t public
```

## Test the Protected Endpoints

You can get an access token from the Auth0 Dashboard to test making a secure call to your protected API endpoints.

1. Head back to your Auth0 API page and click on the "Test" tab.

1. Locate the section called "Sending the token to the API".

1. Click on the cURL tab of the code box.

1. Copy the sample cURL command:

    ```bash
    curl --request GET \
    --url http://path_to_your_api/ \
    --header 'authorization: Bearer really-long-string-which-is-test-your-access-token'
    ```

Replace the value of `http://path_to_your_api/` with your protected API endpoint path (you can find all the available API endpoints in the next section) and execute the command. You should receive back a successful response from the server.

You can try out any of our full stack demos to see the client-server Auth0 workflow in action using your preferred front-end and back-end technologies.

## Test the Admin Endpoint

The `GET /api/messages/admin` endpoint requires the access token to contain the `read:admin-messages` permission. The best way to simulate that client-server secured request is to use any of the Hello World client demo apps to log in as a user that has that permission.

You can use the Auth0 Dashboard to create an `admin` role and assign it the`read:admin-messages` permission. Then, you can assign the `admin` role to any user that you want to access the `/admin` endpoint.

If you need help doing so, check out the following resources:

- [Create roles](https://auth0.com/docs/authorization/rbac/roles/create-roles)

- [Create permissions](https://auth0.com/docs/get-started/dashboard/add-api-permissions)

- [Add permissions to roles](https://auth0.com/docs/authorization/rbac/roles/add-permissions-to-roles)

- [Assign roles to users](https://auth0.com/docs/users/assign-roles-to-users)

## API Endpoints

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
  "message": "The API doesn't require an access token to share this message."
}
```

> 🔐 Protected Endpoints: These endpoints require the request to include an access token issued by Auth0 in the authorization header.

### 🔐 Get protected message

```bash
GET /api/messages/protected
```

#### Response

```bash
Status: 200 OK
```

```json
{
  "message": "The API successfully validated your access token."
}
```

### 🔐 Get admin message

> Requires the user to have the `read:admin-messages` permission.

```bash
GET /api/messages/admin
```

#### Response

```bash
Status: 200 OK
```

```json
{
  "message": "The API successfully recognized you as an admin."
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

## [Optional] Add Cache to Your Project

For performance reasons, [Auth0 PHP SDK](https://github.com/auth0/auth0-php) supports (and recommends) using a [PSR-6 Compatible Caching Library](https://www.php-fig.org/psr/psr-6/). The library will be used to temporarily store [JWKS](https://auth0.com/docs/security/tokens/json-web-tokens/json-web-key-sets) public keys. Adding this cache layer avoids making a request to `AUTH0_DOMAIN` everytime you need to verify a token.

To add cache to this project, you'll need to do the following:

1. Add [`symfony/cache`](https://symfony.com/doc/current/components/cache.html) dependency:
    ```bash
    composer require symfony/cache
    ```
    This library is required because it provides an [adapter](https://symfony.com/doc/current/components/cache/psr6_psr16_adapters.html) needed to wrap [Lumen's cache](https://lumen.laravel.com/docs/8.x/cache) as a PSR-6 compatible interface required by Auth0 PHP SDK.

1. Set your cache driver on your `.env` file:
    ```bash
    CACHE_DRIVER=file
    ```
    Lumen supports a wide variety of the cache drivers. Please refer to its [documentation](https://lumen.laravel.com/docs/8.x/cache) for more details.
1. Create a config file for your cache under `config/cache.php`:
    ```php
    <?php

    return [
        'default' => env('CACHE_DRIVER'),
        'stores' => [
            'file' => [
                'driver' => 'file',
                'path' => env('CACHE_PATH', storage_path('framework/cache')),
            ],
        ],
    ];
    ```
    This configuration will differ if you use a different driver. Again, check [Lumen's documentation](https://lumen.laravel.com/docs/8.x/cache) for more details about how to configure a different driver.

3. Change your `bootstrap/app.php` in order to make your config file available for Lumen:
    ```php
    <?php
    //...

    // Make cache config file available for the application
    $app->configure('cache');

    //...
    ```
4. Add `useCache` to enable cache for Auth0 on `config/auth0.php`:
    ```php
    <?php
    return [
        'domain' => env('AUTH0_DOMAIN'),
        'audience' => [ env('AUTH0_AUDIENCE') ],
        'useCache' => true // Add this line
    ];
    //...
    ```

## Code Sample Specs
This code sample uses the following main tooling versions:

- Lumen v8.3.1
- PHP v7.4.25
- Auth0 PHP SDK v8.0.3

The Lumen project dependency installations were tested with Composer v2.1.14.
