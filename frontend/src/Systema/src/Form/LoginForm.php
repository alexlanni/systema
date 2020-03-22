<?php


namespace Systema\Form;

use Laminas\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);

        $this->add([
            'name' => 'email',
            'options' => [
                'label' => 'email'
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

    }
}