<?php

interface UniversidadesRepository {
    
     public function insertUniversidad(Universidad $oUniversidad);
     public function updateUniversidad(Universidad $oUniversidad);
     public function deleteUniversidad(Universidad $oUniversidad);
     public function getUniversidades();
     public function getUniversidadById($idUniversidad);
}

?>
