<?php
/**
* models/usuarios.php
*/
class Usuarios extends ActiveRecord
{
  public function ValidarModelo(
    $userName, $password, 
    $repassword, $edad, $phoneNumber) {

    $validacion = null;

    if ($edad < 18) {
      $validacion = 'Usuario menor de edad';
    } else if ($password != $repassword) {
      $validacion = 'Las contraseñas no coinciden';
    } else if ($this->find("login = '$userName'") != false) {
      $validacion = "El nombre de usuario $userName ya existe";
    }

    return $validacion;
  }
}