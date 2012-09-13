<?php

class Easywiki_Controller_Action extends Zend_Controller_Action
{
    public function init()
    {
        /*echo "Executando init do Easywiki_Controller_Action...<br />";
        $registry = Zend_Registry::getInstance();
        foreach($registry as $k => $v) {
            echo "<p>Key: $k <br />";
            echo "Value: " . print_r($v);
            echo "</p>";
        }
        die();
         
         */
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
                $session->erro = 'ACL inválida';
                $this->_redirect('/');
            }
        }
    }
}
?>
