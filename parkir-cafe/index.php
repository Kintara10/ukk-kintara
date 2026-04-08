<?php

// Start session
session_start();

// Define base URL
define('BASE_URL', 'http://localhost/parkir-cafe/');

// Autoload core classes
spl_autoload_register(function($class) {
    $paths = [
        __DIR__ . '/core/' . $class . '.php',
        __DIR__ . '/config/' . $class . '.php',
        __DIR__ . '/models/' . $class . '.php',
        __DIR__ . '/controllers/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Initialize database
Database::getInstance();

// Run application
$app = new App();
