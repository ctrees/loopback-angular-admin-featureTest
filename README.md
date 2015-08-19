# loopback-angular-admin-featureTest 
cathack of [MinkExtension-example](https://github.com/ctrees/MinkExtension-example)

1. Initial Setup
    - curl http://getcomposer.org/installer | php
    - php composer.phar install
    - Fire up a local selenium server (http://127.0.0.1:4444/wd/hub) 
    - bin/behat
    - should test https://ctreesadmin.herokuapp.com/
    - restAPI browser https://ctreesadmin.herokuapp.com/explorer/
2. Angular Client Hacks
    - Point base_url to 'https://ctreesadmin.herokuapp.com' in behat.yml.dist
    - comment out old feature in search.feature and add new feature to bottom
    - Hack features/bootstrap/InheritedFeatureContext.php to make work
    - To run: bin/behat
    - To see Domain Language strings: bin/behat -dl
    - Notes:
        - click of non button does not work
        - pick up on and test a javascript css change to confirm a user interaction
        - may need to issue movemouse / hover stuff to activate user interaction??
    - The end of Angular Client Hacks
3. PageObject Model Test
    - add behat-page-object-extension to composer.json (http://behat-page-object-extension.readthedocs.org/en/latest/guide/installation.html)
    - add extension to behat.yml (http://behat-page-object-extension.readthedocs.org/en/latest/guide/installation.html)
    - add page and element namespace locations to behat.yml (http://behat-page-object-extension.readthedocs.org/en/latest/guide/configuration.html)
    

## Random Stuff
- https://alfrednutile.info/posts/57
- http://stackoverflow.com/questions/15182000/behat-mink-unable-to-simulate-click-on-button-in-footer
- http://www.w3schools.com/cssref/css_selectors.asp
- http://stackoverflow.com/questions/13365910/can-i-make-behat-zombiejs-mink-simulate-a-click-on-a-non-link-element-to-fire
- http://mink.behat.org/en/latest/guides/traversing-pages.html#traversal-methods
- http://docs.behat.org/en/v2.5/cookbook/using_the_profiler_with_minkbundle.html
- https://github.com/sreedevivedula/wdjs_first_test/blob/master/spec/mifos_login_spec_pass_1.js
- https://github.com/sensiolabs/BehatPageObjectExtension
- https://github.com/andrewlcg/behat_tutorial/blob/master/features/bootstrap/Page/SignupPage.php
- http://capgemini.github.io/bdd/effective-bdd/
- https://alfrednutile.info/posts/151
- https://www.heroku.com
---

# A Behat 2.4 + Mink + 1.4 Demo

## Mink

Mink is a browser emulators abstraction layer.

It defines a basic API through which you can talk with specific browser emulator libraries.

Mink drivers define a bridge between Mink and those libraries.

**This repository will allow you to easily try Mink and Behat to test… wikipedia.org!**

## Usage 

Clone this repo:

``` bash
git clone https://github.com/Behat/MinkExtension-example
```

Now install Behat, Mink, MinkExtension and their dependencies with [composer](http://getcomposer.org/):

``` bash
curl http://getcomposer.org/installer | php
php composer.phar install
```

Now to launch Behat, just run:

``` bash
bin/behat
```

Launch Behat: the two first scenarios should use Goutte.
The third one checks that the JS autocomplete field works on wikipedia: it uses Selenium WebDriver!
but lets ignore it for a quick start with `--tags` filter:

``` bash
vendor/bin/behat --tags ~@javascript
```

You should see an output like:

``` gherkin
Feature: Search
  In order to see a word definition
  As a website user
  I need to be able to search for a word

  Scenario: Searching for a page that does exist
    Given I am on /wiki/Main_Page
    When I fill in "search" with "Behavior Driven Development"
    And I press "searchButton"
    Then I should see "agile software development"

  Scenario: Searching for a page that does NOT exist
    Given I am on /wiki/Main_Page
    When I fill in "search" with "Glory Driven Development"
    And I press "searchButton"
    Then I should see "Search results"

2 scenarios (2 passed)
8 steps (8 passed)
```

### Different types of contexts

There's 4 ways to run this suite:

1. Using `TraitedFeatureContext`, which leverages php5.4 traits
   for clean reusability. If you have php5.4 installed, just call:

   ``` bash
   bin/behat -p=traits
   ```

2. Using `SimpleFeatureContext`, which uses inheritance mechanism to
   get predefined step definitions. If you prefer 5.3 and inheritance, just call:

   ``` bash
   bin/behat -p=inheritance
   ```

3. Using `SubcontextedFeatureContext`, which uses subcontexts mechanism to
   get predefined step definitions. If you prefer 5.3 and subcontexts, just call:

   ``` bash
   bin/behat -p=subcontexts
   ```

4. Using no context. This way will use default context from extension, giving you
   ability to avoid context creation altogether. Profile `no_context` uses non-existing
   `bootstrap` path, so Behat will not be able to find any context class and will use
   defaul `Behat\MinkExtension\Context\MinkContext`:

   ``` bash
   bin/behat -p=no_context
   ```

You must choose between those 4 ways right now just for their demonstration. In reality,
Behat supports them simultaneously and you can mix them together.

### Selenium WebDriver

If you want to test `@javascript` part of feature, you'll need to install Selenium.
Selenium gives you ability to run `@javascript` tagged scenarios in real browser.

1. Download latest Selenium2 jar from the [Selenium website](http://seleniumhq.org/download/)
2. Run selenium jar with:

    ``` bash
    java -jar selenium.jar > /dev/null &
    ```

Now if you run:

``` bash
bin/behat
```

you should see an output like this:

``` gherkin
Feature: Search
  In order to see a word definition
  As a website user
  I need to be able to search for a word

  Scenario: Searching for a page that does exist
    Given I am on /wiki/Main_Page
    When I fill in "search" with "Behavior Driven Development"
    And I press "searchButton"
    Then I should see "agile software development"

  Scenario: Searching for a page that does NOT exist
    Given I am on /wiki/Main_Page
    When I fill in "search" with "Glory Driven Development"
    And I press "searchButton"
    Then I should see "Search results"

  @javascript
  Scenario: Searching for a page with autocompletion
    Given I am on /wiki/Main_Page
    When I fill in "search" with "Behavior Driv"
    And I wait for the suggestion box to appear
    Then I should see "Behavior Driven Development"

3 scenarios (3 passed)
12 steps (12 passed)
```
