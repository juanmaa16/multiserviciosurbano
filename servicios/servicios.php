<?php

@include_once 'init.php';
include_once ROOT_DIR . '/datos/usuarios.php';
include_once ROOT_DIR . '/datos/universidades.php';

class Servicios {

    private $usuariosRepository;
    private $universidadesRepository;

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

    public function getUniversidadById($idUniversidad) {
        $this->universidadesRepository = new DataUniversidades();
        return $this->universidadesRepository->getUniversidadById($idUniversidad);
    }

    public function getUniversidades() {
        $this->universidadesRepository = new DataUniversidades();
        return $this->universidadesRepository->getUniversidades();
    }

}

?>