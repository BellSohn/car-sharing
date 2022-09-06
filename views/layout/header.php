<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <!--Jquery-->
        <script type="text/javascript" src="<?= base_url ?>assets/js/jquery-3.6.0.min.js"></script>        
        <!--my Jquery-->
        <script type="text/javascript" src="<?= base_url ?>assets/js/main.js"></script>
        <!--Bootstrap-->
        <link rel="stylesheet" href="<?=base_url ?>assets/bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css" />
        <script src="<?= base_url ?>assets/bootstrap/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
        
        <!--own styles css-->
        <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css" />
    </head>
    <body>
        <div id="container">
            <div class="title">
                <h1>WELCOME TO CAR SHARING</h1>
            </div>
            <header id="header">
                <ul class="ul-menu">
                    <li><a href="<?= base_url ?>">HOME</a></li>
                    <li><a href="<?= base_url ?>user/register">BE ONE OF US</a></li>
                    <?php if(!isset($_SESSION['identity'])):?>
                    <li><a href="#" class="to-login" data-toggle="modal" data-target="exampleModalCenter">ACCESS</a></li>
                    <?php endif; ?>
                    <li><a href="<?= base_url ?>offer/index">OFFER</a></li>
                   <li><a href="<?=base_url?>seek/index">SEARCH</a></li>
                    <?php if(isset($_SESSION['identity'])): ?>
                    <li>
                        
                        <a class="btn btn-primary" 
                                 id="personal-menu"><?= $_SESSION['identity']->name ?>
                        </a>
                        <div class="menu-options">
                            <ul>
                                <li><a href="<?=base_url ?>user/content">set preferences</a></li>
                                <li><a href="<?= base_url ?>itinerate/index">my preferences </a></li>
                                <li><a href="<?= base_url ?>user/profil">manage account</a></li>
                                <li><a href="<?= base_url ?>user/passwordUpdate">password and security</a></li>
                                <li><a href="<?= base_url ?>message/index">my messages</a></li>
                                <li><a href="<?= base_url ?>user/logout">logout</a></li>
                            </ul>
                        </div>
                                             
                        
                    </li>
                    
                    <?php endif ?>
                </ul>
            </header>    


    