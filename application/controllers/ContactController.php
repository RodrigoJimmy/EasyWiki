<?php

class ContactController extends Easywiki_Controller_Action
{

    public function indexAction()
    {
        $this->_redirect('/contact/send');
    }

    public function sendAction()
    {
        $form = new Application_Form_Contact();
        $session = Zend_Registry::get('session');
        if($this->_request->isPost()) {
            if($form->isValid($this->_request->getPost())) {
                /* envia email */
                $smtp = 'smtp.servidor.com';
                $conta = 'rodrigo@servidor.com';
                $senha = '123456';
                $de = $form->getValue('sender');
                $para = $conta;
                $assunto = 'Easywiki - contato';
                $mensagem = $form->getValue('message');
                
                try {
                    $mailTransport = new Zend_Mail_Transport_Smtp(
                            $smtp,
                            array(
                                'auth' => 'login',
                                'username' => $conta,
                                'password' => $senha,
                                'ssl'   => 'tls',
                                'port'  => '587'
                            )
                        );
                    $mail = new Zend_Mail('UTF-8');
                    $mail->setFrom($de);
                    $mail->addTo($para);
                    $mail->setSubject($assunto);
                    $mail->setBodyText($mensagem);
                    $mail->send($mailTransport);
                    
                    $session->success[] = "Email enviado com sucesso";
            } catch (Exception $e) {
                $session->errors[] = $e->getMessage();
            }
            $this->redirect('/contact');
                
                
            } else {
                $form->populate($form->getValues());
            }
        }
        
        $this->view->form = $form;
    
    }


}



