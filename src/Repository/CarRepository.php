<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Car::class);
        $this->manager = $manager;
    }
    //funcion para guardar el coche en la BBDD
    public function saveCar($name, $type)
    {
        $newCar = new Car();

        $newCar
            //guardo el nombre y el tipo
            ->setName($name)
            ->setType($type);

        $this->manager->persist($newCar);
        $this->manager->flush();
    }

}
