<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Voki Create Englisch</title>
</head>
<body>
    <?php
    $con = new mysqli ("", "root",);
    $sql = "CREATE DATABASE IF NOT EXISTS voki";
    $con->query($sql);
    $con->select_db("voki");

    echo "<p>Database \"voki\" created.</p>";

    $sql ="CREATE TABLE IF NOT EXISTS englisch (
        id INT(10) NOT NULL AUTO_INCREMENT,
        worda VARCHAR(30) NOT NULL,
        wordb VARCHAR(30) NOT NULL,
        PRIMARY KEY (id))
        ENGINE=InnoDB DEFAULT CHARSET utf8";
    
    $con->query($sql);

    echo "<p>Table \"english\" created.</p>";

    $sql = "INSERT INTO englisch (worda, wordb) VALUES

        ('to walk', 'gehen'),
        ('to sit', 'sitzen'),
        ('to stand', 'stehen'),
        ('to swim', 'schwimmen'),
        ('buy', 'kaufen'),
        ('sell', 'verkaufen'),
        ('to see', 'sehen')
        ";

    $con->query($sql);

    echo "<p>Words added.</p>";

    $con->close();

    ?>
</body>
</html>
