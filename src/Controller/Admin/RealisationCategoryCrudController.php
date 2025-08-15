<?php

namespace App\Controller\Admin;

use App\Entity\RealisationCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RealisationCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RealisationCategory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name', 'Nom du service')
        ];
    }

}
