<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oinia - Cursos</title>
    <base href="/">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="public/css/owl.carousel.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/css/style.css">
    <style>
        .navbar {
            background-color: #4B0082 !important;
            padding: 0.5rem 1rem;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            color: white !important;
        }
        .navbar-brand img {
            height: 50px;
            margin-right: 10px;
        }
        .nav-link {
            color: white !important;
            padding: 1rem 1.5rem !important;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff !important;
        }
        .user-info {
            color: white;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
        }
        .navbar-nav {
            align-items: center;
        }
        .auth-buttons {
            display: flex;
            align-items: center;
        }
        .auth-buttons .nav-link {
            margin: 0 5px;
        }
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #4B0082;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php require_once dirname(__DIR__) . '/partials/header.view.php'; ?>
    
    <?= $content ?>
    
    <?php require_once dirname(__DIR__) . '/partials/footer.view.php'; ?>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 