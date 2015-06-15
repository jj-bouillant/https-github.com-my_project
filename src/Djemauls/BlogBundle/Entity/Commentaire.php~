<?php

namespace Djemauls\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Djemauls\BlogBundle\Entity\CommentaireRepository")
 */
class Commentaire
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
     * @ORM\ManyToOne(targetEntity="Djemauls\BlogBundle\Entity\Article", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=20)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateredaction", type="datetime")
     */
    private $dateredaction;


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
     * Set auteur
     *
     * @param string $auteur
     * @return Commentaire
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set dateredaction
     *
     * @param \DateTime $dateredaction
     * @return Commentaire
     */
    public function setDateredaction($dateredaction)
    {
        $this->dateredaction = $dateredaction;

        return $this;
    }

    /**
     * Get dateredaction
     *
     * @return \DateTime 
     */
    public function getDateredaction()
    {
        return $this->dateredaction;
    }

    /**
     * Set article
     *
     * @param \Djemauls\BlogBundle\Entity\Article $article
     * @return Commentaire
     */
    public function setArticle(\Djemauls\BlogBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Djemauls\BlogBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
    public function __construct()
    {
        $this->dateredaction = new \DateTime();
    }
}
