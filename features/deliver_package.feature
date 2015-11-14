Feature: Deliver a package
  In order to deliver a package
  As a courier
  I should be able to deliver a package

  Scenario: Deliver a package
    Given I am logged in as a courier
    And there is a delivery with ID 33
    And the delivery with ID 33's status is "picked up"
    When I deliver package 33 and collect the signature "Kevin Bacon"
    Then the delivery status for delivery 33 should be "delivered"