<?php

namespace Up2green\ReforestationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Organization entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="organization")
 */
class Organization
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(length=128)
     */
    protected $url;

    /**
     * @var string
     *
     * @ORM\Column(length=128)
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Gedmo\Translatable
     */
    protected $summary;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Gedmo\Translatable
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(length=128, nullable=true)
     */
    protected $logo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *   targetEntity="Up2green\ReforestationBundle\Entity\OrganizationI18n",
     *   mappedBy="foreignKey",
     *   cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @param OrganizationI18n $translation
     *
     * @return $this
     */
    public function addTranslation(OrganizationI18n $translation)
    {
        $translation->setForeignKey($this);
        $translation->setObjectClass('Up2green\ReforestationBundle\Entity\Organization');

        $this->translations[] = $translation;
        return $this;
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function setTranslations(\Doctrine\Common\Collections\ArrayCollection $translations)
    {
        $this->translations = $translations;
        return $this;
    }

    public function removeTranslation($translation)
    {
        $this->translations->removeElement($translation);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param string $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
