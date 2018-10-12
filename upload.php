<?php require_once('inc-main.php'); ?>
<?php
$targetDir="fileFolder/";

$myfile = fopen("log.txt", "a") ;
$txt ="---------------------Uploading ".count($_FILES['file']['name'])." Files --------------------- \n".date("r")."\n";; //print_r($_FILES, true);
//$txt="\n";
//foreach ($_POST as $key => $value) {
//	$txt.=$_FILES['file']["tmp_name"];
//}


//for($keyValue=0;$keyValue<=count($_FILES['file']['name']);$keyValue++){  
$txt.="\nFile: ".$_FILES['file']['name']."\n";

$blockUpload="false";
$fileType = $_FILES['file']['name'];
$fileBlockedArray=explode(",",$DisAllowFileTypes);
foreach($fileBlockedArray as $valUe){
if (strpos($fileType, $valUe) !== false) {
	$txt.= $valUe."<>".$fileType."\n";
$blockUpload="true";
}
}

if($blockUpload=="false"){  
  
$uploadFileName=basename($_FILES['file']['name']);
$uploadfile = $targetDir .$uploadFileName ;  
  
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    $txt.="File is valid, and was successfully uploaded.  ($uploadfile)\n";
} else {
    $txt.= "Possible file upload attack ($uploadfile)!\n";
}


}
    

fwrite($myfile, $txt);
?>