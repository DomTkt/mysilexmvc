<?php

namespace App\Stops\Entity;

class Stop
{
    protected $id;

    protected $nom;

    protected $nomligne;
    
    protected $latitude;
    
    protected $longitude;

    public function __construct($id, $nom, $nomligne, $latitude, $longitude)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->nomligne = $nomligne;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
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
    
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }
    
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
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

    public function getLatitude()
    {
        return $this->latitude;
    }
    
    public function getLongitude()
    {
        return $this->longitude;
    }
    
    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['nom'] = $this->nom;
        $array['nomligne'] = $this->nomligne;
        $array['latitude'] = $this->latitude;
        $array['longitude'] = $this->longitude;

        return $array;
    }
}
