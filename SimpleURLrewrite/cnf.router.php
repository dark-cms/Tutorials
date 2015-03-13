<?php
$basePath = '/phptest/routertutorial';

$meineURLS = array(
    '/'=> array('page' => 'startseite.php'),
    '/user'=> array('page' => 'user.php','rewrite' => '/benutzer'),
    '/user/login'=> array('page' => 'user.php','methode'=>'login','rewrite' => '/benutzer/login'),
);
