<?php

class InheritedFeatureContext extends Behat\MinkExtension\Context\MinkContext
{
    //http://docs.behat.org/en/v2.5/cookbook/behat_and_mink.html
    /**
     * @Then /^I wait for the suggestion box to appear$/
     */
    public function iWaitForTheSuggestionBoxToAppear()
    {
        $this->getSession()->wait(5000, "$('.suggestions-results').children().length > 0");
    }
    /**
     * @Then /^I wait for the ctreesPopup to appear$/
     */
    public function iWaitForCtreesPopupToAppear()
    {
        $this->getSession()->wait(5000, "$('.sweet-alert.showSweetAlert.visible').children().length > 0");
    }    
    /**
     * @Then /^I wait for angular$/
     */
    public function iWaitForAngular()
    {
        $this->waitForAngular();
    }

    private function waitForAngular()
    {
        // Wait for angular to load
        $this->getSession()->wait(10000, "typeof angular != 'undefined'");
        // Wait for angular to be testable
        $this->getSession()->evaluateScript(
            'angular.getTestability(document.body).whenStable(function() {
                window.__testable = true;
            })'
        );
        $this->getSession()->wait(10000, 'window.__testable == true');
    }
    
    /**
     * @Given /^I wait for "([^"]*)" seconds$/
     */
    public function iWaitForSeconds($arg1)
    {
        $this->getSession()->wait(1000*$arg1);
    }
        
    /**
     * @Given /^a form field with "([^"]*)"$/
     */
    public function aFormFieldWith($arg1)
    {
        throw new \RuntimeException('Test Error - Value passed: '.$arg1);
    }
    
    /**
     * @When /^(?:|I )click the ctreesButton "([^"]*)"$/
     */
    public function clickCtreesButton($arg1)
    {
        $page = $this->getSession()->getPage();
        $element = $page->findButton('css','form');
        $element->press();
        throw new \RuntimeException('clickCtreesButton is: '.$element.gettext());
    }
    
    /**
     * @When /^(?:|I )click the ctreesCSS "([^"]*)"$/
     */
    public function clickCtreesCSS($arg1)
    {
        $page = $this->getSession()->getPage();
        $findName = $page->find("css", $arg1);
        if (!$findName){
            throw new Exception($arg1." could not be found");
        }
        else {
            $findName->click();
        }
    }
    
    /** Click on the element with the provided xpath query
    *
    * @When /^I click on the element with xpath "([^"]*)"$/
    */
    public function iClickOnTheElementWithXPath($xpath)
    {
        $session = $this->getSession(); // get the mink session
        $element = $session->getPage()->find(
            'xpath',
            $session->getSelectorsHandler()->selectorToXpath('xpath', $xpath)
        ); // runs the actual query and returns the element
    
        // errors must not pass silently
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate XPath: "%s"', $xpath));
        }
    
        // ok, let's click on it
        $element->click();
    
    }
}
