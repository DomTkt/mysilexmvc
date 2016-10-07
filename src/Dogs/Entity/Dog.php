<?php

namespace App\Dogs\Entity;

class Dog
{
    protected $id;

    protected $nom;

    protected $maitre;
    
    public function __construct($id, $nom, $maitre)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->maitre = $maitre;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setMaitre($maitre)
    {
        $this->maitre = $maitre;
    }

    public function getId()
    {
        return $this->id;
    }
   
    public function getNom()
    {
        return $this->nom;
    }
    public function getMaitre()
    {
        return $this->maitre;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['nom'] = $this->nom;
        $array['maitre'] = $this->maitre;

        return $array;
    }
}
