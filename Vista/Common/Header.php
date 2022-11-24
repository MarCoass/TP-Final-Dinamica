<?php
include_once("/xampp/htdocs/TP-FInal-Dinamica/configuracion.php");
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Besto 3d homepage</title>
    <link href="https://www.flaticon.es/iconos-gratis/menu" title="menú iconos">


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/TP-Final-Dinamica/Vista/Assets/css/Estilos.css">
    <link rel="icon" href="/TPInvestigacion/Vista/Assets/Img/logoBesto.svg" id="logoPagina">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/core.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

</head>

<body background="../Assets/Img/fondo.png">
    <?php
    if (isset($_SESSION['carrito'])) {
        $carrito = $_SESSION['carrito'];
        $_SESSION['carrito'] = $carrito;

        // contamos nuestro carrito

        for ($i = 0; $i <= count($carrito) - 1; $i++) {
            if ($carrito[$i] != NULL) {
                $total_cantidad = $carrito['cantidad'];
                $total_cantidad++;
                $totalcantidad += $total_cantidad;
            }
        }
    } else {
        $totalcantidad = 0;
    }
    ?>
    <header id="navbar ">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid" id="cabecera">
                <a class="navbar-brand text-light fs-5" href="/TP-Final-Dinamica/Vista/Home.php">
                    <img src="/TP-Final-Dinamica/Vista/Assets/Img/logo simple.png" width="70px" class="mb-1"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_cart" style="color: black;"><i class="fas fa-shopping-cart"></i> <?php echo $totalcantidad; ?></a>
                        </li>
                        
                    </ul>
                </div>

                <?php include_once('Menu.php') ?>
                


            </div>
        </nav>

    </header>
    
    <!-- MODAL CARRITO -->