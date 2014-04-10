<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/documentos_repository.php';
@include_once ROOT_DIR . '/entidades/documentos.php';

class DataDocumentos extends Data implements DocumentosRepository {

    function __construct() {
        parent::__construct();
    }

    public function insertDocumento(Documento $oDocumento) {
        $non_query = "INSERT INTO documentos (id_documento,documento_path,documento_nombre,documento_nombre_archivo,
            documento_fecha,documento_nro_paginas,id_materia) VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('sssssii', $oDocumento->getId(), $oDocumento->getPath(), $oDocumento->getNombre(), $oDocumento->getNombreArchivo(), $oDocumento->getFecha(), $oDocumento->getPaginas(), $oDocumento->getIdMateria());
        $stmt->execute();
        $stmt->close();
    }

    public function updateDocumento(Documento $oDocumento) {
        $non_query = "UPDATE documentos SET documento_path=?,documento_nombre=?,documento_nombre_archivo=?,
            documento_fecha=?,documento_nro_paginas=?,id_materia=? WHERE id_documento=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('ssssiis', $oDocumento->getPath(), $oDocumento->getNombre(), $oDocumento->getNombreArchivo(), $oDocumento->getFecha(), $oDocumento->getPaginas(), $oDocumento->getIdMateria(), $oDocumento->getId());
        $stmt->execute();
        $stmt->close();
    }

    public function deleteDocumento(Documento $oDocumento) {
        $non_query = "DELETE FROM documentos WHERE id_documento=?";
        $stmt = $this->prepareStmt($non_query);
        $stmt->bind_param('s', $oDocumento->getId());
        $stmt->execute();
        $stmt->close();
    }

    public function getDocumentoById($idDocumento) {
        $query = "SELECT * FROM documentos WHERE id_documento=?";
        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('s', $idDocumento);
        $stmt->execute();
        $result = $stmt->get_result();

        $oDocumento = null;
        while ($row = $result->fetch_assoc()) {
            $oDocumento = $this->generaDocumento($row);
        };
        $stmt->close();
        return $oDocumento;
    }

    public function getDocumentos() {
        $query = "SELECT * FROM documentos ORDER BY documento_fecha DESC";
        $stmt = $this->prepareStmt($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $vDocumentos = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $oDocumento = $this->generaDocumento($row);
            $vDocumentos[$index] = $oDocumento;
            $index++;
        };
        $stmt->close();
        return $vDocumentos;
    }

    public function getDocumentosByIdMateria($idMateria) {
        $query = "SELECT * FROM documentos WHERE id_materia=? ORDER BY id_documento DESC";
        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('i', $idMateria);
        $stmt->execute();
        $result = $stmt->get_result();

        $vDocumentos = array();
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            $oDocumento = $this->generaDocumento($row);
            $vDocumentos[$index] = $oDocumento;
            $index++;
        };
        $stmt->close();
        return $vDocumentos;
    }

    private function generaDocumento($row) {
        $oDocumento = new Documento();
        $oDocumento->setId($row['id_documento']);
        $oDocumento->setPath($row['documento_path']);
        $oDocumento->setNombre($row['documento_nombre']);
        $oDocumento->setNombreArchivo($row['documento_nombre_archivo']);
        $oDocumento->setFecha($row['documento_fecha']);
        $oDocumento->setPaginas($row['documento_nro_paginas']);
        $oDocumento->setIdMateria($row['id_materia']);
        return $oDocumento;
    }

}

?>
