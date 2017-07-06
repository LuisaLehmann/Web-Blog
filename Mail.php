<?php
    require_once ('config/config.php');
    setlocale(LC_ALL, "de_DE.utf8");
    $db = mysqli_connect (MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    $erg = $db->query("SELECT * FROM follower");

?>
    <!DOCTYPE html>
    <html>
        <head>
            <style>
                .mail {
                    border: black solid 1px;
                    padding-left: 10px;
                    margin-bottom: 20px;
                }
            </style>
        </head>
        <body>
            <a href="index.php" style="float:right">Zurück</a>
            <h1 style="text-align:center;">E-mails</h1>
            <br></br>
            <?php
                while ($follower = $erg->fetch_assoc()) {
                    print_r("<div class='mail'>");
                        print_r("<p>An: ".$follower['email']."</p>");
                        print_r("<p>Von: luisa.lehmann2@tu-dresden.de</p>");
                        print_r("<p>Betreff: Neuer Blogbeitrag</p>");
                        print_r("<br></br>");
                        print_r("<div class='content'>");
                            print_r("<p>Hallo ".$follower['name'].",</p>");
                            print_r("<p>Es wurde gerade ein neuer Beitrag auf dem Kunstrad-Blog erstellt. Schau doch mal vorbei: <a href='http://localhost/blog/blog/index.php'>www.blog/index.php</a>.</p>");
                            print_r("<br></br>");
                            print_r("<p>Mit freundlichen Grüßen</p>");
                            print_r("<p>Das Blog Adminteam</p>");
                        print_r("</div>");
                    print_r("</div>");
                }

            ?>

        </body>
    </html>
