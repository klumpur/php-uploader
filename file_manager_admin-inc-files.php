<?php
$curDirectory=$fileFolder;

$fileList= scandir($curDirectory);

if(@$_GET['q']!=""){
$input = preg_quote(@$_GET['q'], '~'); // don't forget to quote input string!
$fileList = preg_grep('~' . $input . '~', $fileList);
}else{
$fileList= scandir($curDirectory);
}

$FileListNow="";
foreach ($fileList as $value) {
if(($value!="." && $value!=".." && $value!="log.txt")){
$FileListNow.=$value.",";
}
}

$fileList=explode(",",$FileListNow);

$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
$total = count($fileList); //total items in array    
$limit = !empty($limit) ? (int) $limit : 5; //per page    
$totalPages = ceil( $total/ $limit ); //calculate total pages
$page = max($page, 1); //get 1 page when $_GET['page'] <= 0
$page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
$offset = ($page - 1) * $limit;
if( $offset < 0 ) $offset = 0;

$fileList = array_slice($fileList, $offset, $limit );

$ActivecurDirectory=explode("/",$curDirectory);
$ActivecurDirectory=$ActivecurDirectory[(count($ActivecurDirectory)-1)];
$ActivecurDirectoryLinks=explode("/",$curDirectory);

$TotalFolders=0;
$TotalFiles=0;
$TotalFileSize=0;
