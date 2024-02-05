<?php class AdministradorControlador {
    public function listarUsuarios() {
        require_once '../modelos/administradormodelo.php';
        
        $administradorModelo = new AdministradorModelo();
        $listaUsuarios = $administradorModelo->obtenerUsuarios();
        return $listaUsuarios;
    }
}
