<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * ProjectImage
 *
 * @ORM\Table(name="project_image")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectImageRepository")
 */
class ProjectImage
{
    const IMAGE_RELATIVE_PATH = 'upload/images/';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="imageName", type="string", length=255)
     */
    private $imageName;

    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="projectImages")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="thumb_width", type="integer")
     */
    private $thumbWidth;

    /**
     * @var int
     *
     * @ORM\Column(name="thumb_height", type="integer")
     */
    private $thumbHeight;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return ProjectImage
     */
    public function setImageName($imageName)
    {
        $this->updatedAt = new \DateTime();
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    public function getRelativePath()
    {
        return self::IMAGE_RELATIVE_PATH . $this->imageName;
    }

    public function getThumbRelativePath()
    {
        return self::IMAGE_RELATIVE_PATH . 'thumb_' . $this->imageName;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return ProjectImage
     */
    public function setUpdatedAt(\DateTime  $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set project
     *
     * @param integer $project
     *
     * @return ProjectImage
     */
    public function setProject(Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return int
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @return ProjectImage
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function setGeometry(array $geometry, array $thumbGeometry)
    {
        $this->width = $geometry['width'];
        $this->height = $geometry['height'];
        $this->thumbWidth = $thumbGeometry['width'];
        $this->thumbHeight = $thumbGeometry['height'];

        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getThumbWidth()
    {
        return $this->thumbWidth;
    }

    /**
     * @return int
     */
    public function getThumbHeight()
    {
        return $this->thumbHeight;
    }
}
