<?php

session_start();
$idioma = $_SESSION['idioma'];
session_destroy();
session_start();
$_SESSION['idioma'] = $idioma;
header('Location: ../index.php');//Esto te manda al index

?>
