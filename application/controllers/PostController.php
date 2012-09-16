<?php

class PostController extends Easywiki_Controller_Action
{
    
    public function indexAction()
    {
        // action body
    }

    public function createAction()
    {
        $form = new Application_Form_Post();
        $post = new Application_Model_Post();
        $session = Zend_Registry::get('session');
        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $id = $post->insert($form->getValues());
                $session->success[] = 'Post cadastrado';
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

        if ($id) {
            $this->view->post = $post->getPost($id)->current();
        } else {
            $this->view->posts = $post->getAll();
        }
    }

    public function updateAction()
    {
        $form = new Application_Form_Post;
        $form->setAction('/post/update');
        $form->submit->setLabel('Update');
        $post = new Application_Model_Post();
        $session = Zend_Registry::get('session');


        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $values = $form->getValues();
                $post->update($values, 'id = ' . $values['id']);
                $session->success[] = "Post atualizado";
                $this->_redirect('/');
            } else {
                $form->populate($form->getValues());
            }
        } else {
            $id = $this->_getParam('id');
            $post = $post->getPost($id)->current()->toArray();
            $form->populate($post);
        }

        $this->view->form = $form;
    }

    public function deleteAction()
    {
        $post = new Application_Model_Post();
        $id = $this->_getParam('id');
        $session = Zend_Registry::get('session');

        if ($this->_getParam('confirm')) {
            $post->delete("id = $id");
            $this->_redirect('/');
        } else {
            $session->warnings[] = "Tem certeza que deseja remover este post?";
            $form = new Application_Form_Post();
            $post = $post->getPost($id)->current()->toArray();
            $form->populate($post);
            $form->removeElement("submit");
            $form->getElement('title')->setAttrib('disabled', 'disabled');
            $form->getElement('content')->setAttrib('disabled', 'disabled');
            $this->view->form = $form;
        }
    }

    public function listAction()
    {
        $post = new Application_Model_Post();
        $this->view->posts = $post->getAll(array('order' => 'created DESC'));
    }


}



