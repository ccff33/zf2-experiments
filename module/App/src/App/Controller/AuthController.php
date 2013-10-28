<?php

namespace App\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController {
    
    public function loginAction() {
        return new ViewModel();
    }
    
    public function checkAction() {
        if ($user = $this->identity()) {
            $this->flashMessenger()->addMessage('Logged' . $user->getUsername());
            return $this->redirect()->toRoute('app/default', array());
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $username = $this->params()->fromPost('username', '');
            $password = $this->params()->fromPost('password', '');
            
            $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
            $adapter = $auth->getAdapter();
                
            $adapter->setIdentityValue($username);
            $adapter->setCredentialValue($password);
            $authResult = $auth->authenticate();
            if ($authResult->isValid()) {
                $identity = $authResult->getIdentity();
                $auth->getStorage()->write($identity);
                return $this->redirect()->toRoute('app/default', array());
            }
            $this->flashMessenger()->addMessage('Username or password incorrect');
        }
        
        return $this->redirect()->toRoute('app/default', array('controller' => 'auth', 'action' => 'login'));
    }
    
    public function logoutAction() {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
        }
        
        $auth->clearIdentity();
        return $this->redirect()->toRoute('app/default', array());
    }
}