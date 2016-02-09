<?php
namespace Application\Form;

use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class ClienteCreationForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('create-cliente');
        $nome = new Text();
        $nome->setName("name");
        $nome->setAttribute('placeholder', 'Nome');
        $nome->setAttribute('class', 'form-control');
        $this->add($nome);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

        $this->setInputFilter($this->createInputFilter());
    }

    public function createInputFilter()
    {
        $inputFilter = new InputFilter();

        $inputFilter->add(array(
            'name' => 'name',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Zend\I18n\Validator\Alpha',
                    'options' => array(
                        'allowWhiteSpace' => false,
                    ),
                ),
            ),
        ));

        return $inputFilter;
    }

}
