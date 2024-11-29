<?php

use oinia\app\utils\File;
use  oinia\app\utils\Utils;
?>

<div class="header_section <?php if (!Utils::esOpcionMenuActiva('/')) echo 'header_bg'; else echo 'float'; ?>">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo"><a href="/"><img src="../public/images/logo.png"></a></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <?php if (Utils::esOpcionMenuActiva('/') == true || Utils::esOpcionMenuActiva('/') == true)
                            echo '<li class="active lien">';
                        else echo '<li class="0lien">'; ?>
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item"><?php if (Utils::esOpcionMenuActiva('/languges') == true)
                                                echo '<li class="active lien">';
                                            else echo '<li class="0lien">'; ?>
                        <a class="nav-link" href="languges">Languges</a>
                    </li>
                    <li class="nav-item">
                        <?php if (Utils::esOpcionMenuActiva('/services') == true)
                            echo '<li class="active lien">';
                        else echo '<li class="0lien">'; ?>
                        <a class="nav-link" href="services">Services</a>
                    </li>
                    <li class="nav-item">
                        <?php if (Utils::esOpcionMenuActiva('/events') == true)
                            echo '<li class="active lien">';
                        else echo '<li class="0lien">'; ?>
                        <a class="nav-link" href="events">Events</a>
                    </li>
                    <li class="nav-item">
                        <?php if (Utils::esOpcionMenuActiva('/contact') == true)
                            echo '<li class="active lien">';
                        else echo '<li class="0lien">'; ?>
                        <a class="nav-link" href="contact">Contact Us</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <?php if (is_null($app['user'])) : ?>
                        <?php if (Utils::esOpcionMenuActiva('/login') == true) echo '<li class="active lien">';
                        else echo '<li class=" lien">'; ?>
                        <div class="login_text"><a href="login">Login</a>
                            <li class="<?= Utils::esOpcionMenuActiva('/registro') ? 'active' : '' ?> lien">
                                <a href="<?= Utils::esOpcionMenuActiva('/registro') ? '#' : 'registro' ?>">
                                <i class="fa fa-sign-in sr-icons"></i> Registro</a>
                            </li>
                        </div>
                        <div class="search_icon"><a href="#"><img src="../public/images/search-icon.png"></a></div>
                        <?php else : ?>
                        <a href="/logout"><i class="fa fa-sign-out sr-icons"></i> <?= $app['user']->getUsername() ?></a></li>
                    <?php endif; ?>
                </form>
            </div>
        </nav>
    <!-- </div> -->
    <?php if (!Utils::esOpcionMenuActiva('/')) echo '</div>' ?>