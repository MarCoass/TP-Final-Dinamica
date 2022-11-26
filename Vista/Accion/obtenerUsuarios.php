<?php
//include_once('../Common/Header.php');
$usuarioSalida = array();
$usuarios =  array();
$controladorUsuario = new C_Usuario();
$usuarios = $controladorUsuario->buscar([]);
if (is_array($usuarios) && count($usuarios) > 0) {
    foreach ($usuarios as $usuario) {

        $estadoUsuario = $usuario->getUsdeshabilitado() == '0000-00-00 00:00:00' ? "Habilitado" : "Deshabilitado";

        //busco los roles
        $objUsuarioRol = new C_UsuarioRol();
        //busco los roles el usuario
        $rolesUsuario = $objUsuarioRol->buscar(['idusuario' => $usuario->getIdusuario()]);
        $txtRoles = "";
        foreach($rolesUsuario as $rol){
            $txtRoles = $txtRoles . " ".$rol->getIdrol()->getRodescripcion();
        }
        $dato = array(
            $usuario->getIdusuario(),
            $usuario->getUsnombre(),
            $usuario->getUsmail(),
            $txtRoles,
            $estadoUsuario,
        );
        $usuarioSalida[] = $dato;
    }
    //siempre que necesitemos retornar algo para ajax usamos un echo json_encode, recordar que es muy importante poner exit; luego
    echo json_encode($usuarioSalida);
    exit;
}
echo json_encode(array());
exit;
