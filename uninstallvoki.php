<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Uninstall Voki</title>
</head>
<body>
    <?php
    $con = new mysqli ("", "root", "", "voki");
    $sql = "DROP DATABASE voki";
    $con->query($sql);
    $con->close();

    echo "<p>Voki uninstalled</p>";
    ?>
</body>
</html>
