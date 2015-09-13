<?php
namespace DROUSS\BookBundle\Entity;;
namespace DROUSS\BookBundle\Entity;;
use Doctrine\ORM\Mapping AS ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=4)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	/**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $Oumma;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;
	
	/**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    /**
     * @ORM\Column(type="string", unique=false, length=255, nullable=false)
     */
    private $imagePath = "couvParDefaut.jpg";
	
	public function getAbsolutePath()
    {
        return null === $this->imagePath ? null : $this->getUploadRootDir().'/'.$this->imagePath;
    }

    public function getWebPath()
    {
        return null === $this->imagePath ? null : $this->getUploadDir().'/'.$this->imagePath;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'Required/media/images/auteurs';
    }
	
	
	
	 /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->imagePath = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // s'il y a une erreur lors du déplacement du fichier, une exception
        // va automatiquement être lancée par la méthode move(). Cela va empêcher
        // proprement l'entité d'être persistée dans la base de données si
        // erreur il y a
        $this->file->move($this->getUploadRootDir(), $this->imagePath);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }					

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\OneToMany(targetEntity="DROUSS\BookBundle\Entity\Book", mappedBy="Author")
     */
    private $Book;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Book = new \Doctrine\Common\Collections\ArrayCollection();
		
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
     * Set name
     *
     * @param string $name
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set imagePath
     *
     * @param string $imagePath
     * @return Author
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Set biography
     *
     * @param string $biography
     * @return Author
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string 
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Add Book
     *
     * @param \DROUSS\BookBundle\Entity\Book $book
     * @return Author
     */
    public function addBook(\DROUSS\BookBundle\Entity\Book $book)
    {
        $this->Book[] = $book;

        return $this;
    }

    /**
     * Remove Book
     *
     * @param \DROUSS\BookBundle\Entity\Book $book
     */
    public function removeBook(\DROUSS\BookBundle\Entity\Book $book)
    {
        $this->Book->removeElement($book);
    }

    /**
     * Get Book
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBook()
    {
        return $this->Book;
    }

    /**
     * Set Oumma
     *
     * @param boolean $oumma
     * @return Author
     */
    public function setOumma($oumma)
    {
        $this->Oumma = $oumma;

        return $this;
    }

    /**
     * Get Oumma
     *
     * @return boolean 
     */
    public function getOumma()
    {
        return $this->Oumma;
    }
}
