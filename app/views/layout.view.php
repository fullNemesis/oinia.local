<?php
// Asegurarnos de que este archivo solo se incluya una vez
if (!defined('LAYOUT_LOADED')):
    define('LAYOUT_LOADED', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oinia - Academia de Idiomas</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="/public/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="/public/css/responsive.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/public/css/font-awesome.min.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="/public/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
</head>
<body class="main-layout">
    <!-- loader -->
    <div class="loader_bg">
        <div class="loader"><img src="/public/images/loading.gif" alt="#"/></div>
    </div>
    <!-- end loader -->

    <!-- Navegación -->
    <?php require __DIR__ . '/navegacion.part.php'; ?>

    <!-- Contenido principal -->
    <?php echo $mainContent; ?>

    <!-- Footer -->
    <?php require __DIR__ . '/footer.part.php'; ?>

    <!-- Javascript files-->
    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/jquery-3.0.0.min.js"></script>
    <!-- sidebar -->
    <script src="/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/public/js/custom.js"></script>
    <script>
        // Ocultar el loader cuando la página esté cargada
        $(window).on('load', function() {
            $(".loader_bg").fadeOut();
        });
    </script>
</body>
</html>
<?php endif; ?>
