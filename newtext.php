<?php
    require_once ('config/config.php');
    $db = mysqli_connect (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    setlocale(LC_ALL, "de_DE.utf8");
    session_start();
    if (!isset($_SESSION['login'])) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
    <html>
        <head>
            <title>Blog - Kunstrad</title>
            <meta http-equiv="content-type" content="text/html; charset=utf-8">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
            <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" type="text/css" href="style/index.css"/>
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
                        <img src="images/header_2.jpg" data-src="" alt="Second slide">
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
                    <li><a href="index.php"><img src="images/Home-48.png"/></a></li>
                    <li><a href="newtext.php">Neuer Beitrag</a></li>
                    <li><a href="impressum.php">Impressum</a></li>
                </ul>
                <ul class="nav navbar-nav login">');
                    <?php
                    print_r("<li class='user'>Hallo ".$_SESSION['user']."</a></li>");
                    ?>
                    <li><a href="" class="logout">Logout</a></li>
                </ul>
            </div>
            <div class="container">
                <div class="middle">
                    <div class="newtext">
                        <!-- Textarea -->
                            <textarea name="content" id="myeditablediv" style="width:100%"></textarea>
                            <!-- Radio buttons für die Auswahl der Tags -->
                            <div class="check">
                                <?php
                                    $erg_tags = $db->query("SELECT name FROM tags");
                                    while ($tag = $erg_tags->fetch_assoc()) {
                                        $tags[] = $tag;
                                    }
                                    print_r("<label>Wählen Sie einen Tag aus: </label>");
                                    foreach ($tags as $tagname) {
                                        print_r('<input type="checkbox" name="tag" data-tag="'.$tagname['name'].'"/>'.$tagname['name']);
                                    }
                                ?>
                            </div>
                            <input type="file" id="imagepath" accept="image/jepg" style="float:left" name="imagepath"/>
                            <input type="submit" id="SubmitBtn" class="btn btn-default" style="float:right;"/>
                    </div>
                </div>
                <div class="right menue">
                    <div class="well about">
                        <p><b>Beschreibung:</b><br>Die Mannschaft besteht aus Alina, Lisa, Louisa und Luisa. Wir fahren seit einem Jahr in einer Fahrgemeinschaft zusammen, das bedeutet das wir aus 2 verschiedenen Vereinen kommen, dem RV Germania Oberschindmas (Louisa) und dem ESV Lok Zwickau (Alina, Lisa und Luisa). Wir sind letztes Jahr Ostdeutscher Meister, Landesmeister geworden und haben bei der Deutschen Meisterschaft den 13. Platz belegt.</p>
                    </div>
                    <div class="well follower">
                        <?php
                            $erg_follower = $db->query('SELECT count(*) as follower, email FROM Blog.follower;');
                            $follower = $erg_follower->fetch_assoc();
                            print_r('<p><b>Anzahl der bisherigen Follower: '.$follower['follower'].'</b></p>');
                            //mail("$follower['email']", "Testmail", "Hallo, das ist eine Testmail!", "From: luisa0506@gmx.de");
                        ?>
                        <button class="btn btn-default" id="mail">Folgen</button>
                    </div>
                </div>
                <br>
                <div class="footer">
                    <p><b>Lizenzen</b></p>
                    <a href="http://www.icons8.com">www.icons8.com</a>
                    <br>
                    <a href="http://getbootstrap.com/">www.bootstrap.com/</a>
                </div>
            </div>
            <?php include 'Scripts.php'; ?>
            <script src="javascript/tinymce4.5.3/js/tinymce/tinymce.js"></script>
            <script src="javascript/newblog.js"></script>
      </body>
    </html>
