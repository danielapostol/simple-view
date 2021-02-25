<?php
namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AdherentNotDebtor extends Constraint
{
    public $message = 'Adherent {{ value }} cannot be debtor at the same time';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
