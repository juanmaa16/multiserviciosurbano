<?php

interface UniversidadesRepository {
    
     public function insertUniversidad(Universidad $oUniversidad);
     public function getUniversidades();
     public function getUniversidadById($idUniversidad);
}

?>
