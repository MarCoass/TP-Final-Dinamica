<?php
$resultado = array();
$objC_Usuario = new C_Usuario();
$resultado = $objC_Usuario->buscar(NULL);
print_r($resultado);
echo json_encode($resultado);