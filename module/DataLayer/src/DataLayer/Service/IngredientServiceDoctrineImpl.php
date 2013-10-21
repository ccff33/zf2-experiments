<?php

namespace DataLayer\Service;

class IngredientServiceDoctrineImpl implements IngredientServiceInterface {
    
    protected $repository;
    
    public function fetchAll() {
        return $this->getRepository()->findAll();
    }
    
    public function setRepository($repository) {
        $this->repository = $repository;
    }
    
    public function getRepository() {
        return $this->repository;
    }
}