<?php

namespace App\Controller;

use App\Entity\Invoices;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;

class InvoicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Invoices::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setFormTypeOption('disabled', true),
            AssociationField::new('adherent')->setLabel('Adherent'),
            AssociationField::new('debtor')->setLabel('Debtor'),
            DateTimeField::new('issueDate')->setFormTypeOption('disabled', true),
            DateTimeField::new('dueDate')->setFormTypeOption('disabled', true),
            CurrencyField::new('currency')->setFormTypeOption('disabled', true),
            NumberField::new('invoiceAmount')->setNumDecimals(2)->setFormTypeOption('disabled', true),
            NumberField::new('requestedAmount')->setNumDecimals(2)->setFormTypeOption('disabled', true),
            NumberField::new('approvedAmount')
                ->setNumDecimals(2)
        ];

    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(NumericFilter::new('invoiceAmount'))
            ->add(EntityFilter::new('adherent'))
            ->add(EntityFilter::new('debtor'))
            ;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(10);
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
