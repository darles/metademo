<?php

namespace Acme\DemoBundle\Form;


use Acme\DemoBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;

class UserToCodeTransformer implements DataTransformerInterface {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof User) {
            throw new UnexpectedTypeException($value, 'Acme\DemoBundle\Entity\User');
        }

        return $value->getCode();
    }

    public function reverseTransform($code)
    {
        if (empty($code)) {
            return null;
        }

        if (!is_string($code)) {
            throw new UnexpectedTypeException($code, 'string');
        }

        return $this->em
            ->getRepository('Acme\DemoBundle\Entity\User')
            ->findOneByCode($code);
    }

}