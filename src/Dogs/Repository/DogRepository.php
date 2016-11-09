<?php

namespace App\Dogs\Repository;

use App\Dogs\Entity\Dog;
use Doctrine\DBAL\Connection;

/**
 * User repository.
 */
class DogRepository
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
    * Returns a collection of users.
    *
    * @param int $limit
    *   The number of users to return.
    * @param int $offset
    *   The number of users to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of users, keyed by user id.
    */
   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('d.*')
           ->from('dogs', 'd');

       $statement = $queryBuilder->execute();
       $dogsData = $statement->fetchAll();
       foreach ($dogsData as $dogData) {
           $dogEntityList[$dogData['id']] = new Dog($dogData['id'], $dogData['nom'], $dogData['maitre']);
       }

       return $dogEntityList;
   }
   
   
   public function getByOwner($user)
   {
      $prenom = "'".$user->getPrenom()."'";
      //echo $prenom;
      $where = "maitre = ".$prenom;
      //echo $where;
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('*')
           ->from('dogs')
           ->where($where);
           //->setParameter(0, $prenom);

       
       $statement = $queryBuilder->execute();
       $dogsData = $statement->fetchAll();
       
       foreach ($dogsData as $dogData) {
           
           $dogEntityList[$dogData['id']] = new Dog($dogData['id'], $dogData['nom'], $dogData['maitre']);
       }

       return $dogEntityList;
   }

   /**
    * Returns an User object.
    *
    * @param $id
    *   The id of the user to return.
    *
    * @return array A collection of users, keyed by user id.
    */
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('d.*')
           ->from('dogs', 'd')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $dogData = $statement->fetchAll();

       return new Dog($dogData[0]['id'], $dogData[0]['nom'], $dogData[0]['maitre']);
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('dogs')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('dogs')
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
          ->insert('dogs')
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

