<?php
namespace DROUSS\BookBundle\Entity;;
namespace DROUSS\BookBundle\Entity;;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Category
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
     * @ORM\Column(type="integer", length=4, unique=true)
     */
    private $order;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categoryName;

    /**
     * @ORM\OneToMany(targetEntity="DROUSS\BookBundle\Entity\Book", mappedBy="category")
     */
    private $book;
	
	  /**
     * 
     * @ORM\OneToMany(targetEntity="DROUSS\BookBundle\Entity\SubCategory", mappedBy="category")
     */
    private $subCategory;
	
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->book = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Category
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
     * Set categoryName
     *
     * @param string $categoryName
     * @return Category
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * Get categoryName
     *
     * @return string 
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Add book
     *
     * @param \DROUSS\BookBundle\Entity\Book $book
     * @return Category
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

    /**
     * Add subCategory
     *
     * @param \DROUSS\BookBundle\Entity\SubCategory $subCategory
     * @return Category
     */
    public function addSubCategory(\DROUSS\BookBundle\Entity\SubCategory $subCategory)
    {
        $this->subCategory[] = $subCategory;

        return $this;
    }

    /**
     * Remove subCategory
     *
     * @param \DROUSS\BookBundle\Entity\SubCategory $subCategory
     */
    public function removeSubCategory(\DROUSS\BookBundle\Entity\SubCategory $subCategory)
    {
        $this->subCategory->removeElement($subCategory);
    }

    /**
     * Get subCategory
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubCategory()
    {
        return $this->subCategory;
    }

    /**
     * Set order
     *
     * @param integer $order
     * @return Category
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
