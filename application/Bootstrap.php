<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initSession()
    {
        $session = new Zend_Session_Namespace('Easywiki');
        Zend_Registry::set('session', $session);
    }

}

