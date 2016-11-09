<?php

namespace App\Dogs\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAllAction(Request $request, Application $app)
    {
        $dogs = $app['repository.dog']->getAll();

        return $app['twig']->render('alldogs.list.html.twig', array('dogs' => $dogs));
    }
    
    public function listByOwnerAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $user = $app['repository.user']->getById($parameters['id']);
        $dogs = $app['repository.dog']->getByOwner($user);
        
        
        return $app['twig']->render('dogsbyuser.list.html.twig', array('user'=>$user, 'dogs' => $dogs));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.dog']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('dogs.listall'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $dog = $app['repository.dog']->getById($parameters['id']);

        return $app['twig']->render('dogs.form.html.twig', array('dog' => $dog));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $dog = $app['repository.dog']->update($parameters);
        } else {
            $dog = $app['repository.dog']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('users.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('dogs.form.html.twig');
    }
    
    public function newFromUserAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $user = $app['repository.user']->getById($parameters['id']);

        return $app['twig']->render('newdog.form.html.twig', array('user' => $user));
    }
}

