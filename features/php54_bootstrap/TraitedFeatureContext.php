<?php

class TraitedFeatureContext extends Behat\Behat\Context\BehatContext
{
    use Behat\MinkExtension\Context\MinkDictionary;

    /**
     * @Then /^I wait for the suggestion box to appear$/
     */
    public function iWaitForTheSuggestionBoxToAppear()
    {
        $this->getSession()->wait(5000, "$('.suggestions-results').children().length > 0");
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
        $this->getSession()->wait(1000, "typeof angular != 'undefined'");
        // Wait for angular to be testable
        $this->getPage()->evaluateScript(
            'angular.getTestability(document.body).whenStable(function() {
                window.__testable = true;
            })'
        );
        $this->getSession()->wait(1000, 'window.__testable == true');
    } 
}
