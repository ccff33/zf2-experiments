<?php

namespace DataLayer\Service;

interface IngredientServiceInterface {
    
    public function save($ingredient);
    
    public function fetchAll();
}