<?php

namespace RuffeCard\UserGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adresse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RuffeCard\UserGestionBundle\Entity\AdresseRepository")
 */
class Adresse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Commune", type="string", length=255)
     */
    private $commune;

    /**
     * @var integer
     *
     * @ORM\Column(name="Codepostale", type="integer")
     */
    private $codepostale;

    /**
     * @var string
     *
     * @ORM\Column(name="Rue", type="string", length=255)
     */
    private $rue;

    
    /**
     * @var string
     *
     * @ORM\Column(name="Boitepostale", type="string", length=255)
     */
    private $boitepostale;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="Quartier", type="string", length=255)
     */
    private $quartier;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=255)
     */
    private $ville;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Departementregion", type="string", length=255)
     */
    private $departementregion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Paysregion", type="string", length=255)
     */
    private $paysregion;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set commune
     *
     * @param string $commune
     * @return Adresse
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return string 
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set codepostale
     *
     * @param integer $codepostale
     * @return Adresse
     */
    public function setCodepostale($codepostale)
    {
        $this->codepostale = $codepostale;

        return $this;
    }

    /**
     * Get codepostale
     *
     * @return integer 
     */
    public function getCodepostale()
    {
        return $this->codepostale;
    }

    /**
     * Set rue
     *
     * @param string $rue
     * @return Adresse
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string 
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set boitepostale
     *
     * @param string $boitepostale
     * @return Adresse
     */
    public function setBoitepostale($boitepostale)
    {
        $this->boitepostale = $boitepostale;

        return $this;
    }

    /**
     * Get boitepostale
     *
     * @return string 
     */
    public function getBoitepostale()
    {
        return $this->boitepostale;
    }

    /**
     * Set quartier
     *
     * @param string $quartier
     * @return Adresse
     */
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * Get quartier
     *
     * @return string 
     */
    public function getQuartier()
    {
        return $this->quartier;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set departementregion
     *
     * @param string $departementregion
     * @return Adresse
     */
    public function setDepartementregion($departementregion)
    {
        $this->departementregion = $departementregion;

        return $this;
    }

    /**
     * Get departementregion
     *
     * @return string 
     */
    public function getDepartementregion()
    {
        return $this->departementregion;
    }

    /**
     * Set paysregion
     *
     * @param string $paysregion
     * @return Adresse
     */
    public function setPaysregion($paysregion)
    {
        $this->paysregion = $paysregion;

        return $this;
    }

    /**
     * Get paysregion
     *
     * @return string 
     */
    public function getPaysregion()
    {
        return $this->paysregion;
    }
}
