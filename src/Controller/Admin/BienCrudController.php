<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
class BienCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bien::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('reference');
        yield TextField::new('titre');
        yield TextField::new('description');
        yield TextField::new('postal');
        yield NumberField::new('surface');
        yield TextField::new('prix');
        yield BooleanField::new('status');
        yield TextField::new('ville');
        yield AssociationField::new('categorie');
        yield ImageField::new('image')->setBasePath('uploads/images/')
        ->setUploadDir('/public/uploads/images/');
        
    }

}
