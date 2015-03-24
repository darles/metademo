<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserCodeType  extends AbstractType
{
    protected $userToCodeTransformer;

    public function __construct(UserToCodeTransformer $userToCodeTransformer)
    {
        $this->userToCodeTransformer = $userToCodeTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->userToCodeTransformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'class' => 'Acme\DemoBundle\Entity\User',
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'user_code_selector';
    }
}