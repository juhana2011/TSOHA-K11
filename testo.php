
<?php

// yhteyden muodostus tietokantaan
try {
    $yhteys = new PDO("pgsql:host=localhost;dbname=uroskanta","postgres", "burana12");
} catch (PDOException $e) {
    die("VIRHE: " . $e->getMessage());
}
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// kyselyn suoritus     
$kysely = $yhteys->prepare("SELECT * FROM koirat");
$kysely->execute();

//haettujen rivien tulostus
echo "<table border>";
echo"<tr><td><b>REKISTERINUMERO</b></td>
<td><b>NIMI</b></td>
<td><b>SYNTYMÄAIKA</b></td>
<td><b>VÄRI</b></td>
<td><b>ISÄ</b></td>
<td><b>EMÄ</b></td>
<td><b>ROTU</b></td>
<td><b>OMISTAJA</b></td>
<td><b>TILA</b></td>
</tr>";

while ($rivi = $kysely->fetch()) {
   echo "<tr>";
   echo "<td>" . $rivi["reknro"] . "</td>";
   echo "<td>" . $rivi["nimi"] . "</td>";
   echo "<td>" . $rivi["syntynyt"] . "</td>";
   echo "<td>" . $rivi["vari"] . "</td>";
   echo "<td>" . $rivi["isa"] . "</td>";
   echo "<td>" . $rivi["ema"] . "</td>";
   echo "<td>" . $rivi["rotu"] . "</td>";
   echo "<td>" . $rivi["omistaja"] . "</td>";
   if ($rivi["koiran_tila"] == 1)
       echo "<td>" . "Active" . "</td>";
   else echo "<td>" . "Inactive" . "</td>";
   echo "</tr>";
}
echo "</table>";

?>
