<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Intl\NumberFormatter\NumberFormatter;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\EqualTo;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', 'entity', array(
                'class' => 'AcmeDemoBundle:Category',
                'property' => 'selectTitle'
            ))
            ->add('title', 'text', array('constraints' => new EqualTo(['value' => 'test', 'message' => 'custom_message'])))
            ->add('time', 'date')
            ->add('price', 'money', array('grouping' => NumberFormatter::GROUPING_USED))
            ->add('content', 'textarea');
        $builder->add('user', 'user_code_selector');
        //$builder->add('user', new UserType());

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            dump('PRE_SET_DATA');
            dump($event->getData());
        });

        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
            dump('POST_SET_DATA');
            dump($event->getData());
        });

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            dump('PRE_SUBMIT');
            dump($event->getData());
        });

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            dump('SUBMIT');
            $data = $event->getData();
            dump($data);
            $data->setContent(strtolower($data->getContent()));
            $event->setData($data);
        });

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            dump('POST_SUBMIT');
            dump($event->getData());
        });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\DemoBundle\Entity\Post',
        ));
    }

    public function getName()
    {
        return 'post';
    }
}
