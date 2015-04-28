<?php
/**
* Controlador que administra el login
*/
class AuthController extends AppController
{
  public function login() {
    if (Input::hasPost('login', 'password')) {
      $pws = Input::post('password');
      $login = Input::post('login');

      $auth = new Auth("model", "class: Usuarios", "login: $login", "password: $pws");

      if ($auth->authenticate()) {
        Router::redirect("principal/index");
      } else {
        Flash::error("Fallo en la autenticación");
      }
    }
  }
}