<?php

namespace App\Controller\Admin;

use App\Entity\Ligne;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LigneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ligne::class;
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
