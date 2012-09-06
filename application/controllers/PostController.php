<?php

class PostController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function getAction()
    {
        if($this->_getParam('id')) {
            $post = new Application_Model_Post();
            $this->view->post = $post->getPost($this->_getParam('id'));
        }
    }

    public function listAction()
    {
        $posts = new Application_Model_Post();
        $this->view->posts = $posts->getAll(array('order' => 'created DESC'));
    }


}





