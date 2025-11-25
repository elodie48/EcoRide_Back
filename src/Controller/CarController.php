<?php

namespace App\Controller;

use App\Entity\Car;
use App\Repository\CarRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('api/car', name: 'app_api_car_')]
final class CarController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
        private CarRepository $repository,
        private SerializerInterface $serializer,
        private UrlGeneratorInterface $urlGenerator,
    )
    {
    }
    #[Route(name: 'new', methods:'POST')]
    public function new(Request $request): JsonResponse
    {
        $car = $this->serializer->deserialize($request->getContent(), Car::class, 'json');
        $car->setCreatedAt(new DateTimeImmutable());
        
        $this->manager->persist($car);
        $this->manager->flush();

        $responseData = $this->serializer->serialize($car, 'json');
        $location = $this->urlGenerator->generate(
            'app_api_car_show',
            ['id' => $car->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        return new JsonResponse(
            $responseData,
            Response::HTTP_CREATED,
            ["Location" => $location],
            true,
        );
    }

    #[Route('/{id}', name: 'show', methods:'GET')]
    public function show(int $id): JsonResponse
    {
        $car = $this->repository->findOneBy(['id' => $id]);
        if ($car) {
            $responseData = $this->serializer->serialize($car, 'json');

            return new JsonResponse(
                $responseData, 
                Response::HTTP_OK, 
                [], 
                true
            );
        }
        return new JsonResponse(
            null, 
            Response::HTTP_NOT_FOUND
        );
    }

    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id, Request $request): JsonResponse
    {
        $car = $this->repository->findOneBy(['id' => $id]);
        if ($car) {
            $car = $this->serializer->deserialize(
                $request->getContent(),
                Car::class,
                'json',
                [AbstractNormalizer::OBJECT_TO_POPULATE => $car],
            );
            $car->setUpdatedAt(new DateTimeImmutable());

            $this->manager->flush();

            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }

    #[Route('/{id}', name: 'delete',methods: 'DELETE')]
    public function delete(int $id): JsonResponse
    {
        $car = $this->repository->findOneBy(['id' => $id]);
        if ($car) {
            $this->manager->remove($car);
            $this->manager->flush();

            return $this->json(null, Response::HTTP_NO_CONTENT);
        }

        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
}

