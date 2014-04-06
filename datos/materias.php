<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/materias_repository.php';
@include_once ROOT_DIR . '/entidades/materias.php';

class DataMaterias extends Data implements MateriasRepository {

    function __construct() {
        parent::__construct();
    }

    public function insertMateria(Materia $oMateria) {
        $non_query = "INSERT INTO materias (nombre_materia,id_carrera) VALUES (?,?)";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('si', $oMateria->getNombre(), $oMateria->getIdCarrera());
        $stmt->execute();
        $stmt->close();
    }

    public function updateMateria(Materia $oMateria) {
        $non_query = "UPDATE materias SET nombre_materia=?,id_carrera=? WHERE id_materia=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('sii', $oMateria->getNombre(), $oMateria->getIdCarrera(), $oMateria->getId());
        $stmt->execute();
        $stmt->close();
    }

    public function deleteMateria(Materia $oMateria) {
        $non_query = "DELETE FROM materias WHERE id_materia=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('i', $oMateria->getId());
        $stmt->execute();
        $stmt->close();
    }

    public function getMateriaById($idMateria) {
        $query = "SELECT * FROM materias WHERE id_materia=?";
        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('i', $idMateria);
        $stmt->execute();
        $result = $stmt->get_result();

        $oMateria = null;
        while ($row = $result->fetch_assoc()) {
            $oMateria = $this->generaMateria($row);
        };
        $stmt->close();
        return $oMateria;
    }

    public function getMaterias() {
        $query = "SELECT * FROM materias ORDER BY id_materia DESC";
        $stmt = $this->prepareStmt($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $vMaterias = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $oMateria = $this->generaMateria($row);
            $vMaterias[$index] = $oMateria;
            $index++;
        };
        $stmt->close();
        return $vMaterias;
    }

    public function getMateriasByIdCarrera($idCarrera) {
        $query = "SELECT * FROM materias WHERE id_carrera=? ORDER BY id_materia DESC";
        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('i', $idCarrera);
        $stmt->execute();
        $result = $stmt->get_result();

        $vMaterias = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $oMateria = $this->generaMateria($row);
            $vMaterias[$index] = $oMateria;
            $index++;
        };
        $stmt->close();
        return $vMaterias;
    }

    private function generaMateria($row) {
        $oMateria = new Materia();
        $oMateria->setId($row['id_materia']);
        $oMateria->setNombre($row['nombre_materia']);
        $oMateria->setIdCarrera($row['id_carrera']);
        return $oMateria;
    }

}

?>
