<?php include_once('Common/Header.php');

//le robe esto a seba aber si entiendo que se supone que tengo que hacer
$objSession = new Session();
$menues = [];
if ($objSession->activa()) {
  $idRoles = $_SESSION['roles'];
  $objMenuRol = new C_MenuRol();
  $menues = $objMenuRol->menuesByIdRol($idRoles);
}

?>

<div class="container">

</div>


<?php include_once('Common/Footer.php') ?>

