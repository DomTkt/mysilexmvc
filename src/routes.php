<?php
//ligne part
$app->get('/lignes/list', 'App\Lignes\Controller\IndexController::listAction')->bind('lignes.list');
$app->get('/lignes/edit/{id}', 'App\Lignes\Controller\IndexController::editAction')->bind('lignes.edit');
$app->get('/lignes/new', 'App\Lignes\Controller\IndexController::newAction')->bind('lignes.new');
$app->post('/lignes/delete/{id}', 'App\Lignes\Controller\IndexController::deleteAction')->bind('lignes.delete');
$app->post('/lignes/save', 'App\Lignes\Controller\IndexController::saveAction')->bind('lignes.save');
//api ligne
$app->get('/lignes/nom','App\Lignes\Controller\IndexController::listNom')->bind('/lignes/nom');


//stop part
$app->get('/stops/listall', 'App\Stops\Controller\IndexController::listAllAction')->bind('stops.listall');
$app->get('/stops/list/{id}', 'App\Stops\Controller\IndexController::listByOwnerAction')->bind('stops.byligne');
$app->get('/stops/edit/{id}', 'App\Stops\Controller\IndexController::editAction')->bind('stops.edit');
$app->get('/stops/new', 'App\Stops\Controller\IndexController::newAction')->bind('stops.new');
$app->get('/stops/newfromligne/{id}', 'App\Stops\Controller\IndexController::newFromligneAction')->bind('stops.newfromligne');
$app->post('/stops/delete/{id}', 'App\Stops\Controller\IndexController::deleteAction')->bind('stops.delete');
$app->post('/stops/save', 'App\Stops\Controller\IndexController::saveAction')->bind('stops.save');
//api stop
$app->get('/stops/all','App\Stops\Controller\IndexController::listStops')->bind('/stops/all');
$app->get('/stops/horaires/{id}','App\Stops\Controller\IndexController::horairesByStopAction')->bind('stops.horaires');
$app->get('/stops/search/{idStop}','App\Stops\Controller\IndexController::searchAction')->bind('stops.search');
$app->get('/stops/find/{id}','App\Stops\Controller\IndexController::findNextTimeByStopAndTimeAction')->bind('stops.find');
$app->post('/stops/seenext/{id}','App\Stops\Controller\IndexController::seeNextTimeByStopAndTimeAction')->bind('stops.seenext');
$app->get('/stops/see/{id}','App\Stops\Controller\IndexController::seeAction')->bind('stops.see');

