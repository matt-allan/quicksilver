<?php

namespace Quicksilver\Application\Delivery;

use Quicksilver\Application\Exceptions\EntityNotFoundException;
use Quicksilver\Domain\Delivery;

class Deliver
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
     * @param DeliverRequest $request
     * @return Delivery
     * @throws EntityNotFoundException
     */
    public function __invoke(DeliverRequest $request)
    {
        $delivery = $this->deliveryRepository->find($request->getDeliveryId());

        if (!$delivery) {
            throw new EntityNotFoundException();
        }

        $delivery->deliver($request->getSignature());

        $this->deliveryRepository->save($delivery);

        return $delivery;
    }
}