<?php 

require_once('../../config.php');
require_once('../../Controller/ProduitsC.php');

class Produits
{
    private ?int $Idproduit = null;
    private ?string $nomproduit = null;
    private ?string $origin = null;
    private ?float $prixproduit = null;
    private ?int $nbrdisponible = null;
    private ?string $imageproduit = null;

    public function __construct($id = null, $nom, $origin, $prix, $nbrdisponible, $image)
    {
        $this->Idproduit = $id;
        $this->nomproduit = $nom;
        $this->origin = $origin;
        $this->prixproduit = $prix;
        $this->nbrdisponible = $nbrdisponible;
        $this->imageproduit = $image;
    }

    public function getIdproduit()
    {
        return $this->Idproduit;
    }

    public function getNomproduit()
    {
        return $this->nomproduit;
    }

    public function setNomproduit($nomproduit)
    {
        $this->nomproduit = $nomproduit;
        return $this;
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;
        return $this;
    }

    public function getPrixproduit()
    {
        return $this->prixproduit;
    }

    public function setPrixproduit($prixproduit)
    {
        $this->prixproduit = $prixproduit;
        return $this;
    }

    public function getNbrdisponible()
    {
        return $this->nbrdisponible;
    }

    public function setNbrdisponible($nbrdisponible)
    {
        $this->nbrdisponible = $nbrdisponible;
        return $this;
    }

    public function getImageproduit()
    {
        return $this->imageproduit;
    }

    public function setImageproduit($imageproduit)
    {
        $this->imageproduit = $imageproduit;
        return $this;
    }
}
