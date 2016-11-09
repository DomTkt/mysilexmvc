<?php

$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');
$app->get('/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->get('/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->post('/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');
$app->get('/users/nom','App\Users\Controller\IndexController::listNom')->bind('/users/nom');

$app->get('/dogs/listall', 'App\Dogs\Controller\IndexController::listAllAction')->bind('dogs.listall');
$app->get('/dogs/list/{id}', 'App\Dogs\Controller\IndexController::listByOwnerAction')->bind('dogs.byuser');
$app->get('/dogs/edit/{id}', 'App\Dogs\Controller\IndexController::editAction')->bind('dogs.edit');
$app->get('/dogs/new', 'App\Dogs\Controller\IndexController::newAction')->bind('dogs.new');
$app->get('/dogs/newfromuser/{id}', 'App\Dogs\Controller\IndexController::newFromUserAction')->bind('dogs.newfromuser');
$app->post('/dogs/delete/{id}', 'App\Dogs\Controller\IndexController::deleteAction')->bind('dogs.delete');
$app->post('/dogs/save', 'App\Dogs\Controller\IndexController::saveAction')->bind('dogs.save');
