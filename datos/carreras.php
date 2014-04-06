<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/carreras_repository.php';
@include_once ROOT_DIR . '/entidades/carreras.php';

class DataCarreras extends Data implements CarrerasRepository {

    function __construct() {
        parent::__construct();
    }

    public function insertCarrera(Carrera $oCarrera) {
        $non_query = "INSERT INTO carreras (nombre_carrera,id_universidad) VALUES (?,?)";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('si', $oCarrera->getNombre(), $oCarrera->getIdUniversidad());
        $stmt->execute();
        $stmt->close();
    }

    public function updateCarrera(Carrera $oCarrera) {
        $non_query = "UPDATE carreras SET nombre_carrera=?,id_universidad=? WHERE id_carrera=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('sii', $oCarrera->getNombre(), $oCarrera->getIdUniversidad(), $oCarrera->getId());
        $stmt->execute();
        $stmt->close();
    }

    public function deleteCarrera(Carrera $oCarrera) {
        $non_query = "DELETE FROM carreras WHERE id_carrera=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('i', $oCarrera->getId());
        $stmt->execute();
        $stmt->close();
    }

    public function getCarreraById($idCarrera) {
        $query = "SELECT * FROM carreras WHERE id_carrera=?";
        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('i', $idCarrera);
        $stmt->execute();
        $result = $stmt->get_result();

        $oCarrera = null;
        while ($row = $result->fetch_assoc()) {
            $oCarrera = $this->generaCarrera($row);
        };
        $stmt->close();
        return $oCarrera;
    }

    public function getCarrerasByIdUniversidad($idUniversidad) {
        $query = "SELECT * FROM carreras WHERE id_universidad=? ORDER BY id_carrera DESC";
        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('i', $idUniversidad);
        $stmt->execute();
        $result = $stmt->get_result();

        $vCarreras = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $oCarrera = $this->generaCarrera($row);
            $vCarreras[$index] = $oCarrera;
            $index++;
        };
        $stmt->close();
        return $vCarreras;
    }

    public function getCarreras() {
        $query = "SELECT * FROM carreras ORDER BY id_carrera DESC";
        $stmt = $this->prepareStmt($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $vCarreras = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $oCarrera = $this->generaCarrera($row);
            $vCarreras[$index] = $oCarrera;
            $index++;
        };
        $stmt->close();
        return $vCarreras;
    }

    private function generaCarrera($row) {
        $oCarrera = new Carrera();
        $oCarrera->setId($row['id_carrera']);
        $oCarrera->setNombre($row['nombre_carrera']);
        $oCarrera->setIdUniversidad($row['id_universidad']);
        return $oCarrera;
    }

}

?>
