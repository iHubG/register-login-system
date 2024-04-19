<?php 

    // Define your routes
    $routes = [
        '/tutorial/' => 'index',
        '/tutorial/login' => 'login',
        '/tutorial/register' => 'register',
        '/tutorial/table' => 'table',
        '/tutorial/router' => 'router',
        '/tutorial/login_process' => 'login_process',
        '/tutorial/register_validation' => 'register_validation',
    ];

    // Get the current URL
    $url = $_SERVER['REQUEST_URI'];

    // Remove query string from URL
    $url = strtok($url, '?');

    // Check if the requested route exists
    if (array_key_exists($url, $routes)) {
        // If the route exists, call the associated function or include the corresponding file
        $route = $routes[$url];
        switch ($route) {
            case 'index':
                require 'login.php'; // Include the file for the home page
                break;
            case 'login':
                require 'login.php'; // Include the file for the home page
                break;
            case 'register':
                require 'register.php'; // Include the file for the about page
                break;
            case 'table':
                require 'tablee.php'; // Include the file for the contact page
                break;
            case 'login_process':
                require 'login_process.php'; // Include the file for the contact page
                break;
            case 'register_validation':
                require 'register_validation.php'; // Include the file for the contact page
                break;
            // Add more routes as needed
            default:
                // Handle 404 error
                echo "404 - Page not found";
                break;
        }
    } else {
        // Handle 404 error
        echo "404 - Page not found";
    }
?>