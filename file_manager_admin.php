<?php include("file_manager_admin-inc-main.php"); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "file_manager_admin-login.php?login=fails";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}


include("file_manager_admin-inc-files.php");
 ?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Administrator - Simple File Uploader and  Explorer</title>
<link rel="shortcut icon" href="icon.png" type="image/png" />
<link rel="stylesheet" href="css/style.css">
<link href='//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' rel='stylesheet'>
<script type='text/javascript' src='//code.jquery.com/jquery-1.10.2.min.js'></script>
<script type='text/javascript' src='//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>

    
  </head>

  <body>

  <div class="container"> 
    <div class="row">

    	
        
    		<div class="panel panel-default">
         		<div class="panel-heading"><h1>File Manager </h1> <small> Administrator</small></div>
   			<div class="panel-body">
 
<div class="table-responsive">
<div class="center-orientation">
          <form action="" method="get" class=" navbar-form">
            <label for="search">
            <input name="q" type="text" class="form-control" id="q" value="<?php echo @$_GET['q']; ?>" placeholder="Search Here">
            <button type="submit" class="form-control"><i class="glyphicon glyphicon-search"></i> Search</button>
            <a href="file_manager_admin.php?q="><button type="button" class="form-control"><i class="glyphicon glyphicon-refresh"></i></button></a>
            <a href="file_manager_admin-logout.php?q="><button type="button" class="form-control"><i class="glyphicon glyphicon-lock"></i> Logout</button></a>
            </label>
          </form>
</div>          

      <table id="bs-table" class="table table-hover">
        <thead>
          <tr>
            <th width="10" class="text-right" data-sort="int">#</th>
            <th width="40" class="text-left" data-sort="string">&nbsp;</th>
            <th class="text-left" data-sort="int">Name/Type</th>
            <th class="text-right" data-sort="int">Size</th>
            <th class="text-right" data-sort="int"> Age

</th>
            <th class="text-right" data-sort="int">Actions</th>
          </tr>
        </thead>
        <tbody>
<?php $i=0?>    
<?php foreach ($fileList as $value) { ?>
<?php 
?>    
<?php if(($value!="." && $value!=".." && $value!="log.txt" && $value!=".htaccess")){ ?>  
<?php $i++?>        
<?php 
$fileName=$fileFolder."/".$value;
?>
          <tr>
            <td class="text-muted text-right" data-sort-value="<?php echo $i; ?>"><?php echo $i; ?></td>
            <td class="text-left  " data-sort-value="checksum">
            
            <img class="fa image" alt="<?php echo $ActivecurFile; ?>" width="50" height="40" src="img/spacer_trans.gif" style="background:url(<?php
if(mime_content_type($fileName)=="image/png" || mime_content_type($fileName)=="image/jpg" || mime_content_type($fileName)=="image/jpeg" || mime_content_type($fileName)=="image/gif" || mime_content_type($fileName)=="image/bmp"){ 
echo "file_manager_admin-piccrop.php?w=50&img=".$fileName;
}else{ ?>https://placeholdit.imgix.net/~text?txtsize=15&txt=<?php echo  strtoupper(mime_content_type($fileName)); ?>&w=50&h=100
<?php }?>) center no-repeat;">

            
          
            
           </td>
            <td class="text-warning" data-sort-value="0">
			<a href="download.php?id=<?php echo base64_encode($fileName); ?>"><strong><?php echo $value; ?></strong></a><br>

			<?php if(is_dir($fileName)){ $TotalFolders++;?>&mdash;<?php }else{ $TotalFiles++; ?><?php echo mime_content_type($fileName); ?><?php }?></td>
            <td class="text-right" data-sort-value="0"><?php if(is_dir($fileName)){ ?>&mdash;<?php }else{?><?php $stat=stat($fileName); $TotalFileSize+=$stat['size']; echo FileSizeConvert($stat['size']); ?><?php }?></td>
            <td class="text-left" data-sort-value="<?php echo filectime($fileName); ?>" title="<?php echo date("F d Y H:i:s", filectime($fileName)); ?>" style="width:220px;"><?php   $oldtime = filectime($fileName); echo time_elapsed($nowtime-$oldtime);?> Days ago<br>


</td>
            <td class="text-left" data-sort-value="<?php echo filectime($fileName); ?>" title="<?php echo date("F d Y H:i:s", filectime($fileName)); ?>" style="width:220px;">
            <a href="file_manager_admin-delete.php?id=<?php echo base64_encode($fileName); ?>" class="btn btn-danger pull-right btn-rounded btn-sm" title="Delete" style="margin:2px;"><i class="glyphicon glyphicon-download glyphicon-white"></i> Delete </a>
            <a href="download.php?id=<?php echo base64_encode($fileName); ?>" class="btn btn-primary pull-right btn-rounded btn-sm" title="Download" style="margin:2px;"><i class="glyphicon glyphicon-download glyphicon-white"></i> Download </a>
            </td>
          </tr>
<?php }?>
<?php }?>
          
        </tbody>                          
        <tfoot>
          <tr>
            <td colspan="6" align="center" >
              <small class="pull-left text-muted" dir="ltr"><?php echo $TotalFolders; ?> folders and <?php echo $TotalFiles; ?> files<?php if($TotalFileSize>0){?>, <?php echo FileSizeConvert($TotalFileSize); ?> in total<?php }?></small>
              
            </td>
          </tr>
        </tfoot>
      </table>
<style type="text/css">
.pagination>li>a, .pagination>li>span { border-radius: 50% !important;margin: 0 5px;}
</style>
<div class="container">
<?php 
$crrpage=$page;
$lastpage=floor($total/$limit)+1;
if($totalPages>=6){
	$allowedmin=$crrpage-3;
	if($allowedmin<1){
		$allowedmin=1;
	}
	$allowedmax=$crrpage+3;
	if($allowedmax<6){
	if($total<6){	
	$allowedmax=$total;
	}else{
	$allowedmax=6;	
	}
	}
	
}else{
	$allowedmin=1;
	$allowedmax=$total;
}

if($allowedmax<100){
	$roudnoff=2;
}else if($allowedmax<1000){
	$roudnoff=3;
}else if($allowedmax<10000){
	$roudnoff=4;
}else if($allowedmax<100000){
	$roudnoff=5;
}else if($allowedmax<1000000){
	$roudnoff=6;
}

$aa=0;
?>         
<?php if($totalPages>0){?> 
<ul class="pagination">
              <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $_SERVER['PHP_SELF']; ?>?q=<?php echo @$_GET['q']; ?>&page=1">«</a></li>
<?php 
	$aa=$allowedmin-1;
	for($s=$allowedmin;$s<=$allowedmax;$s++){
        $aa=$aa+1;
if($lastpage>=$aa){?>
<li class="<?php if($page==($aa)){?>active<?php }?>"><a href="<?php if((($aa-1)*$limit)==$aa){?>javascript:void();<?php }else{?>http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $_SERVER['PHP_SELF']; ?>?q=<?php echo @$_GET['q']; ?>&page=<?php echo $aa; ?><?php }?>"><?php echo  sprintf("%0".$roudnoff."s", $aa);  ?></a></li>
<?php }?>
<?php }?>
<?php if($totalPages>0){?>        
              <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $_SERVER['PHP_SELF']; ?>?q=<?php echo @$_GET['q']; ?>&page=<?php echo $totalPages; ?>">»</a></li>
<?php }?>            
</ul>
<?php }?>            
</div>
      
    </div>    		</div>
    		</div>
        
        
	</div>
</div>
<footer>
<div class="panel-body">
<a class="pull-right small text-muted" href="http://www.nelliwinne.net" target="_blank">Develped By Nelliwinne</a>
</div>
</footer>
<!-- /container --> 

  
    
  </body>
</html>
