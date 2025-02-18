<?php

namespace App\Stops\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAllAction(Request $request, Application $app)
    {
        $stops = $app['repository.stop']->getAll();

        return $app['twig']->render('allstops.list.html.twig', array('stops' => $stops));
    }
    
    public function listByOwnerAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $ligne = $app['repository.ligne']->getById($parameters['id']);
        $stops = $app['repository.stop']->getByOwner($ligne);
        
        
        return $app['twig']->render('stopsbyligne.list.html.twig', array('ligne'=>$ligne, 'stops' => $stops));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.stop']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('stops.listall'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $stop = $app['repository.stop']->getById($parameters['id']);

        return $app['twig']->render('stops.form.html.twig', array('stop' => $stop));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $stop = $app['repository.stop']->update($parameters);
        } else {
            $stop = $app['repository.stop']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('lignes.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('stops.form.html.twig');
    }
    
    public function newFromligneAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $ligne = $app['repository.ligne']->getById($parameters['id']);

        return $app['twig']->render('newstop.form.html.twig', array('ligne' => $ligne));
    }
    
    //FONCTIONS API
    public function listStops(Application $app)
    {
        $stops = $app['repository.stop']->getAll();  
      
        //$ligne = $app['repository.ligne']->findAll();
        $responseData = array();
        foreach ($stops as $stop) {
            $responseData[] = array(
                'id'=>$stop->getId(),
                'nom'=> $stop->getNom(),
                'nomLigne'=>$stop->getNomLigne(),
                'latitude'=>$stop->getLatitude(),
                'longitude'=>$stop->getLongitude()
            );
        }
  
        return $app->json($responseData);
   }
   
   public function horairesByStopAction(Application $app, $id)
    {
       
        $horaires = $app['repository.stop']->getHorairesByArret($id);  
      
        //$ligne = $app['repository.ligne']->findAll();
        
        $responseData = array();
        $i = 0;
        if(!empty($responseData)){
            foreach ($horaires as $horaire) {
                $i++;
                $responseData[] = array(
                    'id'=>$horaire->getId(),
                    'id arret'=> $horaire->getArret(),
                    'heure'=>$horaire->getHeure()
                );
            }
            return $app->json($responseData);
        }else{
            $responseData[] = array('Pas d\'horaires renseigné');
            return $app->json($responseData);
        }
   }
   
   public function searchAction(Application $app, $idStop)
    {
       $heure = date('H:i:s');
        $horaireNextArret = $app['repository.stop']->getProHoraireByArret( $idStop,$heure);  
      
        $responseData[] = array(
                'Prochaine horaire'=>$horaireNextArret
                
           );
        
  
        return $app->json($responseData);
   }
   
   public function seeAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $stop = $app['repository.stop']->getById($parameters['id']);

        return $app['twig']->render('arretpro.form.html.twig', array('stop' => $stop));
   }
   
   
   public function findNextTimeByStopAndTimeAction(Request $request, Application $app)
   {
       $parameters = $request->attributes->all();
        $stop = $app['repository.stop']->getById($parameters['id']);
        $horaires = $app['repository.stop']->getHorairesByArret($parameters['id']);
       
       return $app['twig']->render('findNextTime.html.twig', array('stop' => $stop, 'horaires'=>$horaires));
   }
 
   
   public function seeNextTimeByStopAndTimeAction(Request $request, Application $app)
   {
       $parameters = $request->request->all();
        $stop = $app['repository.stop']->getById($parameters['id']);
       $horaire = $app['repository.stop']->getHoraireById($parameters['horaire']);
       $nextStop = $app['repository.stop']->getById($parameters['nextstop']);
       
       $arrivedHoraire = $app['repository.stop']->getNextTimeByStop($horaire, $nextStop);
       
       if($stop == null || $horaire == null || $nextStop == null)
           return 403;
       
        $responseData[] = array(
            'arret de depart'=>$stop->getNom(),
            'heure de depart'=>$horaire->getHeure(),
            'Prochain arret'=>$nextStop->getNom(),
            'heure d arrivee'=>$arrivedHoraire->getHeure()    
        );
               
       return $app->json($responseData);
   }

}

