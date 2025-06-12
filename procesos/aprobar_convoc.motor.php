<?php
session_start();
if ($_POST['respuesta'] === 'si') {
    header('Location: anuncio_convoc.inc.php');
} else {
    header('Location: form_convoc.inc.php');
}
exit();
?>