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

  Scenario: Try to deliver a package that has not been picked up
    Given I am logged in as a courier
    And there is a delivery with ID 33
    And the delivery with ID 33's status is "received"
    When I deliver package 33 and collect the signature "Kevin Bacon"
    Then I should see an error