<?php

namespace DataLayer\Service;

use DataLayer\Entity\User;
use Zend\Crypt\Password\PasswordInterface;

class UserServiceDoctrineImpl implements UserServiceInterface {
    
    protected $em;
    protected $saltProvider;
    protected $passwordService;
    protected $repository;
    
    public function save($user) {
        $plainPassword = $user->getPlainPassword();
        if (false === empty($plainPassword)) {
            $user->setSalt($this->getSaltProvider()->getSalt());
            $this->getPasswordService()->setSalt($user->getSalt());
            $user->setPassword($this->getPasswordService()->create($plainPassword));
            $user->setPlainPassword('');
        }
        $this->em->persist($user);
        $this->em->flush();
    }
    
    public function findOneBy($params) {
        return $this->getRepository()->findOneBy($params);
    }
    
    public function verifyPassword($user, $password) {
        $this->getPasswordService()->setSalt($user->getSalt());
        return $this->getPasswordService()->verify($password, $user->getPassword());
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
    
    public function setSaltProvider($saltProvider) {
        $this->saltProvider = $saltProvider;
    }
    
    public function getSaltProvider() {
        return $this->saltProvider;
    }
    
    public function setPasswordService(PasswordInterface $passwordService) {
        $this->passwordService = $passwordService;
    }
    
    public function getPasswordService() {
        return $this->passwordService;
    }
}