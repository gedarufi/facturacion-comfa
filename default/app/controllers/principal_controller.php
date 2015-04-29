<?php
/**
* 
*/
class PrincipalController extends AppController
{
  public function before_filter() {
    if (!Auth::is_valid()) {
      Router::redirect("auth/login");
    }

    // if (Auth::get("edad") < 20) {
    //   Router::redirect("..");
    // }

    // if (Auth::get("role") != "ROLE_ADMIN") {
    //   Router::redirect("");
    // }
  }

  public function index() {

  }
}