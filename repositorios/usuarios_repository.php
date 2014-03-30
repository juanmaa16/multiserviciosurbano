<?php

interface UsuariosRepository {
    
     public function getUsuario($user);
     public function cambioPassword($user,$newPassword);
}

?>
