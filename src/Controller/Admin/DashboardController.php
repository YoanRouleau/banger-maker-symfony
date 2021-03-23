<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Instrument;
use App\Entity\Note;
use App\Entity\Riff;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Banger Maker Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Categorie', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Instrument', 'fas fa-list', Instrument::class);
        yield MenuItem::linkToCrud('Note', 'fas fa-list', Note::class);
        yield MenuItem::linkToCrud('Riff', 'fas fa-list', Riff::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
    }
}
