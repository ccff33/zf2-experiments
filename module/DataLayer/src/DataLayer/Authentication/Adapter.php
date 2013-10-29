<?php

namespace DataLayer\Authentication;

use Zend\Authentication\Adapter\AbstractAdapter;
use Zend\Authentication\Result;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DataLayer\Service\UserServiceInterface;

class Adapter extends AbstractAdapter {
    
    protected $service;
    
    public function authenticate() {
        $user = $this->getUserService()->findOneBy(array('username' => $this->getIdentity()));
        
        if ($user && $this->getUserService()->verifyPassword($user, $this->getCredential())) {
            return new Result(Result::SUCCESS, $user);
        }
        
        return new Result(Result::FAILURE, $this->getIdentity());
    }
    
    public function setUserService(UserServiceInterface $service) {
        $this->service = $service;
    }
    
    public function getUserService() {
        return $this->service;
    }
    
}