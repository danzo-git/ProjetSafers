<?php

namespace App\Controller\Admin;

use App\Entity\Favoris;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FavorisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Favoris::class;
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
