<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\EqualTo;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('birthday', 'birthday')
            ->add('email', 'email');

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();
            if ($user && $user->getId()) {
                $form->add('code', 'text');
            }
        });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\User',
            'validation_groups' => function(\Symfony\Component\Form\FormInterface $form) {
                $user = $form->getData();
                if ($user->getId()) {
                    return array('Edit');
                }

                return array('User');
            },
        ));
    }

    public function getName()
    {
        return 'user';
    }
}
