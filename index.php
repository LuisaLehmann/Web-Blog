<?php
    setlocale(LC_ALL, "de_DE.utf8");
    include 'classes/DatabaseInteraction.php';
    $db_interaction = new DatabaseInteraction();
    if (isset($_GET['filter_by'])) {
        $beitraege = $db_interaction->getBeitraegeByFilter($_GET['filter_by']);
    }
    else {
        $beitraege = $db_interaction->getBeitraegeByFilter(null);
    }
    $comments = $db_interaction->getComments();
    $tag_names = $db_interaction->getTagNames();
    $count_follower = $db_interaction->getCountFollower();
?>
 <!DOCTYPE html>
    <html>
        <head>
            <title>Blog - Kunstrad</title>
            <meta http-equiv="content-type" content="text/html; charset=utf-8">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
            <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
            <link href="style/index.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
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
                    <?php
                        if (!isset($_SESSION['login'])) {
                            print_r('<li><a href="index.php"><img src="images/Home-48.png"/></a></li>');
                            print_r('<li><a href="impressum.php">Impressum</a></li>');
                            print_r('</ul>');
                            print_r('<ul class="nav navbar-nav login">');
                            print_r('<li><a href="" data-toggle="modal" data-target="#login" class="login">Login</a></li>');
                            print_r('</ul>');
                        }
                        else {
                            print_r('<li><a href="index.php"><img src="images/Home-48.png"/></a></li>');
                            print_r('<li><a href="newtext.php">Neuer Beitrag</a></li>');
                            print_r('<li><a href="impressum.php">Impressum</a></li>');
                            print_r('</ul>');
                            print_r('<ul class="nav navbar-nav login">');
                            print_r('<li class="user">Hallo '.$_SESSION['user'].'</a></li>');
                            print_r('<li><a href="" class="logout">Logout</a></li>');
                            print_r('</ul>');
                        }
                    ?>
            </div>
            <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        	  <div class="modal-dialog">
    				<div class="loginmodal-container">
    					<h1>Login</h1>
                        <br>
    				    <form action="CheckLogin.php" method="post">
    					    <input type="text" name="user" placeholder="Benutzer" autocomplete="off">
    					    <input type="password" name="password" placeholder="Passwort">
    					    <input type="submit" name="login" class="login loginmodal-submit" value="Login">
                        </form>
    				</div>
    			</div>
    		  </div>
            <div class="container">
                <div class="middle">
                    <div class="blogs">
                        <?php
                            foreach ($beitraege as $beitrag) {
                                print_r('<div class="blog jumbotron">');
                                $date = strftime("%d %B %G", strtotime($beitrag['zeit']));
                                print_r("<h3>".$date."</h3>");
                                print_r('<br>');
                                print_r('<br>');
                                print_r("<div class='context'>");
                                if ($beitrag['pfad'] != NULL) {
                                    print_r("<img src='".$beitrag['pfad']."'>");
                                    print_r('<br>');
                                }
                                print_r($beitrag['text']."</div>");
                                print_r('<br>');
                                print_r('<button class="like btn btn-default" data-count="'.$beitrag['likes'].'" beitrag="'.$beitrag['id'].'">Gefällt mir <span class="glyphicon glyphicon-thumbs-up"></span></button>');
                                if ($beitrag['likes'] != 0) {
                                    if ($beitrag['likes'] <= 1) {
                                        print_r('<span class="like_people">Gefällt '.$beitrag['likes'].' Person</span>');
                                    }
                                    else {
                                        print_r('<span class="like_people">Gefällt '.$beitrag['likes'].' Personen</span>');
                                    }
                                }
                                print_r('<br>');
                                if (isset($comments[$beitrag['id']])) {
                                    foreach ($comments[$beitrag['id']] as $comment) {
                                        print_r("<div class='col-md-12'>");
                                        print_r("<div class='panel panel-default'>");
                                        print_r("<div class='panel-heading'>");
                                        print_r("<p style='font-size: 15px;' class='output_comment'>".$comment['text']."<span class='panel-body'>".$comment['zeit']."</span></p>");
                                        print_r('</div>');
                                        print_r('</div>');
                                        print_r("</div>");
                                    }
                                }
                                print_r('<div class="commentdiv">');
                                print_r('<input type="text" class="commenttext"/>');
                                print_r('<input type="button" class="comment btn btn-default" value="Kommentieren" beitrag="'.$beitrag['id'].'"/>');
                                print_r('</div>');
                                print_r('</div>');
                                print_r('<br>');
                            }
                         ?>
                    </div>
                </div>
                <div class="right menue">
                    <div class="well about">
                        <p><b>Beschreibung:</b><br>Die Mannschaft besteht aus Alina, Lisa, Louisa und Luisa. Wir fahren seit einem Jahr in einer Fahrgemeinschaft zusammen, das bedeutet das wir aus 2 verschiedenen Vereinen kommen, dem RV Germania Oberschindmas (Louisa) und dem ESV Lok Zwickau (Alina, Lisa und Luisa). Wir sind letztes Jahr Ostdeutscher Meister, Landesmeister geworden und haben bei der Deutschen Meisterschaft den 13. Platz belegt.</p>
                    </div>
                    <div class="well follower">
                        <?php
                            print_r('<p><b>Anzahl der bisherigen Follower: '.$count_follower['follower'].'</b></p>');
                        ?>
                        <button id="mail" class="btn btn-default">Folgen</button>
                    </div>
                    <div class="well search">
                        <p><b>Blogs anzeigen zum Thema:</b></p>
                        <ul>
                            <?php
                                foreach ($tag_names as $tag_name) {
                                    print_r("<li><a href='http://localhost/blog/blog/index.php?filter_by=".$tag_name['name']."' class = '".$tag_name['name']."' >".$tag_name['name']."</a></li>");
                                }
                                $last_month_name = strftime('%B', strtotime("-1 month"));
                                print_r("<li><a href='http://localhost/blog/blog/index.php?filter_by=Lastmonth' class='Lastmonth'>Beiträge von ".$last_month_name."</a></li>");
                            ?>
                        </ul>
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
            <script src="javascript/index.js"></script>
        </body>
    </html>
