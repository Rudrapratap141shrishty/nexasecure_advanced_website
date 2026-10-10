# NexaSecure Advanced Website

## Stack
- HTML5
- CSS3
- JavaScript
- Bootstrap 5
- PHP 8+
- MySQL
- Chart.js

## Features
- Responsive cybersecurity dashboard
- Dark/light theme
- Threat analytics chart
- Threat search/filter
- Security scan simulation
- Threat detail modal
- Live-style alert panel
- PHP API endpoint
- MySQL schema
- PDO prepared statements
- Responsive Bootstrap components

## Run with XAMPP
1. Install XAMPP.
2. Copy the `nexasecure_website` folder into `C:/xampp/htdocs/`.
3. Start Apache and MySQL.
4. Open phpMyAdmin.
5. Import `database/schema.sql`.
6. Check `config.php` credentials. Default XAMPP is root with an empty password.
7. Open:
   http://localhost/nexasecure_website/

## PHP API example
POST to:
api/contact.php

Fields:
name, email, message

## Security notes
This is a development/demo project. For production, add CSRF protection, authentication/session hardening, server-side authorization, rate limiting, secure headers, HTTPS, secret management, validation, logging and proper error handling.
