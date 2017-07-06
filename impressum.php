<!DOCTYPE html>
    <html>
        <head>
            <title>Blog -Kunstrad</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
            <link rel="stylesheet" type="text/css" href="style/index.css"/>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
            <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
            <meta http-equiv="content-type" content="text/html; charset=utf-8">
        </head>
        <body>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="item active">
                    <img src="images/header_1.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Kunstrad</h1>
                    </div>
                </div>
                <div class="item">
                    <img src="images/header_2.jpg" data-src="" alt="Second    slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>4er Mannschaft Frauen</h1>
                    </div>
                </div>
                <div class="item">
                    <img src="images/header_3.jpg" data-src="" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h1>Vereine: ESV Lok Zwickau und RV Germania Oberschindmas</h1>
                    </div>
                </div>
              </div>
          </div>
            <div class="navbar navbar-inverse">
                <ul class="nav navbar-nav">
                    <?php
                        session_start();
                        if (!isset($_SESSION['login'])) {
                            print_r('<li><a href="index.php"><img src="images/Home-48.png"/></a></li>');
                            print_r('<li><a href="impressum.php">Impressum</a></li>');
                            print_r('</ul>');
                            print_r('<ul class="nav navbar-nav login">');
                            print_r('<li class="login"><a href="" data-toggle="modal" data-target="#login">Login</a></li>');
                            print_r('</ul>');
                        }
                        else {
                            print_r('<li><a href="index.php"><img src="images/Home-48.png"/></a></li>');
                            print_r('<li><a href="newtext.php">Neuer Beitrag</a></li>');
                            print_r('<li><a href="impressum.php">Impressum</a></li>');
                            print_r('</ul>');
                            print_r('<ul class="nav navbar-nav login">');
                            print_r("<li class='user'>Hallo ".$_SESSION['user']."</a></li>");
                            print_r('<li class="logout"><a href="">Logout</a></li>');
                            print_r('</ul>');
                        }
                    ?>
            </div>
            <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="loginmodal-container">
                        <h1>Login</h1><br>
                        <form action="CheckLogin.php" method="post">
                            <input type="text" name="user" placeholder="Benutzer" autocomplete="off">
                            <input type="password" name="password" placeholder="Passwort">
                            <input type="submit" name="login" class="login loginmodal-submit" value="Login">
                        </form>
                    </div>
                </div>
            </div>
            <div class="impressum">
                <h2>Kontakt:</h2>
                <p>Luisa Lehmann</p>
                <h2>E-mail:</h2>
                <p>luisalehmann2@tu-dresden.de</p>
                <h2>Telefon:</h2>
                <p>0123456789</p>
                <h2>Adresse:</h2>
                <p>Musterstraße 1 <br> 01234 Musterhausen</p>
            </div>
            <div class="footer">
                <p><b>Lizenzen</b></p>
                <a href="http://www.icons8.com">www.icons8.com</a>
                <br>
                <a href="http://getbootstrap.com/">www.bootstrap.com/</a>
            </div>
            <script>
                $('.logout').click(function() {
                    $.post( "CheckLogin.php", {logout: 'true'});
                });
            </script>
        </body>
    </html>
