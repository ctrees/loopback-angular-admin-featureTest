<?php
require_once __DIR__.'/../../User.php';
use SensioLabs\Behat\PageObjectExtension\PageObject\Element;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page;
/**
 * Features context.
 */
class LoginForm extends Element
{
  /**
   * @var array $selector
   */
  protected $selector = array('css' => '.ng-valid-email');
  /**
   * enterUserDetails 
   * 
   * @param mixed $user 
   * @access public
   * @return void
   */
  public function enterUserDetails($user) {
    $this->fillField("email", $user->email);
    $this->fillField("password", $user->password);
  }
  /**
   * staySignedIn 
   * 
   * @access public
   * @return void
   */
  public function staySignedIn() {
    $this->checkField("Stay signed in");
  }
  /**
   * submitForm 
   * 
   * @access public
   * @return void
   */
  public function submitForm() {
    $this->pressButton("Sign in");
  }
}