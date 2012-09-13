<?php

class AuthController extends Easywiki_Controller_Action
{

    public function init()
    {
        parent::init();
    }

    public function indexAction() {
        $this->_redirect('/auth/login');
    }
    
    public function loginAction()
    {
        $form = new Application_Form_Login;
        if($this->_request->isPost()) {
            $formData = $this->_request->getPost();
            if($form->isValid($formData)) {
                $auth = Zend_Auth::getInstance();
                $db = Zend_Registry::get('db');
                
                $authAdapter = new Zend_Auth_Adapter_DbTable(
                        $db,
                        'users',
                        'username',
                        'password',
                        'MD5(?)'
                        );
                $authAdapter->setIdentity($formData['username'])
                        ->setCredential($formData['password']);
                
                $result = $auth->authenticate($authAdapter);
                
                $session = Zend_Registry::get('session');
                switch ($result->getCode()) {
                    case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                        $session->erro = 'Usuário inválido';
                        $form->populate($formData);
                        break;
                    case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                        $session->erro = 'Senha inválida';
                        $form->populate($formData);
                        break;
                    case Zend_Auth_Result::SUCCESS:
                        $data = $authAdapter->getResultRowObject();
                        $session->role = $data->role;
                        $this->_redirect('/post/list');
                        break;
                    default:
                        break;
                }
            } else {
                $form->populate($formData);
            }
        }
        $this->view->form = $form;
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        
        $this->_redirect('/');
    }

}

