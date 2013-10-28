<?php

namespace DataLayer\Service;

use DataLayer\Entity\User;

class UserServiceDoctrineImpl implements UserServiceInterface {
    
    protected $em;
    protected $saltProvider;
    protected $hashService;
    protected $repository;
    
    public function save($user) {
        $plainPassword = $user->getPlainPassword();
        if (false === empty($plainPassword)) {
            $user->setSalt($this->getSaltProvider()->getSalt());
            $this->getHashService()->setSalt($user->getSalt());
            $user->setPassword($this->getHashService()->create($plainPassword));
            $user->setPlainPassword('');
        }
        $this->em->persist($user);
        $this->em->flush();
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
    
    public function setHashService($hashService) {
        $this->hashService = $hashService;
    }
    
    public function getHashService() {
        return $this->hashService;
    }
}