<?php

namespace App\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DataLayer\Entity\User;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\Element;

class UserController extends AbstractActionController {
    
    public function registerAction() {
        $form = $this->getUserForm(new User());
        return new ViewModel(array('form' => $form));
    }
    
    public function performRegistrationAction() {
        $service = $this->getUserService();
        $user = new User();
        $form = $this->getUserForm($user);
         
        $request = $this->getRequest();
        if ($request->isPost()){
            $form->bind($user);
            $form->setData($request->getPost());
            if ($form->isValid()){
                $service->save($user);
                $this->flashMessenger()->addMessage('Registered');
                return $this->redirect()->toRoute('app/default', array('controller' => 'home', 'action' => 'index'));
            } else {
                $this->flashMessenger()->addMessage('Invalid data');
            }
        }
        
        return $this->redirect()->toRoute('app/default', array('controller' => 'user', 'action' => 'register'));
    }
    
    protected function getUserForm($user) {
        $builder = new AnnotationBuilder();
        $form = $builder->createForm($user);
        $send = new Element('send');
        $send->setAttributes(array('type' => 'submit'));
        $form->add($send);
        return $form;
    }
    
    protected function getUserService() {
        return $this->getServiceLocator()->get('dl.user_service');
    }
}