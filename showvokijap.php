<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Show Voki Japanese</title>
    <style>
    table,td {border:1px solid black}
    body{font-family:Verdana; font-size:12px; color:#333333; background-color:#e3e3e3; text-align:center}
    </style>
</head>
<body>
    <?php
$con = new mysqli("", "root", "", "voki");
$sql = "SELECT * FROM japanisch";
$res = $con->query($sql);

echo "<h2>Japanisch - Deutsch</h2>";
echo "<table align='center'>";

echo "<tr>"
. "<td style='text-align:center'><b>Nr. </b></td>"
. "<td><b>Japanisch</b></td>"
. "<td><b>Deutsch</b></td>"
. "</tr>";

while($data = $res->fetch_assoc())
{
    echo "<tr><td style='text-align:center'>$data[id]</td><td>$data[worda]</td><td>$data[wordb]</td></tr>";
}

echo "</table>";

$res->close();
$con->close();
    ?>
</body>
</html>
