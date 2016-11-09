<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Stops\Entity;

/**
 * Description of Horaire
 *
 * @author iem
 */
class Horaire {
    protected $id;

    protected $arret;

    protected $heure;
    
    public function __construct($id, $arret, $heure)
    {
        $this->id = $id;
        $this->arret = $arret;
        $this->heure = $heure;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setArret($arret)
    {
        $this->arret = $arret;
    }

    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    public function getId()
    {
        return $this->id;
    }
   
    public function getArret()
    {
        return $this->arret;
    }
    public function getHeure()
    {
        return $this->heure;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['arret'] = $this->arret;
        $array['heure'] = $this->heure;

        return $array;
    }
    
}
