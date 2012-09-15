<?php

class Application_Form_Post extends Zend_Form
{

    public function init()
    {
        $this->setName('Post');
        
        $id = new Zend_Form_Element_Hidden('id');
        
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title')
                ->setRequired(true)
                ->addFilter('stripTags')
                ->addValidator('NotEmpty');
        
        $content = new Zend_Form_Element_Textarea('content');
        $content->setAttrib('rows', '15')
                ->setAttrib('class', 'field span6')
                ->setLabel('Content')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Add')
                ->setAttrib('class', 'btn btn-small btn-primary')
                ->setIgnore(true);
        
        $this->addElements(array($id, $title, $content, $submit));
        $this->setAction('/post/create')->setMethod('post');
    }
}
