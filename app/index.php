<?php
        include '../login/functions.php';
        include '../login/db_connect.php';
        include '../notification/notificationsFunctions.php'; 
        include 'php/functions.php';
        // link calendar to all buttons
        sec_session_start();

        if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {         
            convertEventIntoNotification();
        } else {
            header('Location: ../login/login.php');
        }
    ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>
        <title>Studenti Online</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        <link type="text/css" rel="stylesheet" href="css/animate.css">
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="../calendar/calendar.css" />

        <link rel="icon" href="image/logo_unibo.png">
        <script type="text/javascript" src="lib/jQuery/jquery.min.js"></script>
        <script type="text/javascript" src="lib/Bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script type="text/javascript" src="js/main.js"></script>
        <!-- Include jQuery ScrollTo -->
        <script src="../calendar/jquery-scrollto/lib/jquery-scrollto.js"></script>

        <body>
            <header id="navbar-container">
                <nav class="navbar navbar-inverse navbar-fixed-top">
                    <div class="container-fluid">
                        <!-- Parte che non viene raggruppata -->
                        <div class="nav navbar-header">
                            <!--Hamburger-->
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-form" aria-expanded="false">
                                <span class="sr-only">Navigazione</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="nav navbar-text pull-left" id="toggle-button" data-toggle="tooltip" title="Tutte le opzioni">
                                <a href="#" id="menu-toggle">
                                    <i class="fa fa-cogs" id="sidebar-btn" aria-hidden="true"></i>
                                </a>
                            </div>
                            <!--Titolo-->
                            <div class="navbar-brand home-link">
                                <img id="sol-logo" class="pull-left" src="image/logo_unibo.png" alt="">
                                <p id="sol-label" class="pull-right">Studenti Online</p>
                            </div>
                            <p class="navbar-text" id="school-information">
                                <?php echo getNomeScuola(); ?>
                            </p>
                            <!--Dropdown notifiche-->
                            <ul class="nav navbar-nav pull-left" id="navbar-notification">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown">
                                        <span id="notification-label" class="glyphicon glyphicon-bell"></span>

                                        <span id="notification-number" class="badge badge-notify">
                                            <!-- Numero notifiche -->
                                            <?php echo getNumNotifications(); ?>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu " role="menu" aria-labelledby="notification-label">
                                        <li>
                                            <p class="dropdown-header">Notifiche</p>
                                        </li>
                                        <li>
                                            <div id="notification-container" class="scrollable-menu">

                                            </div>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" id="see-all-button" data-toggle="modal" data-target="#myModal">Vedi tutte</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <!-- Menu con il logout -->
                        <div class="collapse navbar-collapse" id="collapse-form">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <img src="image/profile_pics/<?php echo getProfilePic(); ?>" class="img-circle image-profile pull-left" alt="Immagine di profilo">
                                    <a href="#" class="dropdown-toggle pull-left" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <?php echo getNomeUtente();?> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><span class="fa fa-question-circle"></span>Aiuto</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Impostazioni</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- navbar-collapse -->
                    </div>
                    <!-- container-fluid -->
                </nav>
            </header>
            <main id="wrapper">
                <!-- Sidebar -->
                <section id="sidebar-wrapper">
                    <nav>
                        <ul class="nav sidebar-nav">
                            <li><a class="home-link" href="#">Home<span class="glyphicon glyphicon-home pull-right"></span></a></li>

                            <li><a href="#" id="subscribing-menu" data-toggle="collapse" data-target="#submenu1">
                                Iscrizioni<span class="glyphicon glyphicon-plus pull-right"></span></a>
                                <ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="subscribing-menu">
                                    <li class="sidebar-submenu"><a href="#">Iscrizione prove</a></li>
                                    <li class="sidebar-submenu"><a href="#">Immatricolazioni</a></li>
                                    <li class="sidebar-submenu"><a href="#">Certificati e autocertificazioni</a></li>
                                    <li class="sidebar-submenu"><a href="#">Piano di studi</a></li>
                                </ul>
                            </li>
                            <li><a href="#" id="manage-menu" data-toggle="collapse" data-target="#submenu2">
                               Gestione<span class="glyphicon glyphicon-plus pull-right"></span></a>
                                <ul class="nav collapse" id="submenu2" role="menu" aria-labelledby="manage-menu">
                                    <li class="sidebar-submenu"><a href="#">Prenota esame</a></li>
                                    <li class="sidebar-submenu"><a href="#">Consulta Libretto</a></li>
                                    <li class="sidebar-submenu"><a href="#">Presenta domanda di laurea</a></li>
                                </ul>
                            </li>
                            <li><a href="#" id="service-menu" data-toggle="collapse" data-target="#submenu3">
                                Servizi<span class="glyphicon glyphicon-plus pull-right"></span></a>
                                <ul class="nav collapse" id="submenu3" role="menu" aria-labelledby="service-menu">
                                    <li class="sidebar-submenu calendar-service"><a href="#">Calendario</a></li>
                                    <li class="sidebar-submenu"><a href="#">Bandi</a></li>
                                    <li class="sidebar-submenu"><a href="#">Tirocini</a></li>
                                    <li class="sidebar-submenu service-link"><a href="#">Servizio studio</a></li>
                                </ul>
                            </li>
                            <li><a href="#" id="unsubscribing-menu" data-toggle="collapse" data-target="#submenu4">
                               Abbandono<span class="glyphicon glyphicon-plus pull-right"></span></a>
                                <ul class="nav collapse" id="submenu4" role="menu" aria-labelledby="unsubscribing-menu">
                                    <li class="sidebar-submenu"><a href="#">Cambia corso</a></li>
                                    <li class="sidebar-submenu"><a href="#">Sospendi gli studi</a></li>
                                    <li class="sidebar-submenu"><a href="#">Rinuncia agli studi</a></li>
                                </ul>
                            </li>

                            <li><a href="../login/logout.php">Logout<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                        </ul>
                    </nav>
                </section>
                <!-- sidebar-wrapper -->

                <!-- Page Content -->
                <section id="page-content-wrapper">
                    <!--Container del contenuto centrale-->
                    <div class="container-fluid " id="fluid-page-wrapper">
                        <!-- Una colonna dedicata al bottone della sidebar-->
                        <div class="row text-center">
                            <div class="col-xs-12 col-md-12" id="page-container">

                            </div>
                        </div>
                        <!--page content wrapper-->
                    </div>
                </section>
                <!-- Modal notifications -->
            </main>

            <?php 
                include '../notification/allNotifications.php';
            ?>
        </body>

    </html>