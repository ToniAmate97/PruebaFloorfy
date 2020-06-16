<?php
namespace App\Controller;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CarController
 * @package App\Controller
 *
 * @Route(path="/api/")
 */
class CarController
{
    private $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this-> carRepository = $carRepository;
    }

    /**
     * @Route("car", name="add_car", methods={"POST"})
     */
    //Uso la funcion addCar para SaveCar (crear coche en la BBDD)
    public function addCar(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $type = $data['type'];

        if (empty($name) || empty($type)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->carRepository->saveCar($name, $type);

        return new JsonResponse(['status' => 'Coche creado en la BBDD'], Response::HTTP_CREATED);
    }

    /**
     * @Route("cars", name="get_all_cars", methods={"GET"})
     */
    //Lista todos los coches de la BBDD
    public function getAll(): JsonResponse
    {
        $cars = $this->carsRepository->findAll();
        $data = [];

        foreach ($cars as $car) {
            $data[] = [
                'id' => $car->getId(),
                'name' => $car->getName(),
                'type' => $car->getType(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

}

?>

