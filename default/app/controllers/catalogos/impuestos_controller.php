<?php
/**
* controllers/catalogos/impuestos_controller.php
*/
Load::models('impuestos');

class ImpuestosController extends AppController
{
  public function index() {
    $impuestos = new Impuestos();

    $this->impuestos = $impuestos->find();
  }

  public function nuevo() {
    if (Input::hasPost('impuestos')) {
      $impuestos = new Impuestos(Input::post('impuestos'));

      if ($impuestos->create()) {
        Flash::valid('Inserción Exitosa');
        Input::delete();
      } else {
        Flash::error('Fallo la inserción');
      }
    }
    View::select('editar');
  }

  public function editar($id) {
    $impuestos = new Impuestos();

    if (Input::hasPost('impuestos')) {
      if ($impuestos->update(Input::post('impuestos'))) {
        Flash::valid('Guardado exitoso');
        Input::delete();
        $this->impuestos = $impuestos->find();
      } else {
        Flash::error('Error al grabar');
      }
    } else {
      $this->impuestos = $impuestos->find_by_id((int)$id);
    }
  }

  public function eliminar($id) {
    $impuestos = new Impuestos();

    if (Input::hasPost('impuestos')) {
      if ($impuestos->delete((int)$id)) {
        Flash::valid('Borrado exitoso');
        Input::delete();
        $this->impuestos = $impuestos->find();
      } else {
        Flash::error('Error al borrar');
      }
    } else {
      $this->impuestos = $impuestos->find_by_id((int)$id);
    }
  }

  public function after_filter() {
    if (Input::isAjax()) {
      View::template(null);
    }
  }
}
