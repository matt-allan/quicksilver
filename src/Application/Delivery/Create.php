<?php

namespace Quicksilver\Application\Delivery;

use LogicException;
use Quicksilver\Application\Auth\Guard;
use Quicksilver\Application\Exceptions\InvalidUserException;
use Quicksilver\Domain\Address;
use Quicksilver\Domain\Customer;
use Quicksilver\Domain\Delivery;
use Quicksilver\Domain\Delivery\Priority;

class Create
{
    /**
     * @var Delivery\Repository
     */
    private $deliveryRepository;

    /**
     * @var Guard
     */
    private $guard;

    /**
     * @param Delivery\Repository $deliveryRepository
     * @param Guard               $guard
     */
    public function __construct(Delivery\Repository $deliveryRepository, Guard $guard)
    {
        $this->deliveryRepository = $deliveryRepository;
        $this->guard              = $guard;
    }

    /**
     * @param CreateRequest $request
     * @return Delivery
     * @throws InvalidUserException
     * @throws LogicException
     */
    public function __invoke(CreateRequest $request)
    {
        $pickup = new Address(
            $request->getPickupName(),
            $request->getPickupStreet(),
            $request->getPickupCity(),
            $request->getPickupState(),
            $request->getPickupPostCode()
        );

        $destination = new Address(
            $request->getDropoffName(),
            $request->getDropoffStreet(),
            $request->getDropoffCity(),
            $request->getDropoffState(),
            $request->getDropoffPostCode()
        );

        $priority = Priority::getByName($request->getPriority());

        $requester = $this->guard->user();

        if (!$requester instanceof Customer) {
            throw new InvalidUserException();
        }

        $delivery = new Delivery($pickup, $destination, $requester, $priority);

        // @todo Validate

        $this->deliveryRepository->save($delivery);

        return $delivery;
    }
}