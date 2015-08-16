Feature: Search
  In order to see a word definition
  As a website user
  I need to be able to search for a word

#  Scenario: Searching for a page that does exist
#    Given I am on "/wiki/Main_Page"
#    When I fill in "search" with "Behavior Driven Development"
#    And I press "searchButton"
#    Then I should see "software development process"

#  Scenario: Searching for a page that does NOT exist
#    Given I am on "/wiki/Main_Page"
#    When I fill in "search" with "Glory Driven Development"
#    And I press "searchButton"
#    Then I should see "Search results"

#  @javascript
#  Scenario: Searching for a page with autocompletion
#    Given I am on "/wiki/Main_Page"
#    When I fill in "search" with "Behavior Driv"
#    And I wait for the suggestion box to appear
#    Then I should see "Behavior-Driven Development"
     
  @javascript
  Scenario: Login
    Given I am on "/#/login"
#--This wait for angular seems to work, but it is initial load
    And I wait for angular
    Then I should see text matching "Sign In"
    And I should see an "input#email" element
    And I should see an "input#password" element
    When I fill in "email" with "admin@admin.com"
    And  I fill in "password" with "admin"
#--This click/press works BUT is a Button
    And I press "Sign in"
    Then I wait for the suggestion box to appear
    And I should see text matching "ctrees test"
    Then I wait for the suggestion box to appear
#--The click does not seem to work BUT IS NOT A BUTTON or LINK
#---We may need to move/focus first as event stuff may need the focus change to setup js stuff??
    When I click the ctreesCSS "small-box[name='Pokes']"
#--This wait does not seem to do anything, but angular could be ready
    And I wait for angular
    When I go to "/#/app/pokes"
    And I wait for angular
    Then I should see "Pokes"
    And I wait for angular
#--Use a regular delay and the render seems to catch up
    And I wait for "3" seconds
    And I should see "Manage your pokes here!"
    When I follow "Add"
    And I wait for "3" seconds
    Then I should see 2 "input" elements
#--There must be more textarea than I think
    Then I should see 2 "textarea" elements
    And I should see an "input.form-control[name='title']" element
    And I should see an "textarea.form-control" element
    And I should see an "input.form-control[name='image']" element
    When I fill in "Title" with "TestPoke"
    And  I fill in "image" with "http://placehold.it/350x150"
    And  I fill in "Content" with "This is a test Poke"
    And I press "Submit"
    And I wait for "5" seconds
    Then I should see "TestPoke"
    And I should see "This is a test Poke"
#--WIP need to delete what I put in
#    When I press "i.fa-trash-o"
#    And I wait for the ctreesPopup to appear
#    And I wait for "20" seconds

