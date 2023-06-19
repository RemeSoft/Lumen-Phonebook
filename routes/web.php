<?php
$router->post('/registration', 'RegistrationController@onRegister');
$router->post('/login', 'LoginController@onLogin');
$router->post('/auth', [
    'middleware' => 'auth',
    'uses' => 'PhoneBookController@onInsert'
]);


$router->post('/phonebook', [
    'middleware' => 'auth',
    'uses' => 'PhoneBookController@onInsert'
]);
$router->get('/phonebook', [
    'middleware' => 'auth',
    'uses' => 'PhoneBookController@onSelect'
]);
$router->delete('/phonebook', [
    'middleware' => 'auth',
    'uses' => 'PhoneBookController@onDelete'
]);
