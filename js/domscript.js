$(document).ready(function() {
    // E-Mail-Adressen codieren
    $('p').defuscate();

    // Ajax-Übermittlung der Kontaktdaten
    $('#kontakt_form').submit(function() {
        var options = {
            target:     '#message',
            clearForm:  true
        };
        $(this).ajaxSubmit(options);
        return false;
    });
    
    // Formular-Eingaben validieren
    $('#kontakt_form').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            nachricht: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Bitte geben Sie Ihren Namen ein",
                minlength: "Ihr Name muss mindestens 2 Zeichen haben"
            },
            email: {
                required: "Bitte geben Sie eine E-Mail-Adresse ein",
                email: "Bitte geben Sie eine korrekte E-Mail-Adresse ein"
            },
            nachricht: {
                required: "Bitte geben Sie eine Nachricht ein"
            }
        }
    });
});