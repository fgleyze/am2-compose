<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Agency
 *
 * @ORM\Table(name="agency")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AgencyRepository")
 */
class Agency
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="catchword", type="string", length=255, nullable=true)
     */
    private $catchword;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @var string
     *
     * @ORM\Column(name="pinterest", type="string", length=255, nullable=true)
     */
    private $pinterest;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Associate", mappedBy="agency")
     */
    private $associates;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="agency")
     */
    private $projects;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=100, nullable=true)
     */
    private $imageName;

    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __toString()
    {
        return (string) $this->id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCatchword($catchword)
    {
        $this->catchword = $catchword;

        return $this;
    }

    public function getCatchword()
    {
        return $this->catchword;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getInstagram()
    {
        return $this->instagram;
    }

    public function setPinterest($pinterest)
    {
        $this->pinterest = $pinterest;

        return $this;
    }

    public function getPinterest()
    {
        return $this->pinterest;
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageName($imageName)
    {
        $this->updatedAt = new \DateTime();
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageRelativePath()
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

    public function getAssociates()
    {
        return $this->associates;
    }
}
