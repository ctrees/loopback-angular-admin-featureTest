<?php
  
require_once 'WebsitePage.php';

class LoginPage extends WebsitePage {
  /**
   * @var string $path
   */
  protected $path = 'https://ctreesadmin.herokuapp.com/#/login';
  
  public function enterUserDetailsOnLoginForm(User $user) {
    return $this->getElement('Login Form')->enterUserDetails($user);
  }
  
  public function submitSignupForm() {
    return $this->getElement('Login Form')->submitForm();
  }
  
}