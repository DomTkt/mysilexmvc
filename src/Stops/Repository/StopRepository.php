<?php

namespace App\Stops\Repository;

use App\Stops\Entity\Stop;
use App\Stops\Entity\Horaire;
use Doctrine\DBAL\Connection;

/**
 * stop repository.
 */
class StopRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

   /**
    * Returns a collection of lines.
    *
    * @param int $limit
    *   The number of lines to return.
    * @param int $offset
    *   The number of lines to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of lines, keyed by line id.
    */
   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('s.*')
           ->from('stops', 's');

       $statement = $queryBuilder->execute();
       $stopsData = $statement->fetchAll();
       foreach ($stopsData as $stopData) {
           $stopEntityList[$stopData['id']] = new stop($stopData['id'], $stopData['nom'], $stopData['nomligne'], $stopData['latitude'], $stopData['longitude']);
       }

       return $stopEntityList;
   }
   
   public function getHorairesByArret($id)
   {
       //$id = $stop->getId();
       $where = "arret = ".$id;
      
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('*')
           ->from('horaires')
           ->where($where);
           

       
       $statement = $queryBuilder->execute();
       $horaires = $statement->fetchAll();
       
       foreach ($horaires as $horaire) {
           
           $horaireList[$horaire['id']] = new Horaire($horaire['id'], $horaire['arret'], $horaire['heure']);
       }

       return $horaireList;
   }

   public function getProHoraireByArret( $idNextStop,$heure){
       
       
       $nextStop = $this->getById($idNextStop);
       
       
       
        $horaires = $this->getHorairesByArret($nextStop->getId());
        foreach($horaires as $horaire){
            
            if($horaire->getHeure > $heure){
                return $horaire->getHeure;
                
            }
        }  
       
   }
   
   public function getHoraireById( $id){
       
       
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('h.*')
           ->from('horaires', 'h')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $horData = $statement->fetchAll();

       return new Horaire($horData[0]['id'], $horData[0]['arret'], $horData[0]['heure']);
       
   }
   
   public function getByNomLigne($ligne)
   {
      $nom = "'".$ligne."'";
      //echo $nom;
      $where = "nomligne = ".$nom;
      //echo $where;
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('*')
           ->from('stops')
           ->where($where);
           //->setParameter(0, $nom);

       
       $statement = $queryBuilder->execute();
       $stopsData = $statement->fetchAll();
       
       foreach ($stopsData as $stopData) {
           
           $stopEntityList[$stopData['id']] = new stop($stopData['id'], $stopData['nom'], $stopData['nomligne'], $stopData['latitude'], $stopData['longitude']);
       }

       return $stopEntityList;
   }

   public function getByOwner($ligne)
   {
      $nom = "'".$ligne->getNom()."'";
      //echo $nom;
      $where = "nomligne = ".$nom;
      //echo $where;
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('*')
           ->from('stops')
           ->where($where);
           //->setParameter(0, $nom);

       
       $statement = $queryBuilder->execute();
       $stopsData = $statement->fetchAll();
       $i=0;
       foreach ($stopsData as $stopData) {
           $i++;
           $stopEntityList[$stopData['id']] = new stop($stopData['id'], $stopData['nom'], $stopData['nomligne'], $stopData['latitude'], $stopData['longitude']);
       }

       if($i==0)
           return;
       return $stopEntityList;
   }

   /**
    * Returns an line object.
    *
    * @param $id
    *   The id of the line to return.
    *
    * @return array A collection of lines, keyed by line id.
    */
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('s.*')
           ->from('stops', 's')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $stopData = $statement->fetchAll();

       return new stop($stopData[0]['id'], $stopData[0]['nom'], $stopData[0]['nomligne'], $stopData[0]['latitude'], $stopData[0]['longitude']);
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('stops')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('stops')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['nom']) {
            $queryBuilder
              ->set('nom', ':nom')
              ->setParameter(':nom', $parameters['nom']);
        }
        
        if ($parameters['nomligne']) {
            $queryBuilder
            ->set('nomligne', ':nomligne')
            ->setParameter(':nomligne', $parameters['nomligne']);
        }
        
        if ($parameters['latitude']) {
            $queryBuilder
            ->set('latitude', ':latitude')
            ->setParameter(':latitude', $parameters['latitude']);
        }
        
        if ($parameters['longitude']) {
            $queryBuilder
            ->set('longitude', ':longitude')
            ->setParameter(':longitude', $parameters['longitude']);
        }

        $statement = $queryBuilder->execute();
    }
    
    public function getNextTimeByStop($departureTime, $arrivedStop){
        
        $timeList = $this->getHorairesByArret($arrivedStop->getId());
        
        $nearestTime = $departureTime;
        
        foreach($timeList as $horaire){
            
            if(strtotime($horaire->getHeure()) > strtotime($departureTime->getHeure()) && strtotime($departureTime->getHeure()) <= strtotime($nearestTime->getHeure())){
                $nearestTime = $horaire;
            }
        }  
        
        return $nearestTime;
        
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('stops')
          ->values(
              array(
                'nom' => ':nom',
                'nomligne' => ':nomligne',
                'latitude' => ':latitude',
                'longitude' => ':longitude'
              )
          )
          ->setParameter(':nom', $parameters['nom'])
          ->setParameter(':nomligne', $parameters['nomligne'])
          ->setParameter(':latitude', $parameters['latitude'])
          ->setParameter(':longitude', $parameters['longitude']);
        $statement = $queryBuilder->execute();
    }
}

