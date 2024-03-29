<?php

namespace Up2green\EducationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Up2green\ReforestationBundle\Entity\Partner;
use Up2green\UserBundle\Entity\User;

/**
 * Classroom entity
 *
 * @ORM\Entity(repositoryClass="Up2green\EducationBundle\Repository\ClassroomRepository")
 * @ORM\Table(name="classroom", uniqueConstraints={@ORM\UniqueConstraint(name="unique_idx", columns={"school_id", "year", "name"})})
 * @Gedmo\Uploadable(filenameGenerator="ALPHANUMERIC", appendNumber=true ,pathMethod="getPath")
 * @UniqueEntity(fields={"school", "year", "name"}, message="classroom.already_exist")
 */
class Classroom
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
     * @ORM\Column(length=30)
     * @Assert\Length(max=30)
     */
    protected $name;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    protected $year;

    /**
     * @var mixed
     *
     * @ORM\Column(nullable=true)
     * @Gedmo\UploadableFileName
     */
    protected $picture;

    /**
     * @var mixed
     *
     * @Assert\Image
     */
    protected $pictureFile;

    /**
     * @var boolean
     */
    protected $removePictureFile;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max=2000)
     */
    protected $description;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Up2green\EducationBundle\Entity\ClassroomPicture", cascade={"persist", "remove"}, mappedBy="classroom")
     */
    protected $classroomPictures;

    /**
     * @var School
     *
     * @ORM\ManyToOne(targetEntity="Up2green\EducationBundle\Entity\School", cascade={"persist"})
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $school;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Up2green\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected $user;

    /**
     * @var Partner
     *
     * @ORM\ManyToOne(targetEntity="Up2green\ReforestationBundle\Entity\Partner")
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    protected $partner;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"year", "name"})
     * @ORM\Column(length=30, unique=true)
     */
    protected $slug;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->classroomPictures = new ArrayCollection();
        $this->year = (int) date('Y');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->name;
    }

    /**
     * FIXME to be remove when we delete the DomainObject\Registration
     */
    public function resetSchool()
    {
        $this->school = null;
    }

    /**
     * @param $defaultPath
     *
     * @return string
     */
    public function getPath($defaultPath = '')
    {
        return $defaultPath.'/uploads/classrooms';
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Partner $partner
     */
    public function setPartner(Partner $partner)
    {
        $this->partner = $partner;
    }

    /**
     * @return Partner
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $pictureFile
     */
    public function setPictureFile($pictureFile)
    {
        $this->pictureFile = $pictureFile;
    }

    /**
     * @return mixed
     */
    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    /**
     * @param boolean $removePictureFile
     */
    public function setRemovePictureFile($removePictureFile)
    {
        $this->removePictureFile = $removePictureFile;
    }

    /**
     * @return boolean
     */
    public function getRemovePictureFile()
    {
        return $this->removePictureFile;
    }

    /**
     * @param School $school
     */
    public function setSchool(School $school)
    {
        $this->school = $school;
    }

    /**
     * @return School
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param integer $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return ArrayCollection
     */
    public function getClassroomPictures()
    {
        return $this->classroomPictures;
    }

    /**
     * @param ClassroomPicture $picture
     */
    public function addClassroomPicture(ClassroomPicture $picture)
    {
        if (!$this->classroomPictures->contains($picture)) {
            $this->classroomPictures->add($picture);
            $picture->setClassroom($this);
        }
    }

    /**
     * @param ClassroomPicture $picture
     */
    public function removeClassroomPicture(ClassroomPicture $picture)
    {
        $this->classroomPictures->removeElement($picture);
    }
}
