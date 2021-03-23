<?php

namespace App\Controller\Admin;

use App\Entity\Riff;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RiffCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Riff::class;
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
