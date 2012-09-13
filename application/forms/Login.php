<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
       $this->setname('Login');
       
       $username = new Zend_Form_Element_Text('username');
       $username->setlabel('Login')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addValidator('NotEmpty');
       
       $password = new Zend_Form_Element_Password('password');
       $password->setLabel('Senha')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addValidator('NotEmpty');
       
       $submit = new Zend_Form_Element_Submit('submit');
       $submit->setLabel('Entrar');
       $submit->setAttrib('id', 'Entrar')
               ->setIgnore(true);
       
       $this->addElements(array($username, $password, $submit));
       $this->setAction('/auth/login')->setMethod('post');
    }


}

