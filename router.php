<?php
require_once(__DIR__ . '/Controllers/SessionController.php');
require_once(__DIR__ . '/Controllers/AssignmentController.php');
//Aqui tenemos todas las rutas tanto para usuarios activos y no activos 
// estas tiene una funcion que se llamara dependiendo de la ruta que se visite
$routesActive = [
    '/' => function () {
        AssignmentController::index();
    },
    '/session/destroy' => function () {
        SessionController::destroy();
    },
    '/session/check' => function () {
        SessionController::check();
    },
    '/session/logout' => function () {
        SessionController::destroy();
    },
    '/assignment/show' => function () {
        AssignmentController::show();
    },
    '/assignment/create' => function () {
        AssignmentController::create();
    },
    '/assignment/store' => function () {
        AssignmentController::store();
    },
    '/assignment/edit' => function () {
        AssignmentController::edit();
    },
    '/assignment/update' => function () {
        AssignmentController::update();
    },
    '/assignment/delete' => function () {
        AssignmentController::delete();
    },
];
$routesInactive = [
    '/' => function () {
        SessionController::index();
    },
    '/session/create' => function () {
        SessionController::create();
    },
    '/session/store' => function () {
        SessionController::store();
    },
    '/session/init' => function () {
        SessionController::init();
    },
    '/session/check' => function () {
        SessionController::check();
    },
];
//- Esto llama al url correspondiente si existe y si no existe la nos manda a la raiz
session_start();

if (isset($_SESSION['name'])) {
    if (array_key_exists(ARRAYURL[0], $routesActive)) {
        $routesActive[ARRAYURL[0]]();
    } else {
        header("Location: " . baseurl('/'));
        exit();
    } 
} else {
    if (array_key_exists(ARRAYURL[0], $routesInactive)) {
        $routesInactive[ARRAYURL[0]]();
    } else {
        header("Location: " . baseurl('/'));
        exit();
    }
}


