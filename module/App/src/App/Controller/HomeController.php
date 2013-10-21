<?php

namespace App\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HomeController extends AbstractActionController {

    public function indexAction() {
        $service = $this->getServiceLocator()->get('dl.ingredient_service');
        $entries = $service->fetchAll();
        return new ViewModel(array('entries' => $entries));
    }

}

