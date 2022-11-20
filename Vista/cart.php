<?php session_start(); 

	if(isset($_SESSION['carrito'])){
		$carrito=$_SESSION['carrito'];
		if(isset($_POST['titulo'])){
			$titulo=$_POST['titulo'];
			$precio=$_POST['precio'];
			$cantidad=$_POST['cantidad'];
			$num=0;
     		$carrito[]=array("titulo"=>$titulo,"precio"=>$precio,"cantidad"=>$cantidad);
 		}
	}else{
		$titulo=$_POST['titulo'];
		$precio=$_POST['precio'];
		$cantidad=$_POST['cantidad'];
		$carrito[]=array("titulo"=>$titulo,"precio"=>$precio,"cantidad"=>$cantidad);	
	}
	

$_SESSION['carrito']=$carrito;

//aqui termina el carrito


header("Location: ".$_SERVER['HTTP_REFERER']."");
?>



