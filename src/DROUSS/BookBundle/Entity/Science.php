<?php
namespace DROUSS\BookBundle\Entity;;
namespace DROUSS\BookBundle\Entity;;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Science
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=4)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="DROUSS\BookBundle\Entity\Book", mappedBy="Science")
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
     * @return Science
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
     * @return Science
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
}
