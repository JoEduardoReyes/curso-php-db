<?php

namespace Router;

class RouterHandler {

  protected $method;
  protected $data;

  public function set_method($method) {
    $this->method = $method;
  }

  public function set_data($data) {
    $this->data = $data;
  }

  public function route($controller, $id) {

    $resource = new $controller();

    switch($this->method) {

      case "get":
        if ($id == "create") {
          $resource->create();
        } elseif ($id) {
          $resource->show($id);
        } else {
          $resource->index();
        }
        break;

      case "post":
        $resource->store($this->data);
        break;

      case "delete":
        if ($id) {
          $resource->destroy($id);
        } else {
          echo "Error: No se proporcionó un ID para eliminar.";
        }
        break;

      default:
        echo "Método no soportado.";
        break;
    }

  }

}
?>
