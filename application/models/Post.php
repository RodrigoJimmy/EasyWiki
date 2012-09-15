<?php

class Application_Model_Post
{
    protected $_table;
    
    public function __construct() {
        $this->_table = new Application_Model_DbTable_Post();
    }
    
    public function getPost($id) {
        return $this->_table->find($id)->current();
    }

}

