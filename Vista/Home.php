<?php 
include_once("Common/Header.php");
?>


<div class="container mx-auto" style="margin:30px;height:80vh;">
    <div class="container bg-dark pb-3"> 
            <div class="display-1 text-light  text-center" id="titulo"><h1>¡Bienvenidxs al cat&aacute;logo Besto3D!</h1></div>
            <div class="container" id="contIndex" >
                <div id="carouselExampleIndicators" class="carousel slide start-50 translate-middle-x" data-bs-ride="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="Assets/Img/Index/tarjetaBesto.jpg" id="imagenCarousel" class="d-block w-100" alt="Logo de Besto3D">
                        </div>
                        <div class="carousel-item ">
                        <img src="Assets/Img/Index/bestoMeme.jpg" id="imagenCarousel" class="d-block w-100" alt="Meme Equipo Alfa Buena Onda :)">
                        </div>
                        <div class="carousel-item">
                        <img src="Assets/Img/Index/fotoStand.jpg" id="imagenCarousel" class="d-block w-100" alt="Imagen del stand">
                        </div>
                        <div class="carousel-item">
                        <img src="Assets/Img/Index/fotoNakama.jpg" id="imagenCarousel" class="d-block w-100" alt="Foto cosplay de Besto Anto y Besto Marti">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
    </div>
</div>


<?php include_once('Common/Footer.php') ?>

