<?php

interface DocumentosRepository {

    public function insertDocumento(Documento $oDocumento);

    public function updateDocumento(Documento $oDocumento);

    public function deleteDocumento(Documento $oDocumento);

    public function getDocumentos();

    public function getDocumentoById($idDocumento);

    public function getDocumentosByIdMateria($idMateria);
}

?>
