<?php
use dwes\app\utils\File;
use  dwes\app\utils\Utils;
?>


<nav class="navbar navbar-fixed-top navbar-default">
     <div class="container">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a  class="navbar-brand page-scroll" href="#page-top">
              <span>[PHOTO]</span>
            </a>
         </div>
         <div class="collapse navbar-collapse navbar-right" id="menu">
            <ul class="nav navbar-nav">
              <li>
              <?php if (Utils::esOpcionMenuActiva('/')==true || Utils::esOpcionMenuActiva('/')==true)
                      echo '<li class="active lien">'; else echo '<li class="0lien">';?>
                <a href="/"><i class="fa fa-home sr-icons"></i> Home</a>
              </li>
              <li>
			  <?php if (Utils::esOpcionMenuActiva('/about')==true)
                    echo '<li class="active lien">'; else echo '<li class="0lien">';?>
				<a href="about"><i class="fa fa-bookmark sr-icons"></i> About</a>
			  </li>
              <li>
			  <?php if (Utils::esOpcionMenuActiva('/blog')==true)
                      echo '<li class="active lien">'; else echo '<li class="0lien">';?>
				<a href="blog"><i class="fa fa-file-text sr-icons"></i> Blog</a>
			  </li>
              <li>
			  <?php if (Utils::esOpcionMenuActiva('/contact')==true)
                      echo '<li class="active lien">'; else echo '<li class="0lien">';?>
				<a href="contact"><i class="fa fa-phone-square sr-icons"></i> Contact</a>
        <?php if (is_null($app['user'])) : ?>
  
        <?php if (Utils::esOpcionMenuActiva('/login') == true) echo '<li class="active lien">';
          else echo '<li class=" lien">'; ?>
        <a href="/login"><i class="fa fa-user-secret sr-icons"></i> Login</a></li>
        <li class="<?= Utils::esOpcionMenuActiva('/registro') ? 'active' : '' ?> lien">
          <a href="<?= Utils::esOpcionMenuActiva('/registro') ? '#' : '/registro' ?>">
          <i class="fa fa-sign-in sr-icons"></i> Registro</a></li>
        <?php else : ?>
        <?php if (Utils::esOpcionMenuActiva('/galeria')==true)
                      echo '<li class="active lien">'; else echo '<li class="0lien">';?>
				<a href="galeria"><i class="fa fa-bookmark sr-icons"></i> Galeria</a>
        <?php if (Utils::esOpcionMenuActiva('/asociados')==true)
                      echo '<li class="active lien">'; else echo '<li class="0lien">';?>
				<a href="asociados"><i class="fa fa-bookmark sr-icons"></i> Asociados</a>
        <?php if (Utils::esOpcionMenuActiva('/logout') == true) echo '<li class="active lien">';
          else echo '<li class=" lien">'; ?>
        <a href="/logout"><i class="fa fa-sign-out sr-icons"></i> <?= $app['user']->getUsername() ?></a></li>
        <?php endif; ?>
			  </li>
            </ul>
        </div>
     </div>
   </nav>