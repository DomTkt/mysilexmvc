<?php

namespace App\Lignes\Entity;

class Ligne
{
    protected $id;

    protected $nom;
    

    public function __construct($id, $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

   

    public function getId()
    {
        return $this->id;
    }
    
    public function getNom()
    {
        return $this->nom;
    }
    
    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['nom'] = $this->nom;

        return $array;
    }
}
