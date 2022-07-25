<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Vokabular Training Englisch (Demo)</title>
    <style>
    table,td{border:1px solid black}
    body{font-family:Verdana; font-size:12px; color:#333333; background-color:#e3e3e3; text-align:center}
    </style>
</head>
<body>
    <h1>Vokabular Training Englisch (Demo)</h1>
    <form action="vokieng.php" method="post">

    <?php

        $rundentotal = 5;
        
        if(isset($_POST["antwort"]))
        {
            $antwort = $_POST["antwort"];
            $frage = $_POST["frage"];
            $richtig = $_POST["richtig"];
            $runde = $_POST["runde"];
            $fehler = $_POST["fehler"];
      
        // Wortprüfung
           
            if($antwort == $richtig)
            {
                echo "<h2>Richtig!</h2>";
                if($runde > $rundentotal)
                {
                    echo "<h2>Runde: $rundentotal/$rundentotal | Fehler: $fehler</h2>";
                }
                else
                {
                    echo "<h2>Runde: $runde/$rundentotal | Fehler: $fehler</h2>";
                }
                echo "<p>&nbsp</p>";
                
            }
            else
            {
                $fehler++;
                echo "<h2>Falsch!</h2>";
                if($runde > $rundentotal)
                {
                    echo "<h2>Runde: $rundentotal/$rundentotal | Fehler: $fehler</h2>";
                }
                else
                {
                    echo "<h2>Runde: $runde/$rundentotal | Fehler: $fehler</h2>";
                }
                    echo "<p>Richtige Antwort: $richtig ($frage)</p>";
            }

            echo "<input type='hidden' name='runde' value='$runde'>";
            echo "<input type='hidden' name='fehler' value='$fehler'>";
        

          // Trainingsende
          if($runde > $rundentotal)
          {
              echo "<h2>Training abgeschlossen</h2>";
              $punkte = $rundentotal - $fehler;
              $prozent = (100/$rundentotal) * $punkte;
              echo "<h3><u>Bewertung</u></h3>";
              echo "<h3>Punkte: $punkte/$rundentotal</h3>";
              echo "<h3>Fehler: $fehler</h3>";
              echo "<h3>Du hast in dieser Training $prozent% richtig gelöst</h3>";
              exit;
          }
        }
        else
        {
            $runde = 1;
            $fehler = 0;
            echo "<h2>Start</h2>";
            echo "<h2>Runde: $runde/$rundentotal | Fehler: $fehler</h2>";
            echo "<p>&nbsp</p>";
            echo "<input type='hidden' name='fehler' value='$fehler'>";
        }
        $runde++;
        echo "<input type='hidden' name='runde' value='$runde'>";
    

        $con = new mysqli ("", "root", "", "voki");

        //Anzahl Datensätze für Zufallsgenerator einlesen
        $anzahl = $con->query("SELECT COUNT(1) FROM englisch");
        $zw = $anzahl->fetch_array();
        $max = $zw[0];

        // Fragewort generieren und Lösung bestimmen
        $id = random_int(1,$max);
        $lang = random_int(1,2);
        $sql = "SELECT * FROM englisch WHERE id='$id'";
        $res = $con->query($sql);

        $data = $res->fetch_assoc();
        
            if($lang == 1)
            {
                $frage = $data["worda"];
                $richtig = $data["wordb"];
            }
            else
            {
                $frage = $data["wordb"];
                $richtig = $data["worda"];
            }
        
        echo "<input type='hidden' name='frage' value='$frage'>";
        echo "<input type='hidden' name='richtig' value='$richtig'>";
        echo "<hr>";
        
        // Antworten generieren
        for($i=0; $i<=3; $i++)
        {
            $id = random_int(1, $max);
            $sql = "SELECT * FROM englisch WHERE id='$id'";
            $res = $con->query($sql);
            $data = $res->fetch_assoc();

            if($lang == 1)
                {
                    $ant[$i] = $data["wordb"];
                }
            else
                {
                    $ant[$i] = $data["worda"];
                }
        }

        // Richtige Antwort hinzufügen
        $r = random_int(0,3);
        $ant[$r] = $richtig;

        //Ausgabe

        echo "<table align='center'>";
        echo "<tr><td style='width:200px; height:50px; text-align: center'>$frage</td></tr>";
        echo "</table>";

        echo "<p>";
        echo "<input type='submit' name='antwort' value='$ant[0]' style='width: 100px; height: 30px'> ";
        echo "<input type='submit' name='antwort' value='$ant[1]' style='width: 100px; height: 30px'>";
        echo "</p><p>";
        echo "<input type='submit' name='antwort' value='$ant[2]' style='width: 100px; height: 30px'> ";
        echo "<input type='submit' name='antwort' value='$ant[3]' style='width: 100px; height: 30px'>";
        echo "</p>";
   
        $res->close();
        $con->close();
    ?>
    </form>
</body>
</html>