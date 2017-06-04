<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/task', function() {
    TaskController::index();
});

$routes->post('/task', function() {
    TaskController::store();
});
// Pelin lisäyslomakkeen näyttäminen
$routes->get('/task/new', function() {
    TaskController::create();
});

$routes->get('/task/:id', function($id) {
    TaskController::show($id);
});

$routes->get('/taskedit', function() {
    HelloWorldController::task_edit();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});
