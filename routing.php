<?php

// Load the routes configuration
$routes = include 'routes.php';

// Get the current URL path
$request = $_SERVER['REQUEST_URI'];

// Remove query string for simpler routing
$request = strtok($request, '?');

// Check if the request is for an image in the "image" folder
if (preg_match('/^\/image\/(.+)\/?$/', $request, $matches)) {
    $filename = $matches[1];
    $file_path = __DIR__ . "/image/" . $filename;

    // Check if the file exists in the image folder
    if (file_exists($file_path)) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        header('Content-Type: image/' . $ext);
        header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
        readfile($file_path);
        exit;
    } else {
        // If the image file does not exist, return a 404 error
        http_response_code(404);
        echo "404 Not Found";
        exit;
    }
}

// Check if the request is for an image in the "image" folder
if (preg_match('/^\/css\/(.+)\/?$/', $request, $matches)) {
    $filename = $matches[1];
    $file_path = __DIR__ . "/css/" . $filename;

    // Check if the file exists in the image folder
    if (file_exists($file_path)) {
        header('Content-Type: text/css');
        header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
        readfile($file_path);
        exit;
    } else {
        // If the image file does not exist, return a 404 error
        http_response_code(404);
        echo "404 Not Found";
        exit;
    }
}

// Check if the request is for an js in the "js" folder
if (preg_match('/^\/js\/(.+)\/?$/', $request, $matches)) {
    $filename = $matches[1];
    $file_path = __DIR__ . "/js/" . $filename;

    // Check if the file exists in the js folder
    if (file_exists($file_path)) {
        header('Content-Type: application/javascript');
        header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
        readfile($file_path);
        exit;
    } else {
        // If the js file does not exist, return a 404 error
        http_response_code(404);
        echo "404 Not Found";
        exit;
    }
}

// Check if the request matches a defined route
if (array_key_exists($request, $routes)) {
    // If the route exists, include the corresponding file
    include $routes[$request];
} else {
    // If the route does not exist, return a 404 error
    http_response_code(404);
    echo "404 Not Found";
}

?>