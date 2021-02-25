<?php
namespace App\Validator;

use App\Entity\Invoices;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ApproveAmountValidator extends ConstraintValidator
{
    public function validate($invoice, $constraint)
    {
        if (!$constraint instanceof ApproveAmount) {
            throw new UnexpectedTypeException($constraint, ApproveAmount::class);
        }

        if (!$invoice instanceof Invoices) {
            throw new UnexpectedTypeException($invoice, Invoices::class);
        }

        $value = $invoice->getApprovedAmount();

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_numeric($value)) {
            throw new UnexpectedValueException($value, 'number');
        }

        if (0 > $value ) {
            $this->context->buildViolation($constraint->greaterThanZero)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }

        if ($invoice->getRequestedAmount() <= $value) {
            $this->context->buildViolation($constraint->smallerThanAmount)
                ->setParameter('{{ value }}', $value)
                ->setParameter('{{requested}}', $invoice->getRequestedAmount())
                ->addViolation();
        }
    }
}
