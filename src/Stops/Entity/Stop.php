<?php

namespace App\Stops\Entity;

class Stop
{
    protected $id;

    protected $nom;

    protected $nomligne;
    
    public function __construct($id, $nom, $nomligne)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->nomligne = $nomligne;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setNomLigne($nomligne)
    {
        $this->nomligne = $nomligne;
    }

    public function getId()
    {
        return $this->id;
    }
   
    public function getNom()
    {
        return $this->nom;
    }
    public function getNomLigne()
    {
        return $this->nomligne;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['nom'] = $this->nom;
        $array['nomligne'] = $this->nomligne;

        return $array;
    }
}
