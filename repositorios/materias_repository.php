<?php

interface MateriasRepository {
    
     public function insertMateria(Materia $oMateria);
     public function updateMateria(Materia $oMateria);
     public function deleteMateria(Materia $oMateria);
     public function getMaterias();
     public function getMateriaById($idMateria);
}

?>
