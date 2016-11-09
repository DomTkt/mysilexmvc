<?php

namespace App\Stops\Repository;

use App\Stops\Entity\Stop;
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
           $stopEntityList[$stopData['id']] = new stop($stopData['id'], $stopData['nom'], $stopData['nomligne']);
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
       
       foreach ($stopsData as $stopData) {
           
           $stopEntityList[$stopData['id']] = new stop($stopData['id'], $stopData['nom'], $stopData['nomligne']);
       }

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

       return new stop($stopData[0]['id'], $stopData[0]['nom'], $stopData[0]['nomligne']);
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

        $statement = $queryBuilder->execute();
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
              )
          )
          ->setParameter(':nom', $parameters['nom'])
          ->setParameter(':nomligne', $parameters['nomligne']);
        $statement = $queryBuilder->execute();
    }
}

