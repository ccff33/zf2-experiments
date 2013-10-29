<?php

namespace DataLayer\Service;

interface UserServiceInterface {
    
    public function save($user);
    
    public function findOneBy($params);
    
    public function verifyPassword($user, $password);
}