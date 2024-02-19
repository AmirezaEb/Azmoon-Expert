<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/api/v2', function () use ($router){
    return $router->app->version();
});
