<?php
    use dwes\app\entity\Imagen;
    
    $imagenesClientes[]= new Imagen('client1.jpg','MISS BELLA');
    $imagenesClientes[]= new Imagen('client2.jpg','Don Peno'); 
    $imagenesClientes[]= new Imagen('client3.jpg','Sweety');   
    $imagenesClientes[]= new Imagen('client4.jpg','Lady');

    require_once(__DIR__ . '/../views/about.view.php');
