<?php
namespace DROUSS\BookBundle\Entity;;
namespace DROUSS\BookBundle\Entity;;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Publication
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=4)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $blanketPath = "couvParDefaut.jpg";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $edition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status = true;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $online;

    /**
     * @ORM\ManyToMany(targetEntity="DROUSS\BookBundle\Entity\Format", inversedBy="Publication")
     * @ORM\JoinTable(
     *     name="Format_To_Publication",
     *     joinColumns={@ORM\JoinColumn(name="publicationId", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="formatId", referencedColumnName="id", nullable=false)}
     * )
     */
    private $Format;

    /**
     * @ORM\ManyToMany(targetEntity="DROUSS\BookBundle\Entity\Language", inversedBy="Publication")
     * @ORM\JoinTable(
     *     name="Language_To_Publication",
     *     joinColumns={@ORM\JoinColumn(name="publicationId", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="languageId", referencedColumnName="id", nullable=false)}
     * )
     */
    private $Language;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Format = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Language = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Publication
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * @return Publication
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
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set blanketPath
     *
     * @param string $author
     * @return Publication
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Set blanketPath
     *
     * @param string $blanketPath
     * @return Publication
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
     * Set edition
     *
     * @param string $edition
     * @return Publication
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Get edition
     *
     * @return string 
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Publication
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
     * Set online
     *
     * @param string $online
     * @return Publication
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
     * Add Format
     *
     * @param \DROUSS\BookBundle\Entity\Format $format
     * @return Publication
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
     * @return Publication
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
	
	public function setPubFormatPath($format, $path)
	{
		
		$filename = '../src/DROUSS/BookBundle/Resources/baseDir/formatDir/pub/'.$this->getTitle().$this->getId().$format.'.txt';
		echo $filename;
		if(!file_exists($filename))
			{
			$myfile = fopen($filename, "w+");
			fclose($myfile);
		}
		file_put_contents($filename, $path);
	}
	
	public function getPubFormatPath($format)
	{
		
		$file ='../src/DROUSS/BookBundle/Resources/baseDir/formatDir/pub/'.$this->getTitle().$this->getId().$format.'.txt';
		
		return file_get_contents($file);
	}
	
	public function setBookFormatPath($format, $path)
	{
		
		$filename = '../src/DROUSS/BookBundle/Resources/baseDir/formatDir/pub/'.$this->getTitle().$this->getId().$format.'.txt';
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
		$file ='../src/DROUSS/BookBundle/Resources/baseDir/formatDir/pub/'.$this->getTitle().$format.'.txt';
		
		return file_get_contents($file);
	}
}
