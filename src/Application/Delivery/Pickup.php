<?php

namespace Quicksilver\Application\Delivery;

use Quicksilver\Application\Exceptions\EntityNotFoundException;
use Quicksilver\Domain\Delivery;

class Pickup
{
    /**
     * @var Delivery\Repository
     */
    private $deliveryRepository;

    /**
     * @param Delivery\Repository $deliveryRepository
     */
    public function __construct(Delivery\Repository $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }

    /**
     * @param PickupRequest $request
     * @return Delivery
     * @throws EntityNotFoundException
     */
    public function __invoke(PickupRequest $request)
    {
        $delivery = $this->deliveryRepository->find($request->getDeliveryId());

        if (!$delivery) {
            throw new EntityNotFoundException();
        }

        $delivery->pickup();

        $this->deliveryRepository->save($delivery);

        return $delivery;
    }
}