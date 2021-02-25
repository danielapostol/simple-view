<?php
namespace App\Tests;

use App\Entity\AdherentDebtor;
use App\Entity\Invoices;

use App\Validator\AdherentNotDebtor;
use App\Validator\AdherentNotDebtorValidator;
use App\Validator\ApproveAmountValidator;
use App\Validator\ApproveAmount;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilder;

class InvoiceCustomValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function testApprovedAmountBetween0AndRequestedAmount() {
        $invoice = $this->createInvoice();
        $approveAmountValidator = new ApproveAmountValidator();
        $approveAmount = new ApproveAmount();

        $context = $this->mockExecutionContextOnError($approveAmount->greaterThanZero);

        $invoice->setApprovedAmount(-2);

        $approveAmountValidator->initialize($context);
        $approveAmountValidator->validate($invoice, $approveAmount);

        $context = $this->mockExecutionContextOnError($approveAmount->smallerThanAmount);
        $invoice->setApprovedAmount(12);

        $approveAmountValidator->initialize($context);
        $approveAmountValidator->validate($invoice, $approveAmount);

        $context = $this->mockExecutionContextOnValid();
        $invoice->setApprovedAmount(8);

        $approveAmountValidator->initialize($context);
        $approveAmountValidator->validate($invoice, $approveAmount);
    }

    /**
     * @test
     */
    public function testAdherentNotDebtor() {
        $invoice = $this->createInvoice();
        $adherentNotDebtorValidator = new AdherentNotDebtorValidator();
        $adherentNotDebtorConstraint = new AdherentNotDebtor();

        $invoice->setDebtor($invoice->getAdherent());
        $context = $this->mockExecutionContextOnError($adherentNotDebtorConstraint->message);

        $adherentNotDebtorValidator->initialize($context);
        $adherentNotDebtorValidator->validate($invoice, $adherentNotDebtorConstraint);

        $debtor = new AdherentDebtor();
        $debtor->setName('debtor');

        $invoice->setDebtor($debtor);
        $context = $this->mockExecutionContextOnValid();

        $adherentNotDebtorValidator->initialize($context);
        $adherentNotDebtorValidator->validate($invoice, $adherentNotDebtorConstraint);

    }
    private function mockExecutionContextOnError(string $message): ExecutionContext
    {
        $builder = $this->getMockBuilder(ConstraintViolationBuilder::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['addViolation'])
            ->getMock()
        ;

        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();

        $context->expects($this->once())
            ->method('buildViolation')
            ->with($this->equalTo($message))
            ->will($this->returnValue($builder))
        ;

        return $context;
    }

    private function mockExecutionContextOnValid(): ExecutionContext
    {
        $builder = $this->getMockBuilder(ConstraintViolationBuilder::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['addViolation'])
            ->getMock()
        ;

        $context = $this->getMockBuilder(ExecutionContext::class)
            ->disableOriginalConstructor()
            ->getMock();

        $approveAmount = new ApproveAmount();

        $context->expects($this->never())
            ->method('buildViolation')
        ;

        return $context;
    }


    private function createInvoice() {
        $adherent = new AdherentDebtor();
        $adherent->setName('adherent');

        $debtor = new AdherentDebtor();
        $debtor->setName('debtor');

        $invoice = new Invoices();
        $invoice->setRequestedAmount(10.00);
        $invoice->setApprovedAmount(0.00);

        $invoice->setAdherent($adherent);
        $invoice->setDebtor($debtor);

        return $invoice;
    }


}
