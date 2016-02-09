<?php
namespace Application\Form;

use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\I18n\Validator\PhoneNumber;
use Zend\InputFilter\InputFilter;

class ClienteCreationForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('create-cliente');
        //nome
        $nome = new Text();
        $nome->setName("name");
        $nome->setAttribute('placeholder', 'Nome');
        $nome->setAttribute('class', 'form-control');
        $this->add($nome);

        //cognome
        $cognome = new Text();
        $cognome->setName("cognome");
        $cognome->setAttribute('placeholder', 'Cognome');
        $cognome->setAttribute('class', 'form-control');
        $this->add($cognome);

        //email
        $email = new Text();
        $email->setName("email");
        $email->setAttribute('placeholder', 'email');
        $email->setAttribute('class', 'form-control');
        $this->add($email);

        // numero di telefono
        $num = new Text();
        $num->setName("num");
        $num->setAttribute('placeholder', 'Numero di telefono');
        $num->setAttribute('class', 'form-control');
        $this->add($num);

        //bottone
        $btn=new Submit();
        $btn->setName("submit");
        $btn->setAttribute('value','go');
        $btn->setAttribute('id','submitbutton');
        $btn->setAttribute('class', 'btn btn-primary');
        $this->add($btn);

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

        $inputFilter->add(array(
            'name' => 'cognome',
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
        $inputFilter->add(array(
            'name' => 'email',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Zend\Validator\EmailAddress',
                    'options' => array(
                        'allowWhiteSpace' => false,
                    ),
                ),
            ),
        ));
        $phoneValidator = new PhoneNumber();
        $phoneValidator->setCountry('it');

        $inputFilter->add(array(
            'name' => 'num',
            'required' => true,
            'validators' => array(
                $phoneValidator,
            ),
        ));

        return $inputFilter;

    }

}
