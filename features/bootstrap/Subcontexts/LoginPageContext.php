<?php
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;
use Behat\Behat\Event\StepEvent;
use Behat\Behat\Context\BehatContext;
use Behat\Behat\Context\Step\Then;
use Behat\Behat\Context\Step\When;
//use Drupal\DrupalExtension\Context\DrupalContext;
use Behat\Behat\Context\ClosuredContextInterface;
use Behat\Behat\Context\TranslatedContextInterface;
use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
require_once __DIR__.'/../User.php';
/**
 * Features context.
 */
class LoginPageContext extends PageObjectContext 
{
  /**
   *
   */
   var $user = NULL;
  /**
   * @Given /^"([^"]*)" is on the Login page$/
   */
  public function isOnTheLoginPage($name) {
    if (!$this->user = User::load($name)) {
      throw new Exception("Failed to load user for {$name}");
    }
    $this->getPage("Login Page")->open();
  }
  /**
   * @Given /^they complete the Login form but do not agree to the terms of service$/
   */
  public function theyCompleteTheLoginFormButDoNotAgreeToTheTermsOfService() {
    if (!$this->user) {
      throw new Exception("User not loaded");
    }
    $this->getPage("Login Page")->enterUserDetailsOnLoginForm($this->user);
    $this->getPage("Login Page")->doNotAgreeWithTermsAndConditionsOnLoginForm();
    $this->getPage("Login Page")->submitLoginForm();
  }
  /**
   * @Given /^should be on the Login page$/
   */
  public function shouldBeOnTheLoginPage() {
    throw new PendingException();
  }
  /**
   * @Then /^they should see a warning message telling them to accept the terms of service$/
   */
  public function theyShouldSeeAWarningMessageTellingThemToAcceptTheTermsOfService() {
    expect($this->getPage("Login Page")->hasATermsOfServiceWarningMessage());
  }
}