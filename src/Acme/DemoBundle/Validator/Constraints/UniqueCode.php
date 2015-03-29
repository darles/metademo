<?php

namespace Acme\DemoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueCode extends Constraint
{
    public $message = 'Code "%string%" is already used.';

    public function validatedBy()
    {
        return 'acme_demo_unique_code';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}