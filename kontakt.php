<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">

<head>
    <title>###Titel###</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="content-language" content="de" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="###" />
    <meta name="keywords" content="###,###,###" />
    <link rel="shortcut icon" href="favicon.ico" />
    <!--<link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="css/screen.css" />-->
    <!--<link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="css/jquery.fancybox.css" />-->
    <!--<link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="css/jquery.imageoverlay.css" />-->
    <!--<link rel="stylesheet" type="text/css" charset="utf-8" media="print" href="css/print.css" />-->
    <!--[if lte IE 7]><link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="css/ie7.css" /><![endif]-->
    <!--[if lte IE 6]><link rel="stylesheet" type="text/css" charset="utf-8" media="screen" href="css/ie6.css" /><![endif]-->
    <!--<script type="text/javascript" charset="utf-8" src="js/jquery.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="js/jquery.easing.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="js/jquery.mousewheel.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="js/jquery.fancybox.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="js/jquery.cycle.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="js/jquery.imageoverlay.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="js/jquery.innerfade.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="js/jquery.defuscate.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=###"></script>-->
    <!--<script type="text/javascript" charset="utf-8" src="js/googlemaps.js"></script>-->
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            
        });
    </script>
</head>

<body>

<div id="page">
    <div id="header">
        <h1>Name</h1>
        <ul id="nav">
            <li><a href="#">Item</a></li>
            <li><a href="#">Item</a></li>
            <li><a href="#">Item</a></li>
            <li><a href="#">Item</a></li>
            <li><a href="#">Item</a></li>
        </ul>
    </div>
    
    <div id="body" class="wrapper">
        
        <h2>Anfahrtskizze</h2>
        <div id="map"></div>
        
        <h2 id="kontaktformular">Kontaktformular</h2>
        
        <?php

        if (isset($_POST['button_send'])) {

            /* Formular wurde abgeschickt, Feldinhalte holen und verarbeiten, Absätze erzeugen */
            $nachricht = get_magic_quotes_gpc () ? stripslashes ($_POST['nachricht']) : $_POST['nachricht'];
            $email = get_magic_quotes_gpc () ? stripslashes ($_POST['email']) : $_POST['email'];
            $name = get_magic_quotes_gpc () ? stripslashes ($_POST['name']) : $_POST['name'];
            $telefon = get_magic_quotes_gpc () ? stripslashes ($_POST['telefon']) : $_POST['telefon'];
                                    
            /* Validierung der Eingabefelder */
            $error = "";
            $validate = true;

            /* Prüfen des Nachrichtentextes, Mindestlänge 5 Zeichen */
            if (strlen($nachricht)<5) {
                $err[0] = true;
                $validate = false;
                $error .= "<li>Bitte geben Sie Ihren Nachrichtentext ein.</li>";
            }

            /* Prüfen des Namensfeld, Mindestlänge 2 Zeichen */
            if (strlen($name)<2) {
                $err[1] = true;
                $validate = false;
                $error .= "<li>Bitte geben Sie Ihren Namen an.</li>";
            }

            /* Prüfen der E-Mail-Adresse, korrektes Format, nicht leer */
            if ( (!(eregi('^[\.a-zA-Z0-9_-]+@[\.a-zA-Z0-9-]+$', $email))) && (strlen($email)>0) || $email == "") {
                $err[2] = true;
                $validate = false;
                $error .= "<li>Bitte geben Sie eine korrekte E-Mail-Adresse an.</li>";
            }
        
            /* Überprüfung erfolgreich, E-Mail wird generiert und verschickt */
            if ($validate) {

                /* Generieren des E-Mail-Headers */
                $admin = 'info@###.###';
                $subject = 'Kontaktformular ###';
                $xtra = "From: " . $email . "\r\n";
                $xtra .= "Reply-To: " . $email . "\r\n";
                $xtra .= "Content-Type: text/html; charset=utf-8\r\n";
                $xtra .= "Content-Type-Encoding: 8bit\r\n";
                $xtra .= "X-Mailer: PHP " . phpversion() . "\r\n";

                /* Erzeugen des Body-Textes */
                $message="<html><head>";
                $message.="<meta http-equiv='content-type' content='text/html;charset=utf-8'>";
                $message.="</head>";
                $message.="<body>";
                $message.="<p><strong>Name: </strong></p><p>" . $name . "</p>";
                $message.="<p><strong>E-Mail: </strong></p><p><a href='mailto:" . $email . "'>" . $email . "</a></p>";
                $message.="<p><strong>Telefon: </strong></p><p>" . $telefon . "</p>";
                $message.="<p><strong>Kommentar: </strong></p><p>" . nl2br($nachricht) . "</p>";
                $message.="</body></html>";

                /* Versenden der Mail */
                // mail($admin, $subject, $message, $xtra);
                
                /* Ausgabe in die Seite zum testen */
                echo("Admin: " . $admin . ", Subject: " . $subject . ", Message: " . $message);

                /* Leeren der Eingabefelder */
                $name = "";
                $email = "";
                $nachricht = "";
                $telefon = "";

                /* Erzeugen der Versandbestätigung */
                echo "<div class=\"info-box\">";
                echo "<p>Vielen Dank für die E-Mail, wir werden Ihnen in Kürze darauf antworten.</p>";
                echo "</div>";

            } else {
                echo "<h3>Es sind Fehler aufgetreten!</h3><p>Die Formularinhalte konnten nicht übermittelt werden, bitte überprüfe folgende Fehler:</p><div class=\"error-box\"><ul>" . $error . "</ul></div>";
            }
        }
        ?>
        
        <form id="form_kontakt" action="kontakt.php#kontaktformular" method="post" name="form_kontakt">
            <p><label for="txt_nachricht">Nachricht<strong>*</strong></label> <textarea class="txt<?php if ($err[0]) { echo ' error'; } ?>" id="nachricht" name="nachricht" rows="4" cols="40"><?php echo $nachricht ?></textarea></p>
            <p><label for="txt_name">Name<strong>*</strong></label> <input type="text" class="txt<?php if ($err[1]) { echo ' error'; } ?>" id="name" name="name" size="24" value="<?php echo $name ?>" /></p>
            <p><label for="txt_email">E-Mail<strong>*</strong></label> <input type="text" class="txt<?php if ($err[2]) { echo ' error'; } ?>" id="email" name="email" size="24" value="<?php echo $email ?>" /></p>
            <p><label for="txt_telefon">Telefon</label> <input type="text" class="txt" id="txt_telefon" name="txt_telefon" size="24" value="<?php echo $telefon ?>" /></p>
            <p><input type="submit" class="button" name="button_send" value="Anfrage abschicken" /></p>
        </form>
    </div>
    
    <div id="footer"></div>
</div>

</body>
</html>