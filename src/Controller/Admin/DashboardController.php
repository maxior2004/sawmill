<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Production;
use App\Entity\Shipment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ShipmentCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Лесопилка');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Продукция', 'fa fa-home', Product::class)
            ->setPermission('ROLE_ADMIN');;
        yield MenuItem::linkToCrud('Производство', 'fa fa-arrow-right', Production::class);
        yield MenuItem::linkToCrud('Реализация', 'fa fa-arrow-left', Shipment::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        //yield MenuItem::linkToCrud('Conferences', 'fas fa-map-marker-alt', Conference::class);
        // yield MenuItem::linkToCrud('Comments', 'fas fa-comments', Comment::class);
    }
}
