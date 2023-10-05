<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Entity\Librairie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LibrairieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Librairie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('description'),
            AssociationField::new('livres'),
            AssociationField::new('member')
            ->setRequired(true)
            ->setHelp('Sélectionnez le membre propriétaire de cet inventaire.'),
        ];
    }

}
