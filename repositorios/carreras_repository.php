<?php

interface CarrerasRepository {
    
     public function insertCarrera(Carrera $oCarrera);
     public function updateCarrera(Carrera $oCarrera);
     public function deleteCarrera(Carrera $oCarrera);
     public function getCarreras();
     public function getCarreraById($idCarrera);
     public function getCarrerasByIdUniversidad($idUniversidad);
}

?>
