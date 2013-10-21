<?php

namespace DataLayer\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation as Form;

/**
 * @ORM\Entity(repositoryClass="DataLayer\Repository\IngredientRepository")
 * @ORM\Table(name="ingredients")
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Ingredient {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Form\Exclude()
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @Form\Filter({
     *      "name": "StringTrim"
     * })
     * @Form\Validator({
     *      "name": "StringLength",
     *      "options": {
     *          "min": 1,
     *          "max": 30
     *      }
     *  })
     */
    protected $name;

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
     * @return Ingredient
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
}
