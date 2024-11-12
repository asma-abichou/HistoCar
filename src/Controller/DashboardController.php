<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\MaintenanceFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DashboardController extends AbstractController
{
    public function __construct ( private readonly EntityManagerInterface $entityManager)
    {

    }
    #[Route('/dashboard', name: 'dashboard')]
    public function home(): Response
    {
        return $this->render('dashboard/home.html.twig');
    }

    #[Route('/add/car', name: 'car_register_form', methods: ['GET'])]
    public function showCarRegisterForm(): Response
    {
        return $this->render('Maintenance/new.html.twig'); // Render the form view template
    }

    #[Route('/register/car', name: 'car_new_add', methods: ['GET','POST'])]
    public function addCar(Request $request ): JsonResponse
    {
        // Parse JSON data from the request
        $data = json_decode($request->getContent(), true);
        // Create and persist the Car entity
        $car = new Car;

        $car->setMake($data['make']);
        //dd($car);
        $car->setModel($data['model']);
        $car->setYear((int) $data['year']);
        $car->setMileage((int) $data['mileage']);

        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Car registered successfully'], 200);
    }

    #[Route('/list/car', name: 'list_car', methods: ['GET'])]
    public function showCarListSaved(): Response
    {
        $car = $this->entityManager->getRepository(Car::class)->findAll();

        return $this->render('Maintenance/list.html.twig', [
            'cars'=> $car
        ]); // Render the form view template
    }

    #[Route('/add/Maintenance', name: 'add_maintenance', methods: ['GET'])]
    public function CreateMaintenanceCar(Request $request): Response
    {

        $form = $this->createForm(MaintenanceFormType::class);
        $form->handleRequest($request);
        return $this->render('Maintenance/CreateMaintenance.html.twig', [
            'form'=> $form
        ]); // Render the form view template
    }

}
