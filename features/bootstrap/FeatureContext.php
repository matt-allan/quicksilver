<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Mockery\Mock;
use Quicksilver\Application\Auth\Guard;
use Quicksilver\Domain\Address;
use Quicksilver\Domain\Delivery;
use Quicksilver\Domain\Delivery\Priority;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * @var Guard|Mock
     */
    private $guard;

    /**
     * @var Quicksilver\Domain\Delivery\Repository|Mock
     */
    private $deliveryRepository;

    /**
     * @var Delivery[]
     */
    private $deliveries;

    /**
     * @var mixed
     */
    private $response;

    /**
     * @var bool
     */
    private $error;

    /**
     * @var Address
     */
    private $pickupAddress;

    /**
     * @var Address
     */
    private $dropoffAddress;

    /**
     * @var Priority
     */
    private $priority;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->guard = Mockery::mock(Guard::class);

        $this->initializeDeliveryRepository();
    }

    /**
     * @Given I am logged in as a courier
     */
    public function iAmLoggedInAsACourier()
    {
        $courier = Factory::courier();

        $this->guard
            ->shouldReceive('user')
            ->zeroOrMoreTimes()
            ->andReturn($courier)
        ;
    }

    /**
     * @Given I am logged in as a customer
     */
    public function iAmLoggedInAsACustomer()
    {
        $customer = Factory::customer();

        $this->guard
            ->shouldReceive('user')
            ->zeroOrMoreTimes()
            ->andReturn($customer)
        ;
    }

    /**
     * @Given there is a delivery with ID :arg1
     */
    public function thereIsADeliveryWithId($arg1)
    {
        $delivery = Factory::delivery();
        $this->setPrivateProperty($delivery, 'id', $arg1);

        $this->deliveries[$arg1] = $delivery;
    }

    /**
     * @Given the delivery with ID :id's status is :status
     */
    public function theDeliveryWithIdSStatusIs($status, $id)
    {
        $status = $this->convertHumanReadableToEnum($status);
        $status = Delivery\Status::getByName($status);

        $delivery = $this->deliveries[$id];
        $this->setPrivateProperty($delivery, 'status', $status);
    }

    /**
     * @When I deliver package :id and collect the signature :signature
     */
    public function iDeliverPackageAndCollectTheSignature($signature, $id)
    {
        $request = new \Quicksilver\Application\Delivery\DeliverRequest($id, $signature);

        $deliver = new \Quicksilver\Application\Delivery\Deliver($this->deliveryRepository);

        try {
            $this->response = $deliver($request);
        } catch (Exception $e) {
            $this->error = true;
        }
    }

    /**
     * @Then the delivery status for delivery :id should be :status
     */
    public function theDeliveryStatusForDeliveryShouldBe($status, $id)
    {
        $status = $this->convertHumanReadableToEnum($status);
        $status = Delivery\Status::getByName($status);

        $delivery = $this->deliveries[$id];

        $actual   = $delivery->getStatus()->getValue();
        $expected = $status->getValue();

        if ($expected !== $actual) {
            throw new \Exception(sprintf('Expected status %s, got %s', $expected, $actual));
        }
    }

    /**
     * @When I pickup delivery :id
     */
    public function iPickupDelivery($id)
    {
        $request = new \Quicksilver\Application\Delivery\PickupRequest($id);

        $pickup = new \Quicksilver\Application\Delivery\Pickup($this->deliveryRepository);

        try {
            $this->response = $pickup($request);
        } catch (Exception $e) {
            $this->error = true;
        }
    }

    /**
     * @Then I should see an error
     */
    public function iShouldSeeAnError()
    {
        if ($this->error !== true) {
            throw new \Exception('Error not found');
        }
    }

    /**
     * @Given I am requesting a delivery
     */
    public function iAmRequestingADelivery()
    {
        // Don't need to actually do anything in memory.
    }

    /**
     * @Given I fill in pickup with:
     */
    public function iFillInPickupWith(TableNode $table)
    {
        foreach ($table->getRows() as $row) {
            $field = str_replace(' ', '_', $row[0]);
            $value = $row[1];
            $this->pickupAddress[$field] = $value;
        }
    }

    /**
     * @Given I fill in dropoff with:
     */
    public function iFillInDropoffWith(TableNode $table)
    {
        foreach ($table->getRows() as $row) {
            $field = str_replace(' ', '_', $row[0]);
            $value = $row[1];
            $this->dropoffAddress[$field] = $value;
        }
    }

    /**
     * @Given I fill in priority with :priority
     */
    public function iFillInPriorityWith($priority)
    {
        $priority = $this->convertHumanReadableToEnum($priority);
        $priority = Delivery\Priority::getByName($priority);

        $this->priority = $priority;
    }

    /**
     * @Given I submit the delivery request
     */
    public function iSubmitTheDeliveryRequest()
    {
        $request = new \Quicksilver\Application\Delivery\CreateRequest(
            $this->pickupAddress['name'],
            $this->pickupAddress['street'],
            $this->pickupAddress['city'],
            $this->pickupAddress['state'],
            $this->pickupAddress['post_code'],
            $this->dropoffAddress['name'],
            $this->dropoffAddress['street'],
            $this->dropoffAddress['city'],
            $this->dropoffAddress['state'],
            $this->dropoffAddress['post_code'],
            $this->priority
        );

        $create = new \Quicksilver\Application\Delivery\Create($this->deliveryRepository, $this->guard);

        try {
            $this->response = $create($request);
        } catch (Exception $e) {
            $this->error = true;
        }
    }

    /**
     * @Then the delivery request should be submitted
     */
    public function theDeliveryRequestShouldBeSubmitted()
    {
        if (!$this->response instanceof Delivery) {
            throw new \Exception('Delivery not returned.');
        }

        $id = $this->response->getId();
        $match = $this->deliveryRepository->find($id);

        if (!$match) {
            throw new \Exception('Delivery not found.');
        }
    }

    private function setPrivateProperty($class, $property, $value)
    {
        $reflector = new \ReflectionClass($class);
        $property  = $reflector->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($class, $value);
    }

    private function convertHumanReadableToEnum($string)
    {
        return strtoupper(str_replace(' ', '_', $string));
    }

    /**
     * This method just builds a mock implementation of the Delivery\Repository interface.
     */
    private function initializeDeliveryRepository()
    {
        $this->deliveryRepository = Mockery::mock(Quicksilver\Domain\Delivery\Repository::class);

        $this->deliveryRepository
            ->shouldReceive('find')
            ->zeroOrMoreTimes()
            ->andReturnUsing(function ($id) {
                return isset($this->deliveries[$id]) ? $this->deliveries[$id] : null;
            })
        ;

        $this->deliveryRepository
            ->shouldReceive('save')
            ->zeroOrMoreTimes()
            ->andReturnUsing(function (Delivery $delivery) {
                $this->deliveries[$delivery->getId()] = $delivery;
            })
        ;

        $this->deliveryRepository
            ->shouldReceive('findAll')
            ->zeroOrMoreTimes()
            ->andReturnUsing(function () {
                return $this->deliveries;
            })
        ;
    }
}
