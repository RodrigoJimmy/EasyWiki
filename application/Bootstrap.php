<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initSession()
    {
        $session = new Zend_Session_Namespace('Easywiki');
        Zend_Registry::set('session', $session);
    }
    
    public function _initConfig()
    {
        $config = new Zend_Config($this->getApplication()->getOptions(), true);
        Zend_Registry::set('config', $config);
    }
    
    public function _initDb()
    {
        $db = $this->getPluginResource('db')->getDbAdapter();
        Zend_Db_Table::setDefaultAdapter($db);
        Zend_Registry::set('db', $db);
    }
    
}

