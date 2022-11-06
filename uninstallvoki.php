<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Uninstall Voki</title>
</head>
<body>
    <?php

    // require_once "settings.php";
    require_once "../../../settings/settings.php";

    $con = new mysqli($DB['hostname'], $DB['username'], $DB['password'], $DB['database']);

    $sql = "DROP DATABASE voki";
    $con->query($sql);
    $con->close();

    echo "<p>Voki uninstalled</p>";
    ?>
</body>
</html>
