<?php

class Documento {

    private $id;
    private $path;
    private $nombre;
    private $fecha;
    private $paginas;
    private $idMateria;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getPaginas() {
        return $this->paginas;
    }

    public function setPaginas($paginas) {
        $this->paginas = $paginas;
    }

    public function getIdMateria() {
        return $this->idMateria;
    }

    public function setIdMateria($idMateria) {
        $this->idMateria = $idMateria;
    }

}

?>
