<?php

namespace App\Controller\Admin;

use App\Entity\Attribution;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AttributionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attribution::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('employeId')->autocomplete(),
            AssociationField::new('ligneId')->autocomplete(),
            AssociationField::new('terminalId')->autocomplete(),
            BooleanField::new('isIsDeleted'),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $attribution = new Attribution();
        $attribution->setIsDeleted(false);
        return $attribution;

    }
    
}
