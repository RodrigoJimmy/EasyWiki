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
        $form = new Application_Form_Post();
        $post = new Application_Model_Post();
        
        if($this->_request->isPost()) {
            if($form->isValid($this->_request->getPost())) {
                $id = $post->insert($form->getValues());
                $this->_redirect('/');
            } else {
                $form->populate($form->getValues);
            }
        }
        $this->view->form = $form;
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









