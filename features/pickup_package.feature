Feature: Pickup a package
  In order to deliver a package
  As a courier
  I should be able to pickup a package

  Scenario: Pickup a package
    Given I am logged in as a courier
    And there is a delivery with ID 943
    And the delivery with ID 943's status is "received"
    When I pickup delivery 943
    Then the delivery status for delivery 943 should be "picked up"

  Scenario: Pickup a package that has already been picked up
    Given I am logged in as a courier
    And there is a delivery with ID 722
    And the delivery with ID 722's status is "picked up"
    When I pickup delivery 722
    Then I should see an error

  Scenario: Pickup a package that has already been delivered
    Given I am logged in as a courier
    And there is a delivery with ID 422
    And the delivery with ID 422's status is "delivered"
    When I pickup delivery 422
    Then I should see an error