<?php

class IndexController extends Easywiki_Controller_Action
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $posts = new Application_Model_Post();
        $this->view->posts = $posts->getAll(
                array(
                    'order' => 'created DESC',
                    'limit' => 3)
                );
    }
}

