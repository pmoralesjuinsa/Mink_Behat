Feature: Scrap behat references from wikipedia
  In order get behat references
  As an anonymous user
  I visit wikipedia behat entry and scrap the references list

  Scenario: Scrap references
    Given I am on "https://www.wikipedia.org"
    Then I should see "The Free Encyclopedia"
    When I follow "English"
    Then the url should match "wiki/Main_Page"
    And I should see "Welcome to Wikipedia,"
    When I fill in "Search Wikipedia" with "behat computer"
    And I press "Search Wikipedia"
    And print current URL
    And I follow "Behat (computer science)"
    Then I should see "Behat is intended to aid communication between"
    And I save references in a local storage device