<?php

namespace App\Controller\Admin;

use App\Entity\Forfait;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ForfaitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Forfait::class;
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
