<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use App\Entity\Forfait;
use App\Entity\Ligne;
use App\Entity\Liste;
use App\Entity\Modele;
use App\Entity\Terminal;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {

    }


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        $url =$this->adminUrlGenerator->setController(AttributionCrudController::class)->generateUrl();
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($url);

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Stock Phones');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Employes', 'fas fa-list', Employe::class);
        yield MenuItem::linkToCrud('Lignes', 'fas fa-list', Ligne::class);
        yield MenuItem::linkToCrud('Terminaux', 'fas fa-list', Terminal::class);
        yield MenuItem::linkToCrud('Forfaits', 'fas fa-list', Forfait::class);
        yield MenuItem::linkToCrud('Listes', 'fas fa-list', Liste::class);
        yield MenuItem::linkToCrud('Modèles', 'fas fa-list', Modele::class);






    }
}
