<?php
$file = base64_decode($_GET['id']);

if (file_exists($file)) {
    unlink($file);
}
header("Location:".$_SERVER['HTTP_REFERER']);
exit;
?>
