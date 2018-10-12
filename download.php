<?php require_once('inc-main.php'); ?>
<?php
$file = base64_decode($_GET['id']);

$blockUpload="false";
$fileType = $file;
$fileBlockedArray=explode(",",$DisAllowFileTypes);
foreach($fileBlockedArray as $valUe){
if (strpos($fileType, $valUe) !== false) {
	$txt.= $valUe."<>".$fileType."\n";
$blockUpload="true";
}
}

if($blockUpload=="false"){  

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
}else{
echo "File type Blocked !";
}

?>
