<?php

namespace DataLayer\Service;

class BasicSaltProviderService {
    
    public function getSalt() {
        return \base_convert(\sha1(\uniqid(\mt_rand(), true)), 16, 36);
    }
}