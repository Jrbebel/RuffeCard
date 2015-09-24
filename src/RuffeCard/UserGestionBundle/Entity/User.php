<?php

namespace RuffeCard\UserGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RuffeCard\UserGestionBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Nom", type="string", length=255)
	 */
	private $nom;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Prenom", type="string", length=255)
	 */
	private $prenom;
	
	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="DayBirth", type="date")
	 */
	private $dayBirth;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Sexe", type="string", length=255)
	 */
	private $sexe;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="Age", type="integer")
	 */
	private $age;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="TelFixe", type="integer")
	 */
	private $telFixe;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="Portable1", type="integer")
	 */
	private $portable1;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="Portable2", type="integer")
	 */
	private $portable2;
	
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="Portable3", type="integer")
	 */
	private $portable3;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Facebook", type="string", length=255)
	 */
	private $facebook;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Twitter", type="string", length=255)
	 */
	private $twitter;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Googleplus", type="string", length=255)
	 */
	private $googleplus;
	
	/**
	 * @var string
	 *
	 * @ORM\Column(name="Fonction", type="string", length=255)
	 */
	private $Fonction;
	
	/**
	 * @ORM\ManyToMany(targetEntity="\RuffeCard\UserGestionBundle\Entity\Adresse",cascade={"persist"})
	 *
	 */
	private $Adresse;
	
	/**
	 * @ORM\ManyToOne(targetEntity="\RuffeCard\TresorieBundle\Entity\Paiement",cascade={"persist"})
	 *
	 */
	private $paiement;
	
	/**
	 * @ORM\ManyToOne(targetEntity="\RuffeCard\UserGestionBundle\Entity\User",cascade={"persist"})
	 *
	 */
	private $Commercial;
	
	
	
	public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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
     * Set nom
     *
     * @param string $nom
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dayBirth
     *
     * @param \DateTime $dayBirth
     * @return User
     */
    public function setDayBirth($dayBirth)
    {
        $this->dayBirth = $dayBirth;

        return $this;
    }

    /**
     * Get dayBirth
     *
     * @return \DateTime 
     */
    public function getDayBirth()
    {
        return $this->dayBirth;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return User
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set telFixe
     *
     * @param integer $telFixe
     * @return User
     */
    public function setTelFixe($telFixe)
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    /**
     * Get telFixe
     *
     * @return integer 
     */
    public function getTelFixe()
    {
        return $this->telFixe;
    }

    /**
     * Set portable1
     *
     * @param integer $portable1
     * @return User
     */
    public function setPortable1($portable1)
    {
        $this->portable1 = $portable1;

        return $this;
    }

    /**
     * Get portable1
     *
     * @return integer 
     */
    public function getPortable1()
    {
        return $this->portable1;
    }

    /**
     * Set portable2
     *
     * @param integer $portable2
     * @return User
     */
    public function setPortable2($portable2)
    {
        $this->portable2 = $portable2;

        return $this;
    }

    /**
     * Get portable2
     *
     * @return integer 
     */
    public function getPortable2()
    {
        return $this->portable2;
    }

    /**
     * Set portable3
     *
     * @param integer $portable3
     * @return User
     */
    public function setPortable3($portable3)
    {
        $this->portable3 = $portable3;

        return $this;
    }

    /**
     * Get portable3
     *
     * @return integer 
     */
    public function getPortable3()
    {
        return $this->portable3;
    }

    /**
     * Set Fonction
     *
     * @param string $fonction
     * @return User
     */
    public function setFonction($fonction)
    {
        $this->Fonction = $fonction;

        return $this;
    }

    /**
     * Get Fonction
     *
     * @return string 
     */
    public function getFonction()
    {
        return $this->Fonction;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return User
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return User
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set googleplus
     *
     * @param string $googleplus
     * @return User
     */
    public function setGoogleplus($googleplus)
    {
        $this->googleplus = $googleplus;

        return $this;
    }

    /**
     * Get googleplus
     *
     * @return string 
     */
    public function getGoogleplus()
    {
        return $this->googleplus;
    }

    /**
     * Add Adresse
     *
     * @param \RuffeCard\UserGestionBundle\Entity\Adresse $adresse
     * @return User
     */
    public function addAdresse(\RuffeCard\UserGestionBundle\Entity\Adresse $adresse)
    {
        $this->Adresse[] = $adresse;

        return $this;
    }

    /**
     * Remove Adresse
     *
     * @param \RuffeCard\UserGestionBundle\Entity\Adresse $adresse
     */
    public function removeAdresse(\RuffeCard\UserGestionBundle\Entity\Adresse $adresse)
    {
        $this->Adresse->removeElement($adresse);
    }

    /**
     * Get Adresse
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdresse()
    {
        return $this->Adresse;
    }

    /**
     * Set paiement
     *
     * @param \RuffeCard\TresorieBundle\Entity\Paiement $paiement
     * @return User
     */
    public function setPaiement(\RuffeCard\TresorieBundle\Entity\Paiement $paiement = null)
    {
        $this->paiement = $paiement;

        return $this;
    }

    /**
     * Get paiement
     *
     * @return \RuffeCard\TresorieBundle\Entity\Paiement 
     */
    public function getPaiement()
    {
        return $this->paiement;
    }

    /**
     * Set Commercial
     *
     * @param \RuffeCard\UserGestionBundle\Entity\User $commercial
     * @return User
     */
    public function setCommercial(\RuffeCard\UserGestionBundle\Entity\User $commercial = null)
    {
        $this->Commercial = $commercial;

        return $this;
    }

    /**
     * Get Commercial
     *
     * @return \RuffeCard\UserGestionBundle\Entity\User 
     */
    public function getCommercial()
    {
        return $this->Commercial;
    }
}
