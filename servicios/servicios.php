<?php

@include_once 'init.php';
include_once ROOT_DIR . '/datos/usuarios.php';
include_once ROOT_DIR . '/datos/universidades.php';
include_once ROOT_DIR . '/datos/carreras.php';
include_once ROOT_DIR . '/datos/materias.php';

class Servicios {

    private $usuariosRepository;
    private $universidadesRepository;
    private $carrerasRepository;
    private $materiasRepository;

    public function __construct() {
        
    }

    public function getUsuarios($user) {
        $this->usuariosRepository = new DataUsuarios();
        return $this->usuariosRepository->getUsuario($user);
    }

    public function cambioPassword($user, $newPassword) {
        $this->usuariosRepository = new DataUsuarios();
        return $this->usuariosRepository->cambioPassword($user, $newPassword);
    }

    public function insertUniversidad($oUniversidad) {
        $this->universidadesRepository = new DataUniversidades();
        $this->universidadesRepository->insertUniversidad($oUniversidad);
    }

    public function updateUniversidad($oUniversidad) {
        $this->universidadesRepository = new DataUniversidades();
        $this->universidadesRepository->updateUniversidad($oUniversidad);
    }

    public function deleteUniversidad($oUniversidad) {
        $this->universidadesRepository = new DataUniversidades();
        $this->universidadesRepository->deleteUniversidad($oUniversidad);
    }

    public function getUniversidadById($idUniversidad) {
        $this->universidadesRepository = new DataUniversidades();
        return $this->universidadesRepository->getUniversidadById($idUniversidad);
    }

    public function getUniversidades() {
        $this->carrerasRepository = new DataUniversidades();
        return $this->carrerasRepository->getUniversidades();
    }

    public function insertCarrera($oCarrera) {
        $this->carrerasRepository = new DataCarreras();
        $this->carrerasRepository->insertCarrera($oCarrera);
    }

    public function updateCarrera($oCarrera) {
        $this->carrerasRepository = new DataCarreras();
        $this->carrerasRepository->updateCarrera($oCarrera);
    }

    public function deleteCarrera($oCarrera) {
        $this->carrerasRepository = new DataCarreras();
        $this->carrerasRepository->deleteCarrera($oCarrera);
    }

    public function getCarreraById($idCarrera) {
        $this->carrerasRepository = new DataCarreras();
        return $this->carrerasRepository->getCarreraById($idCarrera);
    }

    public function getCarreras() {
        $this->carrerasRepository = new DataCarreras();
        return $this->carrerasRepository->getCarreras();
    }

    public function getCarrerasByIdUniversidad($idUniversidad) {
        $this->carrerasRepository = new DataCarreras();
        return $this->carrerasRepository->getCarrerasByIdUniversidad($idUniversidad);
    }

    public function insertMateria($oMateria) {
        $this->materiasRepository = new DataMaterias();
        $this->materiasRepository->insertMateria($oMateria);
    }

    public function updateMateria($oMateria) {
        $this->materiasRepository = new DataMaterias();
        $this->materiasRepository->updateMateria($oMateria);
    }

    public function deleteMateria($oMateria) {
        $this->materiasRepository = new DataMaterias();
        $this->materiasRepository->deleteMateria($oMateria);
    }

    public function getMateriaById($idMateria) {
        $this->materiasRepository = new DataMaterias();
        return $this->materiasRepository->getMateriaById($idMateria);
    }

    public function getMaterias() {
        $this->materiasRepository = new DataMaterias();
        return $this->materiasRepository->getMaterias();
    }

}

?>