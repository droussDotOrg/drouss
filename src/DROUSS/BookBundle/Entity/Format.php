<?php
namespace DROUSS\BookBundle\Entity;;
namespace DROUSS\BookBundle\Entity;;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Format
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=4)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $name;
	
    /**
     * @ORM\ManyToMany(targetEntity="DROUSS\BookBundle\Entity\Book", mappedBy="Format")
     */
    private $Book;

    /**
     * @ORM\ManyToMany(targetEntity="DROUSS\BookBundle\Entity\Publication", mappedBy="Format")
     */
    private $Publication;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Book = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Publication = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Format
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
     * Add Book
     *
     * @param \DROUSS\BookBundle\Entity\Book $book
     * @return Format
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
     * Add Publication
     *
     * @param \DROUSS\BookBundle\Entity\Publication $publication
     * @return Format
     */
    public function addPublication(\DROUSS\BookBundle\Entity\Publication $publication)
    {
        $this->Publication[] = $publication;

        return $this;
    }

    /**
     * Remove Publication
     *
     * @param \DROUSS\BookBundle\Entity\Publication $publication
     */
    public function removePublication(\DROUSS\BookBundle\Entity\Publication $publication)
    {
        $this->Publication->removeElement($publication);
    }

    /**
     * Get Publication
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPublication()
    {
        return $this->Publication;
    }

    /**
     * Set formatBookPath
     *
     * @param string $formatBookPath
     * @return Format
     */
    public function setFormatBookPath($formatBookPath)
    {
        $this->formatBookPath = $formatBookPath;

        return $this;
    }

    /**
     * Get formatBookPath
     *
     * @return string 
     */
    public function getFormatBookPath()
    {
        return $this->formatBookPath;
    }
}
