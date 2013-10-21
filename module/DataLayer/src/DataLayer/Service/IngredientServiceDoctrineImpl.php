<?php

namespace DataLayer\Service;

class IngredientServiceDoctrineImpl implements IngredientServiceInterface {
    
    protected $repository;
    protected $em;
    
    public function save($ingredient) {
        $this->em->persist($ingredient);
        $this->em->flush();
    }
    
    public function fetchAll() {
        return $this->getRepository()->findAll();
    }
    
    public function setRepository($repository) {
        $this->repository = $repository;
    }
    
    public function getRepository() {
        return $this->repository;
    }
    
    public function setEntityManager($em) {
        $this->em = $em;
    }
    
    public function getEntityManager() {
        return $this->em;
    }
}