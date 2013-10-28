<?php

namespace DataLayer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Permissions\Rbac\Role as ZfRole;

/**
 * Role
 *
 * @ORM\Table(name="roles", indexes={@ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\Entity
 */
class Role extends ZfRole {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=true)
     */
    protected $name;

    /**
     * @var \DataLayer\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="DataLayer\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    protected $parentRole;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="DataLayer\Entity\Permission", inversedBy="role")
     * @ORM\JoinTable(name="roles_permissions",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="perm_id", referencedColumnName="id")
     *   }
     * )
     */
    protected $permission;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="DataLayer\Entity\User", mappedBy="roles")
     */
    protected $users;

    /**
     * Constructor
     */
    public function __construct() {
        $this->perm = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Role
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
     * Set parentRole
     *
     * @param \DataLayer\Entity\Role $parentRole
     * @return Role
     */
    public function setParentRole(\DataLayer\Entity\RbacRole $parentRole = null) {
        $this->parentRole = $parentRole;

        return $this;
    }

    /**
     * Get parentRole
     *
     * @return \DataLayer\Entity\Role 
     */
    public function getParentRole() {
        return $this->parentRole;
    }

    /**
     * Add permission
     *
     * @param string|\DataLayer\Entity\Permission $permission
     * @return Role
     */
    public function addPermission($permission) {
        
        if (! $permission instanceof Permission) {
            throw \Exception('not implemented');
        }
        
        $this->permission[] = $permission;

        return $this;
    }

    /**
     * Remove permission
     *
     * @param \DataLayer\Entity\Permission $permission
     */
    public function removePermission(\DataLayer\Entity\Permission $permission) {
        $this->permission->removeElement($permission);
    }

    /**
     * Get permission
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPermission() {
        return $this->permission;
    }


    /**
     * Add users
     *
     * @param \DataLayer\Entity\User $users
     * @return Role
     */
    public function addUser(\DataLayer\Entity\User $users) {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \DataLayer\Entity\User $users
     */
    public function removeUser(\DataLayer\Entity\User $users) {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers() {
        return $this->users;
    }
    
    public function __toString() {
        return $this->getName();
    }
}
