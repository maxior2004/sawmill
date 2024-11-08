<?php

namespace App\Controller\Admin;

use App\Entity\Production;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Production::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Поступление на реализацию')
            ->setEntityLabelInPlural('Поступления на реализцию')
            ->setPaginatorPageSize(30)
            ->setPaginatorRangeSize(4)
            ->setPaginatorUseOutputWalkers(true)
            ->setPaginatorFetchJoinCollection(true)
            ->setPageTitle(Crud::PAGE_NEW, 'Добавление нового поступления');
    }
    public function configureActions(Actions $actions): Actions
    {

        return
            $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-plus')->setLabel('Добавить поступление');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('Удалить поступление');
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
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::EDIT);
    }


    public function configureFields(string $pageName): iterable
    {

        yield AssociationField::new('product')
            ->setLabel('Наименование товара');
        yield IntegerField::new('count')
            ->setLabel('Количество');
        yield DateField::new('createdAt')
            ->setLabel('Время приема')
            ->setFormat('dd-MM-Y HH:mm')
            ->renderAsText()
            ->onlyOnIndex();
    }
}
