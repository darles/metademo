<?php

namespace Acme\DemoBundle\Validator\Constraints;

use Acme\DemoBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueCodeValidator extends ConstraintValidator
{

    /**
     * @EntityManager
     */
    protected $em = null;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * @param User $value
     * @param Constraint $constraint
     * @return bool
     */
    public function validate($value, Constraint $constraint)
    {
        $found = $this->em->getRepository('AcmeDemoBundle:User')->findOneByCode($value->getCode());
        if ($found !== null && $found->getId() != $value->getId()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value->getCode())
                ->addViolation();
        }
    }
}