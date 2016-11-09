<?php

$app->get('/lignes/list', 'App\Lignes\Controller\IndexController::listAction')->bind('lignes.list');
$app->get('/lignes/edit/{id}', 'App\Lignes\Controller\IndexController::editAction')->bind('lignes.edit');
$app->get('/lignes/new', 'App\Lignes\Controller\IndexController::newAction')->bind('lignes.new');
$app->post('/lignes/delete/{id}', 'App\Lignes\Controller\IndexController::deleteAction')->bind('lignes.delete');
$app->post('/lignes/save', 'App\Lignes\Controller\IndexController::saveAction')->bind('lignes.save');
$app->get('/lignes/nom','App\Lignes\Controller\IndexController::listNom')->bind('/lignes/nom');

$app->get('/stops/listall', 'App\Stops\Controller\IndexController::listAllAction')->bind('stops.listall');
$app->get('/stops/list/{id}', 'App\Stops\Controller\IndexController::listByOwnerAction')->bind('stops.byligne');
$app->get('/stops/edit/{id}', 'App\Stops\Controller\IndexController::editAction')->bind('stops.edit');
$app->get('/stops/new', 'App\Stops\Controller\IndexController::newAction')->bind('stops.new');
$app->get('/stops/newfromligne/{id}', 'App\Stops\Controller\IndexController::newFromligneAction')->bind('stops.newfromligne');
$app->post('/stops/delete/{id}', 'App\Stops\Controller\IndexController::deleteAction')->bind('stops.delete');
$app->post('/stops/save', 'App\Stops\Controller\IndexController::saveAction')->bind('stops.save');
