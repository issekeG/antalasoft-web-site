<?php

namespace App\Controller\Admin;

use App\Entity\Realisation;
use App\Form\RealisationImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Vich\UploaderBundle\Form\Type\VichImageType;

#[IsGranted('ROLE_ADMIN')]
class RealisationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Realisation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title'),
            AssociationField::new('service', 'Service associé')->setRequired(true),

            TextField::new('subTitle'),
            TextEditorField::new('description'),
            SlugField::new('slug')->setTargetFieldName(['title'])->onlyOnIndex(),

            TextField::new('posterFile',"Image de l'article")->setFormType(VichImageType::class)->hideOnIndex()->setRequired(True),
            ImageField::new('poster')->setBasePath('/upload/images/realisations')->OnlyOnIndex(),

            CollectionField::new('realisationImages', 'Ajouter les autres images')
                ->setEntryType(RealisationImageType::class)
                ->allowAdd(true)
                ->allowDelete(true)
                ->hideOnIndex(),
        ];
    }

}
