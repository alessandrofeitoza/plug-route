<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

use \PlugRoute\PlugRoute;

/**** CORS ****/
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Content-Type");
/**** CORS ****/

$route = new PlugRoute();

$route->any('/', function ($request) {
    var_dump($request->all());
    echo 'Hello World!';
});

$route->get('/sport/{something}', function ($request) {
    echo $request->getUrlBodyWith('something');
});

$route->post('/people', function ($request) {
    var_dump($request->all());
});

$route->put('/people/{id}', function ($request, $response) {
    $id = $request->getUrlBodyWith('id');
    echo $response->responseAsJson(['id' => $id]);
});

$route->delete('/people/{id}', function ($request) {
    echo $request->getUrlBodyWith('id');
});

$route->patch('/people/{id}', function ($request) {
    echo $request->getUrlBodyWith('id');
});

$route->any('/url', function () {
   echo 'Receive type requests GET, POST, PUT, PATCH and DELETE';
});

$route->group('/news', function($route) {
    $route->get('/', function() {
        echo 'Home news';
    });

    $route->get('/{something}', function($request) {
        echo $request->getUrlBodyWith('something');
    });
});

$route->any('/url', '\NAMESPACE\YOUR_CLASS@method');

$route->on();