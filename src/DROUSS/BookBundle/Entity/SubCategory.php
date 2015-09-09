<?php
namespace DROUSS\BookBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class SubCategory
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;
	
	/**
     * @ORM\OneToMany(targetEntity="DROUSS\BookBundle\Entity\Book", mappedBy="subCategory")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="DROUSS\BookBundle\Entity\Category", inversedBy="subCategory")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

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
     * @return SubCategory
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
     * Set category
     *
     * @param \DROUSS\BookBundle\Entity\Category $category
     * @return SubCategory
     */
    public function setCategory(\DROUSS\BookBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \DROUSS\BookBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->book = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add book
     *
     * @param \DROUSS\BookBundle\Entity\Book $book
     * @return SubCategory
     */
    public function addBook(\DROUSS\BookBundle\Entity\Book $book)
    {
        $this->book[] = $book;

        return $this;
    }

    /**
     * Remove book
     *
     * @param \DROUSS\BookBundle\Entity\Book $book
     */
    public function removeBook(\DROUSS\BookBundle\Entity\Book $book)
    {
        $this->book->removeElement($book);
    }

    /**
     * Get book
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBook()
    {
        return $this->book;
    }
}
