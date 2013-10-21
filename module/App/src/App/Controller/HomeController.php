<?php

namespace App\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Element;
use DataLayer\Entity\Ingredient;

class HomeController extends AbstractActionController {

    public function indexAction() {
        $service = $this->getIngredientService();
        $entries = $service->fetchAll();
        return new ViewModel(array('entries' => $entries));
    }
    
    public function addAction() {
        $service = $this->getIngredientService();
        $ingredient = new Ingredient();
        $form = $this->getIngredientForm($ingredient);
         
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->bind($ingredient);
            $form->setData($request->getPost());
            if ($form->isValid()){
                $service->save($ingredient);
                $this->flashMessenger()->addMessage('Added');
                return $this->redirect()->toRoute('app/default', array('controller' => 'home', 'action' => 'index'));
            } else {
                $this->flashMessenger()->addMessage('Input errors');
            }
        }
        return new ViewModel(array('form' => $form));
    }
    
    protected function getIngredientForm($ingredient) {
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($ingredient);
        $send = new Element('send');
        $send->setAttributes(array('type' => 'submit'));
        $form->add($send);
        return $form;
    }
    
    protected function getIngredientService() {
        return $this->getServiceLocator()->get('dl.ingredient_service');
    }

}

