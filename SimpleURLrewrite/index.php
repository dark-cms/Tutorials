<?php
include 'cnf.router.php';
include 'fnc.createurl.php';
include 'fnc.findurl.php';
$currentURL = findURL();
?>

Willkommen,<br>
<?php
if ($currentURL) {
    echo 'Sie befinden sich aktuell auf: '.$currentURL['key'].'<br>';
    echo 'Folgende Datei wird eingebunden: '.$currentURL['page'].'<br>';
} else {
    echo 'Sie befinden sich aktuell auf einer unbekannten URL!<br>';
}
?>

Sie haben 4 Links zur Auswahl: <br>
<a href="<?php echo createURL('/');?>">Startseite</a><br>
<a href="<?php echo createURL('/user');?>">Userbereich</a><br>
<a href="<?php echo createURL('/user/login');?>">Login</a><br>

<a href="<?php echo createURL('/kartoffel/copter');?>">KartoffelCopter</a><br>