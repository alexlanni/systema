<?php


namespace Systema\Form;

use Laminas\InputFilter\InputFilter;
use Laminas\Form\Form;
use Laminas\Validator\EmailAddress;

class LoginForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->add([
            'name' => 'email',
            'options' => [
                'label' => 'email',
            ],
            'type' => 'Text'
        ]);

        $this->add([
            'name' => 'password',
            'options' => [
                'label' => 'la tua password'
            ],
            'type' => 'Password'
        ]);

        $this->add([
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => [
                'value' => 'Login',
            ],
        ]);


        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'email',
            'required' => true,
            'validators' => [
                new EmailAddress()
            ],
        ]);

        $this->setInputFilter($inputFilter);

    }
}