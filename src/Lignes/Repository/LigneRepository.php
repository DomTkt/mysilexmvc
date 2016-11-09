<?php

namespace App\Lignes\Repository;

use App\Lignes\Entity\Ligne;
use Doctrine\DBAL\Connection;

/**
 * line repository.
 */
class LigneRepository
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
           ->select('l.*')
           ->from('lignes', 'l');

       $statement = $queryBuilder->execute();
       $lignesData = $statement->fetchAll();
       foreach ($lignesData as $ligneData) {
           $ligneEntityList[$ligneData['id']] = new ligne($ligneData['id'], $ligneData['nom'], $ligneData['prenom'], $ligneData['age']);
       }

       return $ligneEntityList;
   }

   /**
    * Returns an line object.
    *
    * @param $id
    *   The id of the line to return.
    *
    * @return array A collection of lignes, keyed by line id.
    */
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('l.*')
           ->from('lignes', 'l')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $ligneData = $statement->fetchAll();

       return new ligne($ligneData[0]['id'], $ligneData[0]['nom'], $ligneData[0]['prenom'], $ligneData[0]['age']);
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('lignes')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('lignes')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['nom']) {
            $queryBuilder
              ->set('nom', ':nom')
              ->setParameter(':nom', $parameters['nom']);
        }

        if ($parameters['prenom']) {
            $queryBuilder
            ->set('prenom', ':prenom')
            ->setParameter(':prenom', $parameters['prenom']);
        }
        
        if ($parameters['age']) {
            $queryBuilder
            ->set('age', ':age')
            ->setParameter(':age', $parameters['age']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('lignes')
          ->values(
              array(
                'nom' => ':nom',
                'prenom' => ':prenom',
                'age' => ':age',
              )
          )
          ->setParameter(':nom', $parameters['nom'])
          ->setParameter(':prenom', $parameters['prenom'])
          ->setParameter(':age', $parameters['age']);
        $statement = $queryBuilder->execute();
    }
}
