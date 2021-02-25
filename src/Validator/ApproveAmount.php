<?php
namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ApproveAmount extends Constraint
{
    public $greaterThanZero = 'Approved amount {{ value }} should be greater than 0';
    public $smallerThanAmount = 'Approved amount {{ value }} should be smaller than the requested amount {{requested}}';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
