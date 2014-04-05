<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/universidades_repository.php';
@include_once ROOT_DIR . '/entidades/universidades.php';

class DataUniversidades extends Data implements UniversidadesRepository {

    function __construct() {
        parent::__construct();
    }

    public function insertUniversidad(Universidad $oUniversidad) {
        $non_query = "INSERT INTO universidades (nombre_universidad) VALUES (?)";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('s', $oUniversidad->getNombre());
        $stmt->execute();
        $stmt->close();
    }

    public function updateUniversidad(Universidad $oUniversidad) {
        $non_query = "UPDATE universidades SET nombre_universidad=? WHERE id_universidad=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('si', $oUniversidad->getNombre(), $oUniversidad->getId());
        $stmt->execute();
        $stmt->close();
    }
    
    public function deleteUniversidad(Universidad $oUniversidad) {
        $non_query = "DELETE FROM universidades WHERE id_universidad=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('i', $oUniversidad->getId());
        $stmt->execute();
        $stmt->close();
    }

    public function getUniversidadById($idUniversidad) {
        $query = "SELECT * FROM universidades WHERE id_universidad=?";
        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('i', $idUniversidad);
        $stmt->execute();
        $result = $stmt->get_result();

        $oUniversidad = null;
        while ($row = $result->fetch_assoc()) {
            $oUniversidad = $this->generaUniversidad($row);
        };
        $stmt->close();
        return $oUniversidad;
    }

    public function getUniversidades() {
        $query = "SELECT * FROM universidades ORDER BY id_universidad DESC";
        $stmt = $this->prepareStmt($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $vUniversidades = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $oUniversidad = $this->generaUniversidad($row);
            $vUniversidades[$index] = $oUniversidad;
            $index++;
        };
        $stmt->close();
        return $vUniversidades;
    }

    private function generaUniversidad($row) {
        $oUniversidad = new Universidad();
        $oUniversidad->setId($row['id_universidad']);
        $oUniversidad->setNombre($row['nombre_universidad']);
        return $oUniversidad;
    }

}

?>
