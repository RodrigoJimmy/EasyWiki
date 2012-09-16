<?php

class Easywiki_Controller_Action extends Zend_Controller_Action
{
    public function init() {
        if(Zend_Registry::isRegistered('acl')) {
            $session = Zend_Registry::get('session');
            $request = $this->getRequest();
            
            $controller = $request->getControllername();
            $action = $request->getActionName();
            
            $resource = $controller;
            $privilege = $action;
            
            $auth = Zend_Auth::getInstance();
            
            if($auth->hasIdentity()) {
                $role = $session->role;
            } else {
                $role = 'anonymous';
            }
            
            $acl = Zend_Registry::get('acl');
            
            
            if(!$acl->isAllowed($role, $resource, $privilege)) {
                $session->errors[] = 'Acesso negado';
                $this->_redirect('/');
            }
        }
    }
}
?>
