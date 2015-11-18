Feature: Request package delivery
  In order to request a package is delivered
  As a customer
  I should be able to submit a delivery request

  Scenario: Place a standard delivery request
    Given I am logged in as a customer
    And I am requesting a delivery
    And I fill in pickup with:
      | name      | Tyler Durden |
      | street    | 555 paper st |
      | city      | Chicago      |
      | state     | Illinois     |
      | post code | 94063        |
    And I fill in dropoff with:
      | name      | Tyler Durden |
      | street    | 555 paper st |
      | city      | Chicago      |
      | state     | Illinois     |
      | post code | 94063        |
    And I fill in priority with "standard"
    And I submit the delivery request
    Then the delivery request should be submitted