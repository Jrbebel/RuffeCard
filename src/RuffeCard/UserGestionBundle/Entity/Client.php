<?php

namespace RuffeCard\UserGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RuffeCard\UserGestionBundle\Entity\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="Email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Metier", type="string", length=255)
     */
    private $metier;

    /**
     * @var string
     *
     * @ORM\Column(name="Passions", type="string", length=255)
     */
    private $passions;

    /**
     * @var string
     *
     * @ORM\Column(name="Loisir", type="string", length=255)
     */
    private $loisir;

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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * Set email
     *
     * @param string $email
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set metier
     *
     * @param string $metier
     * @return Client
     */
    public function setMetier($metier)
    {
        $this->metier = $metier;

        return $this;
    }

    /**
     * Get metier
     *
     * @return string 
     */
    public function getMetier()
    {
        return $this->metier;
    }

    /**
     * Set passions
     *
     * @param string $passions
     * @return Client
     */
    public function setPassions($passions)
    {
        $this->passions = $passions;

        return $this;
    }

    /**
     * Get passions
     *
     * @return string 
     */
    public function getPassions()
    {
        return $this->passions;
    }

    /**
     * Set loisir
     *
     * @param string $loisir
     * @return Client
     */
    public function setLoisir($loisir)
    {
        $this->loisir = $loisir;

        return $this;
    }

    /**
     * Get loisir
     *
     * @return string 
     */
    public function getLoisir()
    {
        return $this->loisir;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Adresse = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Adresse
     *
     * @param \RuffeCard\UserGestionBundle\Entity\Adresse $adresse
     * @return Client
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
     * @return Client
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
}
