<?php

namespace App\Lignes\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAction(Request $request, Application $app)
    {
        $lignes = $app['repository.ligne']->getAll();

        return $app['twig']->render('lignes.list.html.twig', array('lignes' => $lignes));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.ligne']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('lignes.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $ligne = $app['repository.ligne']->getById($parameters['id']);

        return $app['twig']->render('lignes.form.html.twig', array('ligne' => $ligne));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $ligne = $app['repository.ligne']->update($parameters);
        } else {
            $ligne = $app['repository.ligne']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('lignes.list'));
    }
    

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('lignes.form.html.twig');
    }
    
    public function listNom(Application $app)
   {
       $lignes = $app['repository.ligne']->getAll();  
      
       //$ligne = $app['repository.ligne']->findAll();
       $responseData = array();
   foreach ($lignes as $ligne) {
       $responseData[] = array(
           'nom'=> $ligne->getNom()
           );
       }
  
   return $app->json($responseData);
   }
}

