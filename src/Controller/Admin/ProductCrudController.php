<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Товар')
            ->setEntityLabelInPlural('Товары')
            ->setSearchFields(['name', 'description', 'summary'])
            ->setPaginatorPageSize(30)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setPageTitle(Crud::PAGE_NEW, 'Добавление нового товара')
            ->setPageTitle(Crud::PAGE_EDIT, 'Редактирование товара');
    }
    public function configureActions(Actions $actions): Actions
    {
        return
            $actions
            ->setPermission(Action::INDEX, 'ROLE_USER')
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-plus')->setLabel('Добавить товар');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-pencil')->setLabel('Редактировать товар');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('Удалить товар');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setIcon('fa fa-floppy-o')->setLabel('Сохранить');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->setIcon('fa fa-floppy-o')->setLabel('Сохранить и продолжить редактирование');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action->setIcon('fa fa-floppy-o')->setLabel('Сохранить и вставить еще');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setIcon('fa fa-floppy-o')->setLabel('Сохранить');
            })
        ;
    }
    public function configureFields(string $pageName): iterable
    {

        yield FormField::addColumn(8);
        yield TextField::new('name')
            ->setLabel('Наименование');
        yield TextareaField::new('description')
            ->setLabel('Описание');
        //->hideOnIndex();
        yield MoneyField::new('price')
            ->setLabel('Цена шт/руб')
            ->setCurrency('RUB');
        //->hideOnIndex();
        yield ImageField::new('imageFile')
            ->setFormType(FileUploadType::class)
            ->setBasePath('/uploads/photos')
            ->setUploadDir('public/uploads/photos')
            ->setFormTypeOptions([
                'upload_filename' => '[year][month][day]-[slug].[extension]'
            ])
            //->setCustomOption()
            ->setLabel('Изображение');

        /*            yield ImageField::new('photoFilename')
            ->setBasePath('/uploads/photos')
            ->setLabel('Photo')
            ->onlyOnIndex();*/

        //->onlyOnIndex();
        yield FormField::addColumn(4);
        yield IntegerField::new('sizeX')
            ->setLabel('Ширина, см');
        yield IntegerField::new('sizeZ')
            ->setLabel('Высота, см');
        yield IntegerField::new('sizeY')
            ->setLabel('Длина, см');

        yield IntegerField::new('currentCount')
            ->setLabel('Остатки, шт')
            ->setCssClass('bg-info text-center');
        //->onlyOnIndex();
        /* $createdAt = DateTimeField::new('createdAt')->setFormTypeOptions([
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text',
        ]);*/



        /* return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];*/
    }
}
