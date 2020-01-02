<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articles
 *
 * @ORM\Table(name="articles")
 * @ORM\Entity
 */
class Articles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="categories_id", type="integer", nullable=false)
     */
    private $categoriesId;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="users_id", type="integer", nullable=false)
     */
    private $usersId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * Set id
     *
     * @param string $id
     *
     * @return Articles
    */
    public function setId($id)
    {
      $this->id = $id;

      return $this;
    }

    /**
     * Get id
     *
     * @return string
    */
    public function getId()
    {
      return $this->id;
    }


    /**
     * Set categories_id
     *
     * @param string $categories_id
     *
     * @return Articles
    */
    public function setCategories_id($categories_id)
    {
      $this->categoriesId = $categories_id;

      return $this;
    }

    /**
     * Get categories_id
     *
     * @return string
    */
    public function getCategories_id()
    {
      return $this->categoriesId;
    }



    /**
     * Set text
     *
     * @param string $text
     *
     * @return Articles
    */
    public function setText($text)
    {
      $this->text = $text;

      return $this;
    }

    /**
     * Get text
     *
     * @return string
    */
    public function getText()
    {
      return $this->text;
    }



    /**
     * Set title
     *
     * @param string $title
     *
     * @return Articles
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
     * Set users_id
     *
     * @param string $users_id
     *
     * @return Articles
    */
    public function setUsers_id($users_id)
    {
      $this->usersId = $users_id;

      return $this;
    }

    /**
     * Get users_id
     *
     * @return string
    */
    public function getUsers_id()
    {
      return $this->usersId;
    }




}
