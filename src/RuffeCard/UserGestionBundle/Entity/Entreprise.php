<?php

namespace RuffeCard\UserGestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RuffeCard\UserGestionBundle\Entity\EntrepriseRepository")
 */
class Entreprise
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
     * @ORM\Column(name="Societe", type="string", length=255)
     */
    private $societe;

    /**
     * @var integer
     *
     * @ORM\Column(name="Numsiret", type="integer")
     */
    private $numsiret;

    /**
     * @var string
     *
     * @ORM\Column(name="Taille", type="string", length=255)
     */
    private $taille;

    /**
     * @var string
     *
     * @ORM\Column(name="ContactResp", type="string", length=255)
     */
    private $contactResp;

    /**
     * @var string
     *
     * @ORM\Column(name="Site", type="string", length=255)
     */
    private $site;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Facebook", type="string", length=255)
     */
    private $facebook;
    
    /**
     * @var string
     *
     * @ORM\Column(name="Autre", type="string", length=255)
     */
    private $autre;

    /**
     * @var string
     *
     * @ORM\Column(name="EmailResp", type="string", length=255)
     */
    private $emailResp;

    /**
     * @var integer
     *
     * @ORM\Column(name="TelResp", type="integer")
     */
    private $telResp;

    /**
     * @var string
     *
     * @ORM\Column(name="Secteuractivite", type="string", length=255)
     */
    private $secteuractivite;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="pourcentage", type="integer")
     */
    private $pourcentage;
    
    /**
     * @var string
     *
     * @ORM\Column(name="association", type="string", length=255)
     */
    private $association;
    
    
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
     * Set societe
     *
     * @param string $societe
     * @return Entreprise
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return string 
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set numsiret
     *
     * @param integer $numsiret
     * @return Entreprise
     */
    public function setNumsiret($numsiret)
    {
        $this->numsiret = $numsiret;

        return $this;
    }

    /**
     * Get numsiret
     *
     * @return integer 
     */
    public function getNumsiret()
    {
        return $this->numsiret;
    }

    /**
     * Set taille
     *
     * @param string $taille
     * @return Entreprise
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return string 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set contactResp
     *
     * @param string $contactResp
     * @return Entreprise
     */
    public function setContactResp($contactResp)
    {
        $this->contactResp = $contactResp;

        return $this;
    }

    /**
     * Get contactResp
     *
     * @return string 
     */
    public function getContactResp()
    {
        return $this->contactResp;
    }

    /**
     * Set emailResp
     *
     * @param string $emailResp
     * @return Entreprise
     */
    public function setEmailResp($emailResp)
    {
        $this->emailResp = $emailResp;

        return $this;
    }

    /**
     * Get emailResp
     *
     * @return string 
     */
    public function getEmailResp()
    {
        return $this->emailResp;
    }

    /**
     * Set telResp
     *
     * @param integer $telResp
     * @return Entreprise
     */
    public function setTelResp($telResp)
    {
        $this->telResp = $telResp;

        return $this;
    }

    /**
     * Get telResp
     *
     * @return integer 
     */
    public function getTelResp()
    {
        return $this->telResp;
    }

    /**
     * Set secteuractivite
     *
     * @param string $secteuractivite
     * @return Entreprise
     */
    public function setSecteuractivite($secteuractivite)
    {
        $this->secteuractivite = $secteuractivite;

        return $this;
    }

    /**
     * Get secteuractivite
     *
     * @return string 
     */
    public function getSecteuractivite()
    {
        return $this->secteuractivite;
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
     * @return Entreprise
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
     * Set pourcentage
     *
     * @param integer $pourcentage
     * @return Entreprise
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }

    /**
     * Get pourcentage
     *
     * @return integer 
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * Set association
     *
     * @param string $association
     * @return Entreprise
     */
    public function setAssociation($association)
    {
        $this->association = $association;

        return $this;
    }

    /**
     * Get association
     *
     * @return string 
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return Entreprise
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Entreprise
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
     * Set autre
     *
     * @param string $autre
     * @return Entreprise
     */
    public function setAutre($autre)
    {
        $this->autre = $autre;

        return $this;
    }

    /**
     * Get autre
     *
     * @return string 
     */
    public function getAutre()
    {
        return $this->autre;
    }

    /**
     * Set paiement
     *
     * @param \RuffeCard\TresorieBundle\Entity\Paiement $paiement
     * @return Entreprise
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
