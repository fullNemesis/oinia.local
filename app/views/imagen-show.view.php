<!-- Principal Content Start -->
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>IMAGEN GALERIA</h1>
            <hr>
            <div class="imagenes_galeria">
                <img src="<?= $imagen->getUrlImagenesSubidas() ?>" alt="<?= $imagen->getDescripcion() ?>" title="<?= $imagen->getDescripcion() ?>" width="500px">
                <br>Descripción: <?= $imagen->getDescripcion() ?>
                <br>Categoria:<?= $imagenesRepository->getCategoria($imagen)->getNombre() ?>
                <br>Número de visualizaciones: <?= $imagen->getNumVisualizaciones() ?>
                <br>Número de likes: <?= $imagen->getNumLikes() ?>
                <br>Número de downloads: <?= $imagen->getNumDownloads() ?>
            </div>
        </div>
    </div>
</div>