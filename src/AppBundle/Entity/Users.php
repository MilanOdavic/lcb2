<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=100, nullable=false)
     */
    private $pass;

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
     * Set name
     *
     * @param string $name
     *
     * @return Articles
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
     * Set pass
     *
     * @param string $pass
     *
     * @return Articles
    */
    public function setPass($pass)
    {
      $this->pass = $pass;

      return $this;
    }

    /**
     * Get pass
     *
     * @return string
    */
    public function getPass()
    {
      return $this->pass;
    }

}
