<?php

namespace DataLayer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class User implements \ZfcRbac\Identity\IdentityInterface {
    
    /**
     * @var integer @ORM\Column(type="integer")
     * 
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Form\Exclude()
     */
    protected $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     * @Form\Filter({
     *      "name": "StringTrim"
     * })
     * @Form\Validator({
     *      "name": "StringLength",
     *      "options": {
     *          "min": 1,
     *          "max": 35
     *      }
     *  })
     */
    protected $username;
    
    /**
     * @var string
     * 
     * @Form\Validator({
     *      "name": "StringLength",
     *      "options": {
     *          "min": 6,
     *          "max": 30
     *      }
     *  })
     *  @Form\Type("Zend\Form\Element\Password")
     */
    protected $plainPassword;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string")
     * @Form\Exclude()
     */
    protected $password;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Form\Exclude()
     */
    protected $salt;
    
    /**
     *
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @ORM\ManyToMany(targetEntity="DataLayer\Entity\Role", inversedBy="users")
     * @Form\Exclude()
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
     * Set plain password
     *
     * @param string $plainPassword
     * @return User
     */
    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
    
        return $this;
    }
    
    /**
     * Get plain password
     *
     * @return string
     */
    public function getPlainPassword() {
        return $this->plainPassword;
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

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }
}
