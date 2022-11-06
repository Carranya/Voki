<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Vokabular Training Japanisch</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

// require_once "settings.php";
require_once "../../settings/settings.php";

$con = new mysqli($DB['hostname'], $DB['username'], $DB['password'], $DB['database']);

// Menüliste erzeugen
class Menuliste
{
    function __construct(private $sprache = array(), private $modul = array(), private $link)
    {
        for($i=0; $i<count($this->sprache); $i++)
        {
            echo "<h2>" . $this->sprache[$i][0] . "<h2>";
            echo "<p><img src='img/" . $this->sprache[$i][1] . "' width='60' height='40'></img></p>";
            for($j=0; $j<count($this->modul[$i]); $j++)
            {
                echo "<form action=" . $this->link . " method='post'>";
                echo "<p><input type='submit' name='modul' value='" . $this->modul[$i][$j]. "' style='width: 250px; height: 50px'></p>";
                echo "</form>";
            }
            echo "<hr>";
        }
    }
}

class Aufgabe
{
    function __construct(
        private $tabelle,
        private $id = 0,
        private $lang = 0,
        private $frage = "",
        private $richtig = "",
        private $antwort = array(),
        ){}

    function generieren()
    {
        // Fragewort generieren
        global $con;
        $anzahl = $con->query("SELECT COUNT(1) FROM $this->tabelle");
        $zw = $anzahl->fetch_array();
        $max = $zw[0];
        $id = random_int(1, $max);
        $lang = random_int(0,1);

        $this->id = $id;
        $this->lang = $lang;

        $sql = ("SELECT * FROM $this->tabelle WHERE id=$this->id");
        $res = $con->query($sql);
        $data = $res->fetch_assoc();

        if($this->lang == 0)
        {
            $this->frage = $data["worda"];
            $this->richtig = $data["wordb"];
        }
        else
        {
            $this->frage = $data["wordb"];
            $this->richtig = $data["worda"];
        }

        // Antworten generieren

        for($i=0; $i<4; $i++)
        {
            $id = random_int(1, $max);
            $sql = "SELECT * FROM $this->tabelle WHERE id=$id";
            $res = $con->query($sql);

            while ($data = $res->fetch_assoc())
            {
                if($this->lang == 1)
                {
                    $this->antwort[$i] = $data['worda'];
                }
                else
                {
                    $this->antwort[$i] = $data['wordb'];
                }
            }
            $res->close();
        }

        // Richtige Antwort einfügen

        $r = random_int(0,3);
        $this->antwort[$r] = $this->richtig;
    }

    // Anzeigen
    function anzeigen($runde, $rundentotal, $fehler)
    {
        echo "<h2>Runde: $runde/$rundentotal | Fehler: $fehler</h2>";
        echo "<p>&nbsp</p>";

        echo "<table id='question' align='center'>";
        echo "<tr><td><b>$this->frage</b></td></tr>";
        echo "</table>";

        echo "<input type='hidden' name='frage' value='" . $this->frage . "'>";
        echo "<input type='hidden' name='richtig' value='" . $this->richtig . "'>";

        echo "<p>";
        echo "<input type='submit' name='antwort' value='" . $this->antwort[0] . "' style='width: 120px; height: 50px'> ";
        echo "<input type='submit' name='antwort' value='" . $this->antwort[1] . "' style='width: 120px; height: 50px'>";
        echo "</p><p>";
        echo "<input type='submit' name='antwort' value='" . $this->antwort[2] . "' style='width: 120px; height: 50px'> ";
        echo "<input type='submit' name='antwort' value='" . $this->antwort[3] . "' style='width: 120px; height: 50px'>";
        echo "</p>";
    }

    // Antworten prüfen
    function pruefen($frage, $richtig, $antwort)
    {
        if($richtig == $antwort)
        {
            echo "<h2 style='color:green'>Richtig!</h2>";
            echo "<p>&nbsp</p>";
            return 0;
        }
        else
        {
            echo "<h2 style='color:red'>Falsch!</h2>";
            echo "<p>Richtige Antwort: $richtig ($frage)</p>";
            return 1;
        }
    }

    // Abfrage Ende
    function ende($rundentotal, $fehler)
    {
        echo "<h2>Training abgeschlossen</h2>";
        $punkte = $rundentotal - $fehler;
        $prozent = (100/$rundentotal) * $punkte;
        echo "<h3><u>Bewertung</u></h3>";
        echo "<h3>Punkte: $punkte/$rundentotal</h3>";
        echo "<h3>Fehler: $fehler</h3>";
        echo "<h3>Du hast in dieser Training $prozent% richtig gelöst</h3>";
    }

}

// Informationen für Übergabe sammeln
class Information
{
    function __construct(private $runde, private $rundentotal, private $fehler){}

    function eingabe($runde, $rundentotal, $fehler)
    {
        $this->runde = $runde;
        $this->rundentotal = $rundentotal;
        $this->fehler = $fehler;
    }

    function runde()
    {
        $this->runde++;
        return $this->runde;
    }

    function rundentotal()
    {
        return $this->rundentotal;
    }

    function fehler($pruefung)
    {
        if($pruefung == 1)
        {
            $this->fehler++;
        }
        return $this->fehler;
    }

    function uebergabe()
    {
        echo "<input type='hidden' name='runde' value=" . $this->runde . ">";
        echo "<input type='hidden' name='rundentotal' value=" . $this->rundentotal . ">";
        echo "<input type='hidden' name='fehler' value=" . $this->fehler . ">";

    }
}


echo "<div class='head'>";
    echo "<h1>VOKI - Das Online-Vokabulair Übungsprogramm</h1>";
echo "</div>";

echo "<div class='main'>";

$sprachliste = array(
    array("Englisch", "britian.jpg"),
    array("Japanisch", "japan.jpg")
    );

$modulliste = array(
    array("Englisch Demo"),
    array("Japanisch Verben Stufe 1", "Japanisch Adjektive Stufe 1")
    );


    // Linke Menü
    echo "<div class='left'>";
        echo "<h2>Wörterabfrage starten</h2>";
        $link_left = "index.php?page=abfrage";
        $menu_left = new Menuliste($sprachliste, $modulliste, $link_left);
    echo "</div>";

    // Inhalt in der Mitte
    echo "<div class='content'>";

        // Prüfen ob eine Modul ausgewählt ist.
        if(isset($_POST['modul']))
        {
            $modul = $_POST["modul"];
            $runde = 1;
            $rundentotal = 20;
            $fehler = 0;
            $info = new Information ($runde, $rundentotal, $fehler);

            switch($modul)
            {
                case "Japanisch Verben Stufe 1":
                    $modulauswahl = array("jp_verb_1", "japan.jpg");
                    break;
                
                case "Japanisch Adjektive Stufe 1":
                    $modulauswahl = array("jp_adj_1", "japan.jpg");
                    break;
                
                case "Englisch Demo":
                    $modulauswahl = array("eng_demo", "britian.jpg");
                    break;
            }

            $modulname = $modul;
            $tabelle = $modulauswahl[0];
            $flagge = $modulauswahl[1];
            // Wenn Abfrage ausgewählt ist:
            if($_GET['page'] == 'abfrage')
            {
                echo "<h1>$modulname</h1>";
                echo "<p><img src=img/$flagge width='90' height='60'></img>";
                echo "<form action='index.php?page=abfrage' method='post'>";
                echo "<input type='hidden' name='modul' value='$modul'>";

                $info->uebergabe();

                $aufgabe = new Aufgabe($tabelle);

                // Nach Runde 1
                if(isset($_POST['antwort']))
                {
                    $info->eingabe ($_POST["runde"], $_POST["rundentotal"], $_POST["fehler"]);
                    $pruefung = $aufgabe->pruefen($_POST['frage'], $_POST['richtig'], $_POST['antwort']);
                    $fehler = $info->fehler($pruefung);
                    $runde = $info->runde();
                    $rundentotal = $info->rundentotal();
                    $info->uebergabe();
                    echo "<hr>";
                }
                else
                {
                    echo "<h2>&nbsp</h2>";
                    echo "<p>&nbsp</p>";
                    echo "<hr>";
                }

                $aufgabe->generieren();

                // Maximal Runden erreicht
                if($runde > $rundentotal)
                {
                    $aufgabe->ende($rundentotal, $fehler);
                }
                else
                {
                    $aufgabe->anzeigen($runde, $rundentotal, $fehler);
                }

                echo "</form>";
                echo "<form action='index.php' method='post'>";
                echo "<br>";
                echo "<p><input type='submit' value='Zurück zur Startseite' style='width: 200px; height: 50px'></p>";
                echo "</form>";
            }
            if($_GET['page'] == 'anzeige')
            {
                echo "<h1>Liste $modulname</h1>";
                global $con;
                $sql = "SELECT * FROM $tabelle";
                $res = $con->query($sql);

                echo "<table align='center'>";
                while($data = $res->fetch_assoc())
                {
                    echo "<tr>";
                    echo "<td>" . $data['id'] . "</td>";
                    echo "<td>" . $data['worda'] . "</td>";
                    echo "<td>" . $data['wordb'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "<form action='index.php' method='post'>";
                echo "<p><input type='submit' value='Zurück zur Startseite' style='width: 200px; height: 50px'></p>";
                echo "</form>";
                $con->close();
            }
        }
        else
        {
            echo "<h1>Herzlich Willkommen!</h1>";
            echo "<p id='maintext'>
            Willst du eine oder mehrere neue Sprachen lernen?<br>
            Findest du Vokabulair üben zu langweilig?<br>
            <br>
            Du kannst mit Hilfe dieses Online-Tool neue Wörter spielerisch üben.<br>
            Wähle einfach die gewünschte Lektion auf der rechten Spalte aus und die gesamte Wörterliste von gewählte Lektion wird aufgelistet.<br>
            <br>
            Oder willst du Herausforderungen?<br>Mit einem Klick auf die gewünschte Lektion auf der linken Spalte startet die Wörterabfrage.<br>
            Schaffst du 20 Wörter fehlerfrei zu übersetzen?<br>
            <br>
            Weitere Wörterpakete folgen.<br>
            <br>
            <br>
            <i>
            Last Update: 04.11.2022 - Version 1.2<br>
            - Online Datenbank erstellt.<br>
            <br>
            Update: 12.08.2022 - Version 1.1<br>
            - Neue UI<br>
            - Wörterpaket \"Japanisch Adjektive Level 1\" hinzugefügt.
            </i>
            </p>";
        }

    echo "</div>";

    echo "<div class='right'>";
        echo "<h2>Wörter Listen anzeigen</h2>";
        $link_right = "index.php?page=anzeige";
        $menu_right = new Menuliste($sprachliste, $modulliste, $link_right);
    echo "</div>";
echo "</div>";
echo "<div class='foot'>";
    echo "<p>Version 1.2<br><a href='mailto:karin.giang1982@gmail.com'>Karin Giang</a></p>";
echo "</div>";

?>
</body>
</html>