<?php

class ContactController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_redirect('/contact/send');
    }

    public function sendAction()
    {
        $form = new Application_Form_Contact();
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
                    
            } catch (Exception $e) {
                print $erro = $e->getMessage();
            }
            
                
                
            } else {
                $form->populate($form->getValues());
            }
        }
        
        $this->view->form = $form;
    
    }


}



