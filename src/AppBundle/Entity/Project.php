<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="features", type="text", nullable=true)
     */
    private $features;
    
    /**
     * @var string
     *
     * @ORM\Column(name="updatedAt", type="datetime", length=255, nullable=true)
     */
    private $updatedAt;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Agency", inversedBy="projects")
     * @ORM\JoinColumn(name="agency_id", referencedColumnName="id")
     */
    private $agency;

    /**
     * @ORM\OneToMany(targetEntity="ProjectImage", mappedBy="project", cascade={"persist", "remove"})
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $projectImages;

    public function __construct()
    {
        $this->projectImages = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Project
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
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set features
     *
     * @param string $features
     *
     * @return Project
     */
    public function setFeatures($features)
    {
        $this->features = $features;

        return $this;
    }

    /**
     * Get features
     *
     * @return string
     */
    public function getFeatures()
    {
        return $this->features;
    }

    public function getImages()
    {
        return $this->projectImages;
    }


    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setAgency(Agency $agency)
    {
        $this->agency = $agency;

        return $this;
    }

    public function getAgency()
    {
        return $this->agency;
    }

    public function addProjectImage(ProjectImage $projectImage)
    {
        $this->projectImages[] = $projectImage;
    }

    public function getProjectImages()
    {
        return $this->projectImages;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return ProjectImage
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }
}
