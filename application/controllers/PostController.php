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

    public function createAction()
    {
        // action body
    }

    public function readAction()
    {
        $post = new Application_Model_Post;
        $id = $this->_getParam('id');
        
        if($id) {
            $this->view->posts = $post->getPost($id);
        } else {
            $this->view->posts = $post->getAll();
        }
    }

    public function updateAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }


}









