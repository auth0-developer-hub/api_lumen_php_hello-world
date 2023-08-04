# Lumen/PHP: Starter API Code Sample

This PHP code sample demonstrates how to build an API server using Lumen that is secure by design.

Visit the ["Lumen/PHP Code Samples: API Security in Action"](https://developer.auth0.com/resources/code-samples/api/lumen) section of the ["Auth0 Developer Resources"](https://developer.auth0.com/resources) to explore how you can secure Lumen applications written in PHP by implementing endpoint protection and authorization with Auth0.

## Why Use Auth0?

Auth0 is a flexible drop-in solution to add authentication and authorization services to your applications. Your team and organization can avoid the cost, time, and risk that come with building your own solution to authenticate and authorize users. We offer tons of guidance and SDKs for you to get started and [integrate Auth0 into your stack easily](https://developer.auth0.com/resources/code-samples/full-stack).

## Set Up and Run the Lumen Project

Create a `.env` file under the root project directory:

```bash
touch .env
```

Populate it with the following environment variables:

```bash
PORT=6060
CLIENT_ORIGIN_URL=http://localhost:4040
```

Install the project's dependencies running the following command.

```bash
composer install
```

Run the Lumen API server using the following command:

```bash
php -S 127.0.0.1:6060 -t public
```
