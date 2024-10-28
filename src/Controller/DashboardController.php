<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\MaitenanceCarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function home(): Response
    {
        return $this->render('dashboard/home.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
    #[Route('/api/add/car', name: 'add_car', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $myCar = new Car;
        $myCar->setUser($this->getUser());

        $form = $this->createForm(MaitenanceCarType::class, $myCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($myCar);
            $entityManager->flush();

            $this->addFlash('success', 'Maintenance record added successfully!');
            return $this->redirectToRoute('maintenance_list');
        }

        return $this->render('Maintenance/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
