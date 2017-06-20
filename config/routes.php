<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/', 'check_logged_in', function() {
    TaskController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->post('/task/:id/destroy', 'check_logged_in', function($id) {
    // Pelin poisto
    TaskController::destroy($id);
});

$routes->get('/task/:id/edit', 'check_logged_in', function($id) {
    // Pelin muokkauslomakkeen esittäminen
    TaskController::edit($id);
});

$routes->post('/task/:id/edit', 'check_logged_in', function($id) {
    // Pelin muokkaaminen
    TaskController::update($id);
});

$routes->get('/task', 'check_logged_in', function() {
    TaskController::index();
});

$routes->post('/task', 'check_logged_in', function() {
    TaskController::store();
});
// Pelin lisäyslomakkeen näyttäminen
$routes->get('/task/new', 'check_logged_in', function() {
    TaskController::create();
});

$routes->get('/task/:id', 'check_logged_in', function($id) {
    TaskController::show($id);
});

$routes->get('/login', function() {
    // Kirjautumislomakkeen esittäminen
    OwnerController::login();
});
$routes->post('/login', function() {
    // Kirjautumisen käsittely
    OwnerController::handle_login();
});

$routes->post('/logout', 'check_logged_in', function() {
    OwnerController::logout();
});
$routes->get('/signup', function() {
    // Kirjautumislomakkeen esittäminen
    OwnerController::signup();
});
$routes->post('/signup', function() {
    // Kirjautumislomakkeen esittäminen
    OwnerController::handle_signup();
});
$routes->get('/priority/new', 'check_logged_in', function() {
    // Kirjautumislomakkeen esittäminen
    PriorityController::create();
});
$routes->post('/priority', 'check_logged_in', function() {
    // Kirjautumislomakkeen esittäminen
    PriorityController::store();
});

$routes->get('/tag/new', 'check_logged_in', function() {
    // Kirjautumislomakkeen esittäminen
    TagController::create();
});
$routes->post('/tag', 'check_logged_in', function() {
    // Kirjautumislomakkeen esittäminen
    TagController::store();
});
$routes->get('/tag/:id', 'check_logged_in', function($id) {
    TagController::list_tasks($id);
});