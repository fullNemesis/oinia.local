<?php
require_once __DIR__ . '/inicio.part.php';
?>

<!-- Navigation Bar -->
<?php
require_once __DIR__ . '/navegacion.part.php';
?>
<div class="hero hero-inner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mx-auto text-center">
                <div class="intro-wrap">
                    <h1 class="mb-0">Asociados</h1>
                    <p class="text-white">Forma parte de nuestros Partners. </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Principal Content Start -->
<div id="asociados">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h2>Asociados:</h2>
            <hr>
            <!-- Sección que muestra la confirmación del formulario o bien sus errores -->
             
            <?php include __DIR__ . '/show-error.part.view.php'; ?>

            <!-- Formulario que permite subir una imagen con su descripción -->
            <!-- Hay que indicar OBLIGATORIAMENTE enctype="multipart/form-data" para enviar ficheros al servidor -->
            <form clas="form-horizontal" action="asociados/nuevo" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Logo</label>
                        <input class="form-control-file" type="file" name="logo">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Nombre*</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombre?> " require="">
                        <label class="label-control">Descripción</label>
                        <textarea class="form-control" name="descripcion"><?= $descripcion ?></textarea>
                        <!-- CAPTCAHA -->
                       <!--  <label class="label-control">Introduce el captcha <img style="border: 1px solid #D3D0D0 " src="../../src/utils/captcha.php" id='captcha'></label>
                        <input class="form-control" type="text" name="captcha"> -->
                        <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                    </div>
                </div>
            </form>
            <hr class="divider">
            <div class="imagenes_asociados">
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__ . '/fin.part.php';
?>
<!-- END Footer -->

<!-- Jquery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap core Javascript -->
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<!-- Plugins -->
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="js/scrollreveal.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<!-- meter en fin -->

</body>

</html>