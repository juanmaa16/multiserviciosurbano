<?php

@include_once 'data.php';
@include_once '../init.php';
@include_once ROOT_DIR . '/repositorios/usuarios_repository.php';
@include_once ROOT_DIR . '/entidades/usuarios.php';

class DataUsuarios extends Data implements UsuariosRepository {

    function __construct() {
        parent::__construct();
    }

    public function getUsuario($user) {
        $query = "SELECT * FROM usuarios WHERE nombre_usuario=?";
        $stmt = $this->prepareStmt($query);
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();

        $oUsuario = null;
        while ($row = $result->fetch_assoc()) {
            $oUsuario = $this->generaUsuario($row);
        };
        $stmt->close();
        return $oUsuario;
    }

    public function cambioPassword($user, $newPassword) {
        $query = "update usuarios set usuario_pass= ? where usuario_user = ?";

        $stmt = $this->prepareStmt($query);

        $stmt->bind_param('ss', $newPassword, $user);

        $stmt->execute();
    }

    private function generaUsuario($row) {
        $oUsuario = new User();
        $oUsuario->setId($row['id_usuario']);
        $oUsuario->setUser($row['nombre_usuario']);
        $oUsuario->setPass($row['password_usuario']);
        return $oUsuario;
    }

}

?>
