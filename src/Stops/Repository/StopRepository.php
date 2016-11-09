<?php

namespace App\Stops\Repository;

use App\Stops\Entity\Stop;
use Doctrine\DBAL\Connection;

/**
 * line repository.
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
           $stopEntityList[$stopData['id']] = new stop($stopData['id'], $stopData['nom'], $stopData['maitre']);
       }

       return $stopEntityList;
   }
   
   
   public function getByOwner($ligne)
   {
      $prenom = "'".$ligne->getPrenom()."'";
      //echo $prenom;
      $where = "maitre = ".$prenom;
      //echo $where;
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('*')
           ->from('stops')
           ->where($where);
           //->setParameter(0, $prenom);

       
       $statement = $queryBuilder->execute();
       $stopsData = $statement->fetchAll();
       
       foreach ($stopsData as $stopData) {
           
           $stopEntityList[$stopData['id']] = new stop($stopData['id'], $stopData['nom'], $stopData['maitre']);
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

       return new stop($stopData[0]['id'], $stopData[0]['nom'], $stopData[0]['maitre']);
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
        
        if ($parameters['maitre']) {
            $queryBuilder
            ->set('maitre', ':maitre')
            ->setParameter(':maitre', $parameters['maitre']);
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
                'maitre' => ':maitre',
              )
          )
          ->setParameter(':nom', $parameters['nom'])
          ->setParameter(':maitre', $parameters['maitre']);
        $statement = $queryBuilder->execute();
    }
}

