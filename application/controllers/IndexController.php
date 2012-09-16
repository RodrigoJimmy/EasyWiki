<?php

class IndexController extends Easywiki_Controller_Action
{

    public function indexAction()
    {
        $posts = new Application_Model_Post();
        $this->view->posts = $posts->getAll();
    }


}

