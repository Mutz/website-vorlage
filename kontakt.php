<h2 id="kontaktformular">Kontaktformular</h2>

<?php

if (isset($_POST['button_send'])) {

    /* Formular wurde abgeschickt, Feldinhalte holen und verarbeiten, Absätze erzeugen */
    $nachricht = get_magic_quotes_gpc () ? stripslashes ($_POST['txt_nachricht']) : $_POST['txt_nachricht'];
    $email = get_magic_quotes_gpc () ? stripslashes ($_POST['txt_email']) : $_POST['txt_email'];
    $name = get_magic_quotes_gpc () ? stripslashes ($_POST['txt_name']) : $_POST['txt_name'];
    $telefon = get_magic_quotes_gpc () ? stripslashes ($_POST['txt_telefon']) : $_POST['txt_telefon'];
                            
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
        echo "<h3>Es sind Fehler aufgetreten!</h3><p>Die Formularinhalte konnten nicht übermittelt werden, bitte überprüfe folgende Fehler:</p><div class=\"info-box\"><ul>" . $error . "</ul></div>";
    }
}
?>

<form id="form_kontakt" action="kontakt.php#kontaktformular" method="post" name="form_kontakt">
    <p><label for="txt_nachricht">Nachricht<strong>*</strong></label> <textarea class="txt<?php if ($err[0]) { echo ' eingabefehler'; } ?>" id="txt_nachricht" name="txt_nachricht" rows="4" cols="40" tabindex="1"><?php echo $nachricht ?></textarea></p>
    <p><label for="txt_name">Name<strong>*</strong></label> <input type="text" class="txt<?php if ($err[1]) { echo ' eingabefehler'; } ?>" id="txt_name" name="txt_name" size="24" value="<?php echo $name ?>" tabindex="2" /></p>
    <p><label for="txt_email">E-Mail<strong>*</strong></label> <input type="text" class="txt<?php if ($err[2]) { echo ' eingabefehler'; } ?>" id="txt_email" name="txt_email" size="24" value="<?php echo $email ?>" tabindex="3" /></p>
    <p><label for="txt_telefon">Telefon</label> <input type="text" class="txt" id="txt_telefon" name="txt_telefon" size="24" value="<?php echo $telefon ?>" tabindex="4" /></p>
    <p><input type="submit" class="button" name="button_send" value="Anfrage abschicken" tabindex="5" /></p>
</form>