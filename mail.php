<?php

function validate($data) {
    /* Validierung der Eingabefelder */
    $error = "";
    $validate = true;
    
    /* Prüfen auf Name, Mindestlänge 2 Zeichen */
    if (strlen($data['name']) < 2) {
        $error = "<p>Das Formular enthält Fehler, korrigieren Sie diese bitte.</p>";
    }

    /* Prüfen der E-Mail-Adresse, korrektes Format, nicht leer */
    if ( (!(eregi('^[\.a-zA-Z0-9_-]+@[\.a-zA-Z0-9-]+$', $data['email']))) && (strlen($data['email'])>0) || $data['email'] == "") {
        $error = "<p>Das Formular enthält Fehler, korrigieren Sie diese bitte.</p>";
    }
    
    /* Prüfen des Nachrichtentextes, Mindestlänge 5 Zeichen */
    if (strlen($data['nachricht']) < 5) {
        $error = "<p>Das Formular enthält Fehler, korrigieren Sie diese bitte.</p>";
    }
    return $error;
}

function send_mail($data) {
    /* Generieren des E-Mail-Headers */
    $admin = '';
    $subject = 'Kontaktformular';
    $xtra = "From: " . $data['email'] . "\n";
    $xtra .= "Reply-To: " . $data['email'] . "\n";
    $xtra .= "Content-Type: text/plain; charset=utf-8\n";
    $xtra .= "Content-Type-Encoding: 8bit\n";
    $xtra .= "X-Mailer: PHP " . phpversion() . "\n";

    /* Erzeugen des Body-Textes */
    
    $button = array_pop($data); // Letztes Element (Submit-Button wird entfernt

    foreach($data as $key => $value) {
        /* Alle Elemente des Array, erster Buchstabe wird groß gemacht */
        $message .= ucfirst($key) . ": " . $value . "\n\n";
    }
    
    /* Versenden der Mail */
    if (@mail($admin, $subject, $message, $xtra)) {
        echo 'Vielen Dank! Wir haben Ihre Daten per E-Mail erhalten und werden so bald wie möglich antworten.';
    } else {
        echo 'Die E-Mail konnte nicht verschickt werden.';
    }

    /* Ausgabe in die Seite zum testen */
    // echo("Admin: " . $admin . ", Subject: " . $subject . ", Message: " . $message);
    
}

/* Empfang der Daten */
if ($_POST) {
    
    /*  Formular wurde abgeschickt, Feldinhalte holen und
        verarbeiten, Absätze erzeugen */
    if (get_magic_quotes_gpc()) {
        foreach($_POST as $key => $value) {
            $data[$key] = stripslashes($value);
        }
    } else {
        $data = $_POST;
    }

    /* Fehlermeldung (oder nicht) */
    $error = validate($data); // Validierung (Serverseitig)
    
    if ($error) {
        print $error;
    } else {
        send_mail($data); // E-Mail wird versendet
    }  
}

?>