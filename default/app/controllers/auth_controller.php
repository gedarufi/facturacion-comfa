<?php
/**
* Controlador que administra el login
*/
Load::models('usuarios');

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

  public function registrarme() {
    if (Input::hasPost('userName', 'password', 'repassword', 'edad', 'phone-number')) {
      $usuario     = new Usuarios();

      $userName    = Input::post('userName');
      $password    = Input::post('password');
      $repassword  = Input::post('repassword');
      $edad        = Input::post('edad');
      $phoneNumber = Input::post('phone-number');

      $validacion = $usuario->ValidarModelo(
        $userName, 
        $password, 
        $repassword, 
        $edad, 
        $phoneNumber
      );

      if (!isset($validacion)) {
        //Creamos y guardamos el usuario
        $usuario->edad     = $edad;
        $usuario->login    = $userName;
        $usuario->password = $password;
        $usuario->telefono = $phoneNumber;

        if ($usuario->create()) {
          $auth = new Auth("model", "class: Usuarios", "login: $userName", "password: $password");

          Router::redirect("principal/index");
        } else {
          Flash::error('Fallo la inserción');
        }
      } else {
        Flash::error($validacion);
      }
    }
  }

  public function after_filter() {
    View::template("login");
  }
}