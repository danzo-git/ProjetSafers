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
        yield AssociationField::new('categorie');
        yield TextField::new('titre');
        yield NumberField::new('surface');
       // yield TextField::new('postal');
        yield BooleanField::new('status');
       
        yield TextField::new('ville');
        yield TextField::new('postal');
        yield ImageField::new('image')->setBasePath('uploads/images/')
        ->setUploadDir('/public/uploads/images/');
        
    }

}
