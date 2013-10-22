<?php

namespace DataLayer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permission
 *
 * @ORM\Table(name="permissions")
 * @ORM\Entity
 */
class Permission {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=true)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="DataLayer\Entity\Role", mappedBy="permission")
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct() {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Permission
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Add role
     *
     * @param \DataLayer\Entity\Role $role
     * @return Permission
     */
    public function addRole(\DataLayer\Entity\Role $role) {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \DataLayer\Entity\Role $role
     */
    public function removeRole(\DataLayer\Entity\Role $role) {
        $this->role->removeElement($role);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRole() {
        return $this->role;
    }

}
