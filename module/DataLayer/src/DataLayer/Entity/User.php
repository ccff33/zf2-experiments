<?php

namespace DataLayer\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User implements \ZfcRbac\Identity\IdentityInterface {
    
    /**
     * @var integer @ORM\Column(type="integer")
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    protected $username;
    
    /**
     * @var \DataLayer\Entity\Role 
     * 
     * @ORM\Column(type="string")
     */
    protected $password;
    
    /**
     *
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\ManyToMany(targetEntity="DataLayer\Entity\Role", inversedBy="users")
     */
    protected $roles;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection ();
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
     * Set username
     *
     * @param string $username            
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;
        
        return $this;
    }
    
    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }
    
    /**
     * Set password
     *
     * @param string $password            
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }
    
    /**
     * Add roles
     *
     * @param \DataLayer\Entity\Role $roles            
     * @return User
     */
    public function addRole(\DataLayer\Entity\Role $roles) {
        $this->roles [] = $roles;
        
        return $this;
    }
    
    /**
     * Remove roles
     *
     * @param \DataLayer\Entity\Role $roles            
     */
    public function removeRole(\DataLayer\Entity\Role $roles) {
        $this->roles->removeElement ( $roles );
    }
    
    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles() {
        return $this->roles->toArray();
    }
}
