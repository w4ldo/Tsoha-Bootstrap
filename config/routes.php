<?php

$routes->get('/', function() {
    TaskController::index();
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

$routes->get('/task/:id/edit', function($id) {
    // Pelin muokkauslomakkeen esittäminen
    TaskController::edit($id);
});
$routes->post('/task/:id/edit', function($id) {
    // Pelin muokkaaminen
    TaskController::update($id);
});

$routes->post('/task/:id/destroy', function($id) {
    // Pelin poisto
    TaskController::destroy($id);
});
