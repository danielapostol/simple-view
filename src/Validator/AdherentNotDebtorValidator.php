<?php
namespace App\Validator;

use App\Entity\Invoices;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AdherentNotDebtorValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof AdherentNotDebtor) {
            throw new UnexpectedTypeException($constraint, AdherentNotDebtor::class);
        }

        if (!$value instanceof Invoices) {
            throw new UnexpectedTypeException($value, Invoices::class);
        }

        if (null === $value->getDebtor() || null === $value->getAdherent()) {
            return;
        }

        if (null === $value) {
            return;
        }

        if ($value->getDebtor()->getName() === $value->getAdherent()->getName()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value->getAdherent()->getName())
                ->addViolation();
        }
    }
}
