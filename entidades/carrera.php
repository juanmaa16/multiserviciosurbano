<?php

class Carrera {

    private $id;
    private $nombre;
    private $idUniversidad;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getIdUniversidad() {
        return $this->idUniversidad;
    }

    public function setIdUniversidad($idUniversidad) {
        $this->idUniversidad = $idUniversidad;
    }

}

?>
