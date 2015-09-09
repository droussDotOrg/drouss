<?php
namespace DROUSS\BookBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="DROUSS\BookBundle\Entity\Repository\BookRepository")
 */

class Book
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $online = "default";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $extract;

    /**
     * 
     */


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $blanketPath = "couvParDefaut.jpg";

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status = true;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $forward = 0;

    /**
     * @ORM\ManyToOne(targetEntity="DROUSS\BookBundle\Entity\Author", inversedBy="Book")
     * @ORM\JoinColumn(name="authorId", referencedColumnName="id")
     */
    private $Author;

    /**
     * @ORM\ManyToOne(targetEntity="DROUSS\BookBundle\Entity\Category", inversedBy="book")
     * @ORM\JoinColumn(name="categoryId2", referencedColumnName="id")
     */
    private $category;
	
	 /**
     * @ORM\ManyToOne(targetEntity="DROUSS\BookBundle\Entity\SubCategory", inversedBy="book")
     * @ORM\JoinColumn(name="subCategoryId", referencedColumnName="id")
     */
    private $subCategory;

    /**
     * @ORM\ManyToMany(targetEntity="DROUSS\BookBundle\Entity\Format", inversedBy="Book")
     * @ORM\JoinTable(
     *     name="Format_To_Book",
     *     joinColumns={@ORM\JoinColumn(name="bookId", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="formatId", referencedColumnName="id", nullable=false)}
     * )
     */
    private $Format;

    /**
     * @ORM\ManyToMany(targetEntity="DROUSS\BookBundle\Entity\Language", inversedBy="Book")
     * @ORM\JoinTable(
     *     name="Language_To_Book",
     *     joinColumns={@ORM\JoinColumn(name="bookId", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="languageId", referencedColumnName="id", nullable=false)}
     * )
     */
    private $Language;

    /**
     * @ORM\ManyToMany(targetEntity="DROUSS\BookBundle\Entity\Month", inversedBy="Book")
     * @ORM\JoinTable(
     *     name="Month_To_Book",
     *     joinColumns={@ORM\JoinColumn(name="bookId", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="monthId", referencedColumnName="id", nullable=false)}
     * )
     */
    private $Month;

    /**
     * @ORM\ManyToMany(targetEntity="DROUSS\BookBundle\Entity\Science", inversedBy="Book")
     * @ORM\JoinTable(
     *     name="ScienceToBook",
     *     joinColumns={@ORM\JoinColumn(name="bookId", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="scienceId", referencedColumnName="id", nullable=false)}
     * )
     */
    private $Science;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Format = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Language = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Month = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Science = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set online
     *
     * @param $online
     * @internal param string $online
     * @return Book
     */
    public function setOnline($online)
    {
        $this->online = $online;

        return $this;
    }

    /**
     * Get online
     *
     * @return string
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subTitle
     *
     * @param string $subTitle
     * @return Book
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * Get subTitle
     *
     * @return string 
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * Set extract
     *
     * @param string $extract
     * @return Book
     */
    public function setExtract($extract)
    {
        $this->extract = $extract;

        return $this;
    }

    /**
     * Get extract
     *
     * @return string 
     */
    public function getExtract()
    {
        return $this->extract;
    }

    /**
     * Set blanketPath
     *
     * @param string $blanketPath
     * @return Book
     */
    public function setBlanketPath($blanketPath)
    {
        $this->blanketPath = $blanketPath;

        return $this;
    }

    /**
     * Get blanketPath
     *
     * @return string 
     */
    public function getBlanketPath()
    {
        return $this->blanketPath;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Book
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set forward
     *
     * @param boolean $forward
     * @return Book
     */
    public function setForward($forward)
    {
        $this->forward = $forward;

        return $this;
    }

    /**
     * Get forward
     *
     * @return boolean 
     */
    public function getForward()
    {
        return $this->forward;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Book
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set Author
     *
     * @param \DROUSS\BookBundle\Entity\Author $author
     * @return Book
     */
    public function setAuthor(\DROUSS\BookBundle\Entity\Author $author = null)
    {
        $this->Author = $author;

        return $this;
    }

    /**
     * Get Author
     *
     * @return \DROUSS\BookBundle\Entity\Author 
     */
    public function getAuthor()
    {
        return $this->Author;
    }

    /**
     * Set category
     *
     * @param \DROUSS\BookBundle\Entity\Category $category
     * @return Book
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
     * Add Format
     *
     * @param \DROUSS\BookBundle\Entity\Format $format
     * @return Book
     */
    public function addFormat(\DROUSS\BookBundle\Entity\Format $format)
    {
        $this->Format[] = $format;

        return $this;
    }

    /**
     * Remove Format
     *
     * @param \DROUSS\BookBundle\Entity\Format $format
     */
    public function removeFormat(\DROUSS\BookBundle\Entity\Format $format)
    {
        $this->Format->removeElement($format);
    }

    /**
     * Get Format
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormat()
    {
        return $this->Format;
    }

    /**
     * Add Language
     *
     * @param \DROUSS\BookBundle\Entity\Language $language
     * @return Book
     */
    public function addLanguage(\DROUSS\BookBundle\Entity\Language $language)
    {
        $this->Language[] = $language;

        return $this;
    }

    /**
     * Remove Language
     *
     * @param \DROUSS\BookBundle\Entity\Language $language
     */
    public function removeLanguage(\DROUSS\BookBundle\Entity\Language $language)
    {
        $this->Language->removeElement($language);
    }

    /**
     * Get Language
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguage()
    {
        return $this->Language;
    }

    /**
     * Add Month
     *
     * @param \DROUSS\BookBundle\Entity\Month $month
     * @return Book
     */
    public function addMonth(\DROUSS\BookBundle\Entity\Month $month)
    {
        $this->Month[] = $month;

        return $this;
    }

    /**
     * Remove Month
     *
     * @param \DROUSS\BookBundle\Entity\Month $month
     */
    public function removeMonth(\DROUSS\BookBundle\Entity\Month $month)
    {
        $this->Month->removeElement($month);
    }

    /**
     * Get Month
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMonth()
    {
        return $this->Month;
    }

    /**
     * Add Science
     *
     * @param \DROUSS\BookBundle\Entity\Science $science
     * @return Book
     */
    public function addScience(\DROUSS\BookBundle\Entity\Science $science)
    {
        $this->Science[] = $science;

        return $this;
    }

    /**
     * Remove Science
     *
     * @param \DROUSS\BookBundle\Entity\Science $science
     */
    public function removeScience(\DROUSS\BookBundle\Entity\Science $science)
    {
        $this->Science->removeElement($science);
    }

    /**
     * Get Science
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getScience()
    {
        return $this->Science;
    }

	public function setBookFormatPath($format, $path)
	{
		
		$filename = '../src/DROUSS/BookBundle/Resources/baseDir/formatDir/book/'.$this->getTitle().$this->getId().$format.'.txt';
		if(!file_exists($filename))
			{
			$myfile = fopen($filename, "w+");
			fclose($myfile);
		}
		file_put_contents($filename, $path);
	}
	
	public function getBookFormatPath($format)
	{
		$format = strtolower($format);
		$file ='../src/DROUSS/BookBundle/Resources/baseDir/formatDir/book/'.$this->getTitle().$format.'.txt';
		
		return file_get_contents($file);
	}

    /**
     * Set subCategory
     *
     * @param \DROUSS\BookBundle\Entity\SubCategory $subCategory
     * @return Book
     */
    public function setSubCategory(\DROUSS\BookBundle\Entity\SubCategory $subCategory = null)
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    /**
     * Get subCategory
     *
     * @return \DROUSS\BookBundle\Entity\SubCategory 
     */
    public function getSubCategory()
    {
        return $this->subCategory;
    }
}
