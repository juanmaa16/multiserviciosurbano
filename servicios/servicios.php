<?php

@include_once 'init.php';
include_once ROOT_DIR . '/datos/usuarios.php';
include_once ROOT_DIR . '/datos/universidades.php';
include_once ROOT_DIR . '/datos/carreras.php';

class Servicios {

    private $usuariosRepository;
    private $universidadesRepository;
    private $carrerasRepository;

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

}

?>