<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\MaitenanceCarType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DashboardController extends AbstractController
{
    public function __construct ( private EntityManagerInterface $entityManager)
    {

    }
    #[Route('/dashboard', name: 'dashboard')]
    public function home(): Response
    {
        return $this->render('dashboard/home.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/api/car', name: 'api_car_add', methods: ['GET','POST'])]
    public function addCar(Request $request ): Response
    {
        $myCar = new Car;
        $myCar->setUser($this->getUser());

        $form = $this->createForm(MaitenanceCarType::class, $myCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($myCar);
            $this->entityManager->flush();

            $this->addFlash('success', 'Maintenance record added successfully!');
            return $this->redirectToRoute('maintenance_list');
        }

        return $this->render('Maintenance/new.html.twig', [
            'form' => $form->createView(),
        ]);

    }

}
