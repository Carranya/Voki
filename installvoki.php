<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Voki Create Japanisch</title>
</head>
<body>

    <?php

    $table = "jp_verb_1";

    $con = new mysqli ("", "root");
    $sql = "CREATE DATABASE IF NOT EXISTS voki";
    $con->query($sql);
    $con->select_db("voki");

    echo "<p>Datenbank voki erstellt</p>";



    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id INT(10) NOT NULL AUTO_INCREMENT,
        worda VARCHAR(30) NOT NULL,
        wordb VARCHAR(30) NOT NULL,
        PRIMARY KEY (id))
        ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $con->query($sql);

    echo "<p>Tabelle voki erstellt</p>";

    $sql = "INSERT INTO $table (worda, wordb) VALUES 
    

    ('au', 'treffen'),
('akeru', 'öffnen'),
('ageru', 'geben'),
('asobu', 'spielen'),
('arau', 'waschen'),
('aru', 'da sein'),
('aruku', 'gehen'),
('iu', 'sagen'),
('iku', 'fahren'),
('itadaku', 'bekommen'),
('iru', 'da sein'),
('uru', 'verkaufen'),
('undo suru', 'sport'),
('okiru', 'aufstehen'),
('oku', 'hintun'),
('okuru', 'verschicken'),
('okureru', 'verspäten'),
('oshieru', 'lehren'),
('ochiru', 'herunterfallen'),
('odoroku', 'erschrecken'),
('oboeru', 'merken'),
('omou', 'meinen'),
('oreru', 'brechen'),
('owaru', 'enden'),
('kau', 'kaufen'),
('kaeru', 'zurückkehren'),
('kakaru', 'kosten'),
('kaku', 'schreiben'),
('kasu', 'verleihen'),
('katadzukeru', 'aufräumen'),
('katsu', 'gewinnen'),
('kariru', 'ausleihen'),
('ganbaru', 'anstrengen'),
('kiku', 'hören'),
('kimeru', 'entscheiden'),
('kyukei suru', 'pause'),
('kiru (s)', 'schneiden'),
('kiru (t)', 'tragen'),
('kuru', 'kommen'),
('kureru', 'schenken'),
('kokai suru', 'bereuen'),
('kowareru', 'kaputt gehen'),
('sawaru', 'anfassen'),
('sanpo suru', 'spazieren'),
('shaberu', 'unterhalten'),
('shinu', 'sterben'),
('shiraberu', 'untersuchen'),
('shiru', 'wissen'),
('shinpai suru', 'sorgen machen'),
('sumu', 'wohnen'),
('suru', 'machen'),
('suwaru', 'hinsetzen'),
('soji suru', 'reinigen'),
('taberu', 'essen'),
('tamaru', 'ruhig sein'),
('chumon suru', 'bestellen'),
('tsukau', 'verwenden'),
('tsukuru', 'herstellen'),
('tsukeru', 'anbringen'),
('dekakeru', 'ausgehen'),
('dekiru', 'können'),
('deru', 'raus gehen'),
('denwa suru', 'telefonieren'),
('tobu', 'springen'),
('tomaru', 'anhalten'),
('toru (n)', 'nehmen'),
('toru (f)', 'foto machen'),
('naosu', 'reparieren'),
('nakusu', 'verschwinden'),
('naru', 'werden'),
('neru', 'schlafen'),
('nomu', 'trinken'),
('noru', 'einsteigen'),
('hairu', 'reingehen'),
('hajimeru', 'anfangen'),
('hashiru', 'rennen'),
('hataraku', 'arbeiten'),
('hanasu', 'reden'),
('harau', 'bezahlen'),
('fueru', 'mehr werden'),
('futoru', 'dick werden'),
('benkyo suru', 'lernen'),
('honyaku suru', 'übersetzen'),
('matsu', 'warten'),
('mieru', 'sehen können'),
('miseru', 'zeigen'),
('mitsukeru', 'finden'),
('miru', 'sehen'),
('musubu', 'zusammen binden'),
('motsu', 'halten'),
('motte iku', 'mitnehmen'),
('morau', 'bekommen'),
('yakusoku suru', 'verabreden'),
('yasumu', 'ausruhen'),
('yameru', 'aufhören'),
('yogoreru', 'schmutzig werden'),
('yomu', 'lesen'),
('renshu suru', 'üben'),
('wakaru', 'verstehen'),
('wasureru', 'vergessen'),
('warau', 'lachen')
";

$con->query($sql);

echo "<p>Wörter $table hinzugefügt</p>";

$table = "jp_adj_1";
$sql = "CREATE TABLE IF NOT EXISTS $table (
    id INT(10) NOT NULL AUTO_INCREMENT,
    worda VARCHAR(30) NOT NULL,
    wordb VARCHAR(30) NOT NULL,
    PRIMARY KEY (id))
    ENGINE=InnoDB DEFAULT CHARSET=utf8";
$con->query($sql);

echo "<p>Tabelle voki erstellt</p>";

$sql = "INSERT INTO $table (worda, wordb) VALUES 

('ureshii', 'glücklich'),
('kanashii', 'traurig'),
('sabishii', 'einsam'),
('tanoshii', 'angenehm'),
('hoshii', 'gewünscht sein'),
('suki na', 'gemocht sein'),
('iya na', 'unangenehm'),
('kirai na', 'nicht gemocht sein'),
('nemui', 'müde'),
('genki na', 'munter'),
('itai', 'weh tun'),
('atatakai', 'warm'),
('atsui (h)', 'heiss'),
('samui', 'kalt'),
('tsumetai', 'kalt'),
('nurui', 'lauwarm'),
('suzushii', 'kühl'),
('mushiatsui', 'schwül'),
('oishii', 'lecker'),
('umai (l)', 'lecker'),
('mazui', 'nicht lecker'),
('amai', 'süss'),
('karai', 'scharf'),
('shiokarai', 'salzig'),
('suppai', 'sauer'),
('nigai', 'bitter'),
('asai', 'flach'),
('fukai', 'tief'),
('takai', 'hoch'),
('hikui', 'niedrig'),
('yasui', 'billig'),
('semai', 'eng'),
('hiroi', 'weit'),
('chikai', 'nahe'),
('toi', 'weit entfernt'),
('koi', 'stark'),
('usui', 'dünn'),
('atsui (d)', 'dick'),
('futoi', 'dick'),
('hosoi', 'dünn'),
('okii', 'gross'),
('chiisai', 'klein'),
('karui', 'leicht'),
('omoi', 'schwer'),
('nagai', 'lang'),
('mijikai', 'kurz'),
('marui', 'rund'),
('sukunai', 'wenig'),
('oi', 'viel'),
('aoi', 'blau'),
('akai', 'rot'),
('kiiroi', 'gelb'),
('kuroi', 'schwarz'),
('shiroi', 'weiss'),
('chairoi', 'braun'),
('haiiro no', 'grau'),
('orenji no', 'orange'),
('midori no', 'grün'),
('murasaki no', 'violett'),
('akarui', 'hell'),
('kurai', 'dunkel'),
('muzukashii', 'schwierig'),
('yasashii (le)', 'leicht'),
('kantan na', 'leicht'),
('fukuzatsu na', 'kompliziert'),
('jozu na', 'geschickt'),
('umai (g)', 'geschickt'),
('heta na', 'ungeschickt'),
('raku na', 'bequem'),
('shitsurei na', 'unhöflich'),
('teinei na', 'höflich'),
('shinsetsu na', 'freundlich'),
('yasashii (li)', 'lieb'),
('yumei na', 'berühmt'),
('binbo na', 'arm'),
('kanemochi no', 'reich'),
('benri na', 'nützlich'),
('fuben na', 'unbequem'),
('daijobu na', 'in ordnung'),
('dame na', 'nutzlos'),
('jobu na', 'stabil'),
('taihen na', 'sehr schlimm'),
('taisetsu na', 'wichtig'),
('daiji na', 'wichtig'),
('mezurashii', 'selten'),
('yoi', 'gut'),
('warui', 'schlecht'),
('sugoi', 'extrem'),
('kawaii', 'süss'),
('kitanai', 'schmutzig'),
('kirei na', 'sauber'),
('omoshiroi', 'interessant'),
('okashii', 'seltsam'),
('hen na', 'komisch'),
('tsumaranai', 'langweilig'),
('kowai', 'furchterregend'),
('abunai', 'gefährlich'),
('anzen na', 'sicher'),
('osoi', 'langsam'),
('hayai (s)', 'schnell'),
('hayai (f)', 'früh'),
('isogashii', 'beschäftigt'),
('hima na', 'frei'),
('tadashii', 'richtig')

        ";

    $con->query($sql);

    echo "<p>Wörter $table hinzugefügt</p>";

$table = "eng_demo";
$sql = "CREATE TABLE IF NOT EXISTS $table (
    id INT(10) NOT NULL AUTO_INCREMENT,
    worda VARCHAR(30) NOT NULL,
    wordb VARCHAR(30) NOT NULL,
    PRIMARY KEY (id))
    ENGINE=InnoDB DEFAULT CHARSET=utf8";
$con->query($sql);

echo "<p>Tabelle voki erstellt</p>";

$sql = "INSERT INTO $table (worda, wordb) VALUES 

    ('to walk', 'gehen'),
    ('to sit', 'sitzen'),
    ('to stand', 'stehen'),
    ('to swim', 'schwimmen'),
    ('buy', 'kaufen'),
    ('sell', 'verkaufen'),
    ('to see', 'sehen')
        ";

    $con->query($sql);

    echo "<p>Wörter $table hinzugefügt</p>";


    ?>
</body>
</html>
