<?php

require_once('../../config.php');
require_once('../../Controller/ReservationsC.php');
class reservation 
{
    private ?string $Nom = null;
    private ?string $Prenom = null;
    private ?int $CIN = null;
    private ?string $eventname = null;
    private ?string $eventdate = null;
    private ?string $Baggage = null;
    private $dateReservation; // New property
    private ?string $Email = null;
    
    public function __construct($nom,$prenom,$cin,$eventname,$eventdate,$baggage,$email)
    {
        $this->Nom = $nom;
        $this->Prenom = $prenom;
        $this->CIN = $cin;
        $this->eventname = $eventname;
        $this->eventdate = $eventdate;
        $this->Baggage = $baggage;
        $this->dateReservation = $dateReservation ?? date('Y-m-d H:i:s');
        $this->Email = $email;
    }
    public function getNom()
    {
        return $this->Nom;
    }
    public function setNom($Nom)
    {
        $this->Nom = $Nom;
        return $this;
    }
    public function getPrenom()
    {
        return $this->Prenom;
    }
    public function setPrenom($Prenom)
    {
        $this->Prenom = $Prenom;
        return $this;
    }
    public function getCIN()
    {
        return $this->CIN;
    }
    public function setCIN($CIN)
    {
        $this->CIN = $CIN;
        return $this;
    }
    public function geteventname()
    {
        return $this->eventname;
    }
    public function seteventname($eventname)
    {
        $this->eventname = $eventname;
        return $this;
    }
    public function geteventdate()
    {
        return $this->eventdate;
    }
    public function seteventdate($eventdate)
    {
        $this->eventdate = $eventdate;
        return $this;
    }
    public function getBaggage()
    {
        return $this->Baggage;
    }
    public function setBaggage($Baggage)
    {
        $this->Baggage = $Baggage;
        return $this;
    }
    public function getDateReservation() {
        return $this->dateReservation;
    }
    public function getEmail()
    {
        return $this->Email;
    }
    
}