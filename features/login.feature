Feature: Login
  As user
  I want to login
  To see my data
  
  @javascript
  Scenario Outline: Login
    Given "<user>" is on the login page
    And they complete the login form
    Then they should see be on the dashboard page
	
  Examples:
  |user|
  |admin|
  |user|