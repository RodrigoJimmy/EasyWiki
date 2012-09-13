<?php

class Application_Form_Contact extends Zend_Form
{

    public function init()
    {
        $this->setName('contact');
        $sender = new Zend_Form_Element_Text('sender');
        $sender->setLabel('Remetente')
                ->setRequired(true)
                ->addFilter('stripTags')
                ->addValidator('EmailAddress');
        
        $message = new Zend_Form_Element_Textarea('message');
        $message->setLabel('Mensagem')
                ->setAttrib('rows', '15')
                ->setAttrib('class', 'field span6')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Send')
                ->setAttrib('class', 'btn btn-small btn-primary')
                ->setIgnore(true);
        
        $this->addElements(array($sender, $message, $submit));
        $this->setAction('/contact/send')->setMethod('post');
    }


}

