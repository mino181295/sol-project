    <?php
        include '../login/functions.php';
        //getNomeUtente, getSchool, link logout to all the buttons, link calendar to all buttons
        sec_session_start();
        if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
        } else {
            header('Location: ../login/login.php');
        }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Studenti Online</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <link type="text/css" rel="stylesheet" href="lib\Bootstrap\css\bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link type="text/css" rel="stylesheet" href="css\animate.css">
        <link type="text/css" rel="stylesheet" href="css\style.css">

        <script type="text/javascript" src="lib\jQuery\jquery.min.js"></script>
        <script type="text/javascript" src="lib\Bootstrap\js\bootstrap.min.js"></script>
        <script type="text/javascript" src="js\main.js"></script>

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
                            <a class="navbar-brand" id="sol-label" href="#">Studenti Online</a>
                            <p class="navbar-text" id="school-information">Ingegneria e Scienze Informatiche</p>
                            <!--Dropdown notifiche-->
                            <ul class="nav navbar-nav pull-left" id="navbar-notification">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown">
                                        <label class="sr-only" id="notification-reference" for="notification-label">Notifiche</label>
                                        <span id="notification-label" class="glyphicon glyphicon-bell"></span>

                                        <label class="sr-only" for="#notification-number">Numero notifiche</label>
                                        <span id="notification-number" class="badge badge-notify">
                                            <!-- Numero notifiche -->
                                            <?php 
                                                include '../notification/getNumNotifications.php'; 
                                                echo getNumNotifications(); 
                                            ?>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu " role="menu" aria-labelledby="#notification-reference">
                                        <li>
                                            <p class="dropdown-header">Notifiche</p>
                                        </li>
                                        <div id="notification-container" class="scrollable-menu">
                                            <script type="text/javascript">
                                                $("ul").click(function(){
                                                    $.get("../notification/notifications.php", function(data){
                                                        //alert("data: " + data);
                                                        //$( ".result" ).html( data );
                                                        //document.write(data);
                                                        $("#notification-container").html(data);
                                                    });
                                                   /* $.ajax({
                                                        url: "../notification/notifications.php";
                                                        success: function(data) {
                                                            //$(".notification-container").html(data);
                                                            alert(data);
                                                        }
                                                    });*/
                                                });
                                                
                                            </script>
                                            <!--<li>
                                                <p class="dropdown-item">Notifica 1</p>
                                            </li>
                                            <li>
                                                <p class="dropdown-item">Notifica 2</p>
                                            </li>
                                            <li>
                                                <p class="dropdown-item">Notifica 3</p>
                                            </li>
                                            <li>
                                                <p class="dropdown-item">Notifica 4</p>
                                            </li>
                                            <li>
                                                <p class="dropdown-item">Notifica 1</p>
                                            </li>
                                            <li>
                                                <p class="dropdown-item">Notifica 2</p>
                                            </li>
                                            <li>
                                                <p class="dropdown-item">Notifica 3</p>
                                            </li>
                                            <li>
                                                <p class="dropdown-item">Notifica 4</p>
                                            </li>-->

                                        </div>
                                        <li>
                                            <a href="#" class="dropdown-item" id="see-all-button">Vedi tutte</a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- Menu con il logout -->
                        <div class="collapse navbar-collapse" id="collapse-form">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <img src="image/male-user-shadow_318-34042.jpg" class="img-circle image-profile pull-left" alt="Immagine di profilo">
                                    <a href="#" class="dropdown-toggle pull-left" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">                                                 Matteo Minardi <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><span class="fa fa-question-circle"></span>Aiuto</a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Impostazioni</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- navbar-collapse -->
                    </div>
                    <!-- container-fluid -->
                </nav>
            </header>
            <div id="wrapper" class="">
                <!-- Sidebar -->
                <div id="sidebar-wrapper">
                    <nav>
                        <ul class="nav sidebar-nav">
                            <li><a href="#">Home<span class="glyphicon glyphicon-home pull-right"></span></a></li>

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
                            <li><a href="#" id="manage-menu" data-toggle="collapse" data-target="#submenu3">
                                Servizi<span class="glyphicon glyphicon-plus pull-right"></span></a>
                                <ul class="nav collapse" id="submenu3" role="menu" aria-labelledby="manage-menu">
                                    <li class="sidebar-submenu"><a href="#">Calendario</a></li>
                                    <li class="sidebar-submenu"><a href="#">Bandi</a></li>
                                    <li class="sidebar-submenu"><a href="#">Tirocini</a></li>
                                    <li class="sidebar-submenu"><a href="#">Servizio studio</a></li>
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
                            
                            <li><a href="#">Logout<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                        </ul>
                    </nav>
                </div>
                <!-- sidebar-wrapper -->

                <!-- Page Content -->
                <div id="page-content-wrapper">
                    <!--Container del contenuto centrale-->
                    <div class="container-fluid" id="fluid-page-wrapper">
                        <!-- Una colonna dedicata al bottone della sidebar-->
                        <div class="row">

                            <div class="col-xs-12 col-md-12" id="page-container">
                                
                                
                                
                                
                                
                                
                                
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="pill" href="#anno1">Anno 1</a></li>
                                    <li><a data-toggle="pill" href="#anno2">Anno 2</a></li>
                                    <li><a data-toggle="pill" href="#anno3">Anno 3</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="anno1" class="tab-pane fade in active">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Primo Semestre</div>
                                            <div class="panel-body">
                                                
                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingOne">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    <i class="more-less glyphicon glyphicon-plus pull-right"></i>
                                                                    Analisi
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                                            <div class="panel-body">
                                                                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingTwo">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    <i class="more-less glyphicon glyphicon-plus pull-right"></i>
                                                                    Programmazione
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                            <div class="panel-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingThree">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    <i class="more-less glyphicon glyphicon-plus pull-right"></i>
                                                                    Inglese
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="panel-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!-- panel-group -->        
                                                
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Secondo Semestre</div>
                                            <div class="panel-body">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="anno2" class="tab-pane fade">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">Primo Semestre</div>
                                            <div class="panel-body">
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Secondo Semestre</div>
                                            <div class="panel-body">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="anno3" class="tab-pane fade">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">Primo Semestre</div>
                                            <div class="panel-body">
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Secondo Semestre</div>
                                            <div class="panel-body">
                                            </div>
                                        </div>
                                </div>  
                            <!--
                                <a href="#" class="btn btn-sq">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <h1>Calendario</h1>
                                </a>
                                <a href="#" class="btn btn-sq">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <h1>Profilo</h1>
                                </a>
                                <a href="#" class="btn btn-sq">
                                    <i class="fa fa-etsy" aria-hidden="true"></i>
                                    <h1>Esami</h1>
                                </a>
                                <a href="#" class="btn btn-sq">
                                    <i class="fa fa-address-card-o" aria-hidden="true"></i>
                                    <h1>Libretto Online</h1>
                                </a>
                                <a href="#" class="btn btn-sq">
                                    <i class="fa fa-folder-o" aria-hidden="true"></i>
                                    <h1>Servizio Studio</h1>
                                </a>
                                <a href="#" class="btn btn-sq">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    <h1>Preferiti</h1>
                                </a>
                                <a href="#" class="btn btn-sq">
                                    <i class="fa fa-wrench" aria-hidden="true"></i>
                                    <h1>Impostazioni</h1>
                                </a>
                            </div>
                            -->
                            <!--buttons-container-->
                        </div>
                        <!--row-->
                    
                            
                            
                            
                            
                            
                    </div>
                    <!--page content wrapper-->
                </div>
            </div>

        </body>

    </html>