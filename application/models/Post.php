<?php

class Application_Model_Post
{
    protected  $_table;
    
    public function __construct() {
        $this->_table = new Application_Model_DbTable_Post();
    }
    
    public function getPost($id) {
        return $this->_table->find($id)->current();
    }

    public function getAll($criterio = array()) {
        $select = $this->_table->select();
        
        //$criterio = array('limit' => 3), entao
        //$select->limit(2);
        foreach($criterio as $k => $v) {
            $select->$k($v);
        }
        
        return $this->_table->fetchAll($select);
    }
    
    public function insert($data) {
        return $this->_table->insert($data);
    }
}

